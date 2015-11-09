<?php


namespace SURFnet\SslLabs\Dto;


class Cert
{
    /**
     *  certificate subject
     */
    public $subject;

    /**
     * common names extracted from the subject
     * @var string[]
     */
    public $commonNames;

    /**
     * alternative names
     * @var string[]
     */
    public $altNames;

    /**
     *  timestamp before which the certificate is not valid
     */
    public $notBefore;

    /**
     *  timestamp after which the certificate is not valid
     */
    public $notAfter;

    /**
     *  issuer subject
     */
    public $issuerSubject;

    /**
     *  certificate signature algorithm
     */
    public $sigAlg;

    /**
     *  issuer name
     */
    public $issuerLabel;

    /**
     *  a number that represents revocation information present in the certificate:
     */
    public $revocationInfo;

    /**
     *  CRL URIs extracted from the certificate
     * @var string[]
     */
    public $crlURIs;

    /**
     *  OCSP URIs extracted from the certificate
     * @var string[]
     */
    public $ocspURIs;

    /**
     * a number that describes the revocation status of the certificate:
     */
    public $revocationStatus;

    /**
     *  same as revocationStatus, but only for the CRL information (if any).
     */
    public $crlRevocationStatus;

    /**
     *  same as revocationStatus, but only for the OCSP information (if any).
     */
    public $ocspRevocationStatus;

    /**
     *  Server Gated Cryptography support; integer:
     */
    public $sgc;

    /**
     *  E for Extended Validation certificates; may be null if unable to determine
     */
    public $validationType;

    /**
     *  list of certificate issues, one bit per issue:
     */
    public $issues;

    /**
     *  true if the certificate contains an embedded SCT; false otherwise.
     */
    public $sct;
}
