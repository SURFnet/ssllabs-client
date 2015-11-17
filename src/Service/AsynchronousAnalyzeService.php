<?php

namespace SURFnet\SslLabs\Service;

use SURFnet\SslLabs\Client;
use SURFnet\SslLabs\Dto\Host;

class AsynchronousAnalyzeService implements AnalyzeServiceInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var array
     */
    private $resultsByHost = array();

    /**
     * ValidateRequiredGrade constructor.
     * @param Client $client
     */
    public function __construct(Client $client) {
        $this->client = $client;
    }

    /**
     * @param string $hostName
     * @param bool|false $full
     * @return Host
     */
    public function analyze($hostName, $full = false)
    {
        if (!empty($this->resultsByHost[$hostName.$full])) {
            return $this->resultsByHost[$hostName.$full];
        }

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
            $this->resultsByHost[$hostName.$full] = $hostDto;
        }

        return $hostDto;
    }
}
