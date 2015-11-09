<?php

namespace SURFnet\SslLabs\Dto;

class Suite
{
    /**
     * suite RFC ID (e.g., 5)
     */
    public $id;

    /**
     * suite name (e.g., TLS_RSA_WITH_RC4_128_SHA)
     */
    public $name;

    /**
     * suite strength (e.g., 128)
     */
    public $cipherStrength;

    /**
     * strength of DH params (e.g., 1024)
     */
    public $dhStrength;

    /**
     * DH params, p component
     */
    public $dhP;

    /**
     * DH params, g component
     */
    public $dhG;

    /**
     * DH params, Ys component
     */
    public $dhYs;

    /**
     * ECDH bits
     */
    public $ecdhBits;

    /**
     * ECDH RSA-equivalent strength
     */
    public $ecdhStrength;

    /**
     * 0 if the suite is insecure, null otherwise
     */
    public $q;

}
