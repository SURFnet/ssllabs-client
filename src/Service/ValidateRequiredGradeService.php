<?php

namespace SURFnet\SslLabs\Service;

use RuntimeException;
use SURFnet\SslLabs\Client;
use SURFnet\SslLabs\Dto\Host;

class ValidateRequiredGradeService
{
  const SLEEP_TIME = 10;

  /**
   * @var Client
   */
  private $client;

  /**
   * @var int
   */
  private $timeout;

  /**
   * @var array
   */
  private $resultsByHost = array();

  /**
   * ValidateRequiredGrade constructor.
   * @param Client $client
   * @param int $maxAgeHours
   * @param int $timeout
   */
  public function __construct(
    Client $client,
    $timeout = 300
  ) {
    $this->client = $client;
    $this->timeout = $timeout;
  }

  /**
   * Synchronously (!) starts a validation, waits for the results
   * and compares the grade.
   *
   * Note that this MAY take at least 60 seconds and MAY return cached results.
   *
   * @param string $hostName
   * @param string $grade
   * @return bool
   */
  public function validateMatchesGrade($hostName, $grade)
  {
    $hostDto = $this->analyze($hostName);

    foreach ($hostDto->endpoints as $endpointDto) {
      if ($this->isGradeGreaterThan($endpointDto->grade, $grade)) {
        continue;
      }

      return false;
    }

    return true;
  }

  private function analyze($hostName)
  {
    if (!empty($this->resultsByHost[$hostName])) {
      return $this->resultsByHost[$hostName];
    }

    $remaining = $this->timeout;

    while ($remaining > 0) {
      $hostDto = $this->client->analyze($hostName);

      $endStatuses = array(Host::STATUS_ERROR, Host::STATUS_READY);
      if (in_array($hostDto->status, $endStatuses)) {
        return $this->resultsByHost[$hostName] = $hostDto;
      }

      sleep(static::SLEEP_TIME);
      $remaining -= static::SLEEP_TIME;
    }

    throw new RuntimeException(
      "SSL Labs verfication exceeded max timeout of {$this->timeout} seconds"
    );
  }

  /**
   *
   * @todo this doesn't work with A- or A+.
   * @param $grade
   * @param $passingGrade
   * @return bool
   */
  private function isGradeGreaterThan($grade, $passingGrade)
  {
    return ord(substr($grade, 0, 1)) <= ord(substr($passingGrade, 0, 1));
  }
}
