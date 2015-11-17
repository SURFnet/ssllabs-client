<?php

namespace SURFnet\SslLabs\Service;

use RuntimeException;
use SURFnet\SslLabs\Dto\Host;

class SynchronousAnalyzeService implements AnalyzeServiceInterface
{
    const SLEEP_TIME = 10;

    /**
     * @var AsynchronousAnalyzeService
     */
    private $asyncAnalyzeService;

    /**
     * ValidateRequiredGrade constructor.
     * @param AsynchronousAnalyzeService $analyzeService
     * @param int $timeout
     */
    public function __construct(
      AsynchronousAnalyzeService $analyzeService,
      $timeout = 300
    ) {
      $this->asyncAnalyzeService = $analyzeService;
      $this->timeout = $timeout;
    }

    /**
     * @param string $hostName
     * @param bool|false $full
     * @return Host
     */
    public function analyze($hostName, $full = false)
    {
        $remaining = $this->timeout;

        while ($remaining > 0) {
          $hostDto = $this->asyncAnalyzeService->analyze(
              $hostName,
              $full
          );

          $endStatuses = array(Host::STATUS_ERROR, Host::STATUS_READY);
          if (in_array($hostDto->status, $endStatuses)) {
            return $hostDto;
          }

          sleep(static::SLEEP_TIME);
          $remaining -= static::SLEEP_TIME;
        }

        throw new RuntimeException(
          "SSL Labs verfication exceeded max timeout of {$this->timeout} seconds"
        );
    }
}
