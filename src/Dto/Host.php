<?php

namespace SURFnet\SslLabs\Dto;

class Host
{
    const CLASS_NAME = 'SURFnet\SslLabs\Dto\Host';

    const STATUS_DNS         = 'DNS';
    const STATUS_ERROR       = 'ERROR';
    const STATUS_IN_PROGRESS = 'IN_PROGRESS';
    const STATUS_READY       = 'READY';

    /**
     * @var string
     */
    public $host;

    /**
     * @var int
     */
    public $port;

    /**
     * @var string
     */
    public $procotol;

    /**
     * @var bool
     */
    public $isPublic;

    /**
     * @var
     */
    public $status;

    /**
     * @var string
     */
    public $statusMessage;

    /**
     * @var int
     */
    public $startTime;

    /**
     * @var int
     */
    public $testTime;

    /**
     * @var string
     */
    public $engineVersion;

    /**
     * @var string;
     */
    public $criteriaVersion;

    /**
     * @var int
     */
    public $cacheExpiryTime;

    /**
     * @var Endpoint[]
     */
    public $endpoints;

    /**
     * @var string[]
     */
    public $certHostnames;
}
