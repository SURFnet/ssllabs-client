<?php

namespace SURFnet\SslLabs\Dto;

class Info
{
    const CLASS_NAME = 'SURFnet\SslLabs\Dto\Info';

    /**
     * SSL Labs software version as a string (e.g., "1.20.28")
     *
     * @var string
     */
    public $engineVersion;

    /**
     * Rating criteria version as a string (e.g., "2009f")
     *
     * @var string
     */
    public $criteriaVersion;

    /**
     * The maximum number of concurrent assessments
     * the client is allowed to initiate.
     *
     * @var int
     */
    public $maxAssessments;

    /**
     * The number of ongoing assessments submitted by this client.
     *
     * @var int
     */
    public $currentAssessments;

    /**
     * The cool-off period after each new assessment, in milliseconds;
     * you're not allowed to submit a new assessment before
     * the cool-off expires, otherwise you'll get a 429.
     *
     * @var int
     */
    public $newAssessmentCoolOff;

    /**
     * A list of messages (strings).
     *
     * Messages can be public (sent to everyone) and private
     * (sent only to the invoking client).
     * Private messages are prefixed with "[Private]".
     *
     * @var string[]
     */
    public $messages;
}
