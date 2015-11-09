<?php

namespace SURFnet\SslLabs\Dto;

class SimClient
{
    /**
     * unique client ID (integer)
     */
    public $id;

    /**
     * text.
     */
    public $name;

    /**
     * text.
     */
    public $platform;

    /**
     * text.
     */
    public $version;

    /**
     * true if the browser is considered representative of modern browsers,
     * false otherwise.
     * This flag does not correlate to client's capabilities,
     * but is used by SSL Labs to determine if a particular configuration
     * is effective. For example, to track Forward Secrecy support,
     * we mark several representative browsers as "modern" and
     * then test to see if they succeed in negotiating a FS suite.
     * Just as an illustration, modern browsers are currently
     * Chrome, Firefox (not ESR versions), IE/Win7, and Safari.
     */
    public $isReference;
}
