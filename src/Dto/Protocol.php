<?php

namespace SURFnet\SslLabs\Dto;

class Protocol
{
    /**
     * protocol version number, e.g. 0x0303 for TLS 1.2
     */
    public $id;

    /**
     * protocol name, i.e. SSL or TLS.
     */
    public $name;

    /**
     * protocol version, e.g. 1.2 (for TLS)
     */
    public $version;

    /**
     * some servers have SSLv2 protocol enabled,
     * but with all SSLv2 cipher suites disabled.
     * In that case, this field is set to true.
     */
    public $v2SuitesDisabled;

    /**
     * 0 if the protocol is insecure, null otherwise
     */
    public $q;

}
