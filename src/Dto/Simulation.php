<?php

namespace SURFnet\SslLabs\Dto;

class Simulation
{
    /**
     * instance of SimClient.
     * @var SimClient
     */
    public $client;

    /**
     * zero if handshake was successful, 1 if it was not.
     */
    public $errorCode;

    /**
     * always 1 with the current implementation.
     */
    public $attempts;

    /**
     * Negotiated protocol ID.
     */
    public $protocolId;

    /**
     * Negotiated suite ID.
     */
    public $suiteId;
}
