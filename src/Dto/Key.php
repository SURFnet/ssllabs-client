<?php

namespace SURFnet\SslLabs\Dto;

class Key
{
    /**
     * key size, e.g., 1024 or 2048 for RSA and DSA, or 256 bits for EC.
     */
    public $size;

    /**
     * key size expressed in RSA bits.
     */
    public $strength;

    /**
     * key algorithm; possible values: RSA, DSA, and EC.
     */
    public $alg;

    /**
     * true if we suspect that the key was generated using a weak
     * random number generator (detected via a blacklist database)
     */
    public $debianFlaw;

    /**
     * 0 if key is insecure, null otherwise
     */
    public $q;
}
