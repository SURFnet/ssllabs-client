<?php

namespace SURFnet\SslLabs\Dto;

class ChainCert
{
    /**
     * Certificate subject
     */
    public $subject;

    /**
     * Certificate label (user-friendly name)
     */
    public $label;

    /**
     * 
     */
    public $notBefore;

    /**
     * 
     */
    public $notAfter;

    /**
     * Issuer subject
     */
    public $issuerSubject;

    /**
     * Issuer label (user-friendly name)
     */
    public $issuerLabel;

    /**
     * 
     */
    public $sigAlg;

    /**
     * A number of flags the describe the problems with this certificate:
     * bit 0 (1) - certificate not yet valid
     * bit 1 (2) - certificate expired
     * bit 2 (4) - weak key
     * bit 3 (8) - weak signature
     * bit 4 (16) - blacklisted
     */
    public $issues;

    /**
     * Key algorithm.
     */
    public $keyAlg;

    /**
     * Key size, in bits appopriate for the key algorithm.
     */
    public $keySize;

    /**
     * Key strength, in equivalent RSA bits.
     */
    public $keyStrength;

    /**
     * A number that describes the revocation status of the certificate:
     * 0 - not checked
     * 1 - certificate revoked
     * 2 - certificate not revoked
     * 3 - revocation check error
     * 4 - no revocation information
     * 5 - internal error
     */
    public $revocationStatus;

    /**
     * Same as revocationStatus, but only for the CRL information (if any).
     */
    public $crlRevocationStatus;

    /**
     * Same as revocationStatus, but only for the OCSP information (if any).
     */
    public $ocspRevocationStatus;

    /**
     * PEM-encoded certificate data
     */
    public $raw;
}
