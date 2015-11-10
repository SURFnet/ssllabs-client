<?php

namespace SURFnet\SslLabs\Service;

use RuntimeException;
use SURFnet\SslLabs\Client;
use SURFnet\SslLabs\Dto\Host;

class SynchronousAnalyzeService
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
     * @param string $hostName
     * @param bool|false $full
     * @return Host
     */
    public function analyze($hostName, $full = false)
    {
        if (!empty($this->resultsByHost[$hostName . $full])) {
          return $this->resultsByHost[$hostName . $full];
        }

        $remaining = $this->timeout;

        while ($remaining > 0) {
          $hostDto = $this->client->analyze(
              $hostName,
              null,
              null,
              null,
              null,
              $full ? Client::ALL_DONE : null
          );

          $endStatuses = array(Host::STATUS_ERROR, Host::STATUS_READY);
          if (in_array($hostDto->status, $endStatuses)) {
            return $this->resultsByHost[$hostName . $full] = $hostDto;
          }

          sleep(static::SLEEP_TIME);
          $remaining -= static::SLEEP_TIME;
        }

        throw new RuntimeException(
          "SSL Labs verfication exceeded max timeout of {$this->timeout} seconds"
        );
    }
}
