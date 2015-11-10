<?php

namespace SURFnet\SslLabs\Dto;

class Endpoint
{
    const CLASS_NAME = 'SURFnet\SslLabs\Dto\Endpoint';

    const GRADE_A_PLUS = 'A+';
    const GRADE_A_MINUS = 'A-';
    const GRADE_A = 'A';
    const GRADE_B = 'B';
    const GRADE_C = 'C';
    const GRADE_D = 'D';
    const GRADE_E = 'E';
    const GRADE_F = 'F';
    const GRADE_T = 'T';
    const GRADE_M = 'M';

    /**
     * Endpoint IP address, in IPv4 or IPv6 format.
     * @var string
     */
    public $ipAddress;

    /**
     * Server name retrieved via reverse DNS.
     * @var string
     */
    public $serverName;

    /**
     * Assessment status message.
     * @var string
     */
    public $statusMessage;

    /**
     * Code of the operation currently in progress.
     * @var string
     */
    public $statusDetails;

    /**
     * Description of the operation currently in progress.
     * @var string
     */
    public $statusDetailsMessage;

    /**
     * Possible values: A+, A-, A-F, T (no trust)
     * and M (certificate name mismatch).
     * @var string
     */
    public $grade;

    /**
     * Grade (as above), if trust issues are ignored.
     * @var string
     */
    public $gradeTrustIgnored;

    /**
     * If this endpoint has warnings that might affect the score
     * (e.g., get A- instead of A).
     * @var bool
     */
    public $hasWarnings;

    /**
     * This flag will be raised when
     * an exceptional configuration is encountered.
     * The SSL Labs test will give such sites an A+.
     * @var bool
     */
    public $isExceptional;

    /**
     * Assessment progress, which is a value from 0 to 100,
     * and -1 if the assessment has not yet started.
     * @var int
     */
    public $progress;

    /**
     * Assessment duration, in milliseconds
     * @var int
     */
    public $duration;

    /**
     * Estimated time, in seconds, until the completion of the assessment.
     * @var int
     */
    public $eta;

    /**
     * Indicates domain name delegation with and without the www prefix.
     * @var string
     */
    public $delegation;

    /**
     * This field contains an EndpointDetails object.
     * It's not present by default, but can be enabled
     * by using the "all" paramerer to the analyze API call.
     * @var EndpointDetails
     */
    public $details;
}
