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

    public function analyze($hostName)
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
}
