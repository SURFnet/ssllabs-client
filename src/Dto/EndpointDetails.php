<?php

namespace SURFnet\SslLabs\Dto;

class EndpointDetails
{
    /**
     * endpoint assessment starting time, in milliseconds since 1970.
     *
     * This field is useful when test results are retrieved in several
     * HTTP invocations. Then, you should check that the hostStartTime value
     * matches the startTime value of the host.
     */
    public $hostStartTime;

    /**
     * Key information
     *
     * @var Key
     */
    public $key;

    /**
     * Certificate information.
     *
     * @var Cert
     */
    public $cert;

    /**
     * @var Chain
     */
    public $chain;

    /**
     *
     *
     * @var Protocol[]
     */
    public $protocols;

    /**
     * @var Suites
     */
    public $suites;

    /**
     * Contents of the HTTP Server response header when known. This field could be absent for one of two reasons: 1) the HTTP request failed (check httpStatusCode) or 2) there was no Server response header returned.
     */
    public $serverSignature;

    /**
     * true if this endpoint is reachable via a hostname with the www prefix
     */
    public $prefixDelegation;

    /**
     *  (moved here from the summary) - true if this endpoint is reachable via a hostname without the www prefix
     *
     * @var
     */
    public $nonPrefixDelegation;
    /**
     * true if the endpoint is vulnerable to the BEAST attack
     */
    public $vulnBeast;

    /**
     * this is an integer value that describes the endpoint support for renegotiation:
     * bit 0 (1) - set if insecure client-initiated renegotiation is supported
     * bit 1 (2) - set if secure renegotiation is supported
     * bit 2 (4) - set if secure client-initiated renegotiation is supported
     * bit 3 (8) - set if the server requires secure renegotiation support
     * @var int
     */
    public $renegSupport;

    /**
     * the contents of the Strict-Transport-Security (STS) response header, if seen
     */
    public $stsResponseHeader;

    /**
     * the maxAge parameter extracted from the STS parameters; null if STS not seen, or -1 if the specified value is invalid (e.g., not a zero or a positive integer; the maximum value currently supported is 2,147,483,647)
     */
    public $stsMaxAge;

    /**
     * true if the includeSubDomains STS parameter is set; null if STS not seen
     */
    public $stsSubdomains;

    /**
     * the contents of the Public-Key-Pinning response header, if seen
     */
    public $pkpResponseHeader;

    /**
     * this is an integer value that describes endpoint support for session resumption.
     * The possible values are:
     * 0 - session resumption is not enabled and we're seeing empty session IDs
     * 1 - endpoint returns session IDs, but sessions are not resumed
     * 2 - session resumption is enabled
     */
    public $sessionResumption;

    /**
     * integer value that describes supported compression methods
     * bit 0 is set for DEFLATE
     */
    public $compressionMethods;

    /**
     * true if the server supports NPN
     */
    public $supportsNpn;

    /**
     * space separated list of supported protocols
     */
    public $npnProtocols;

    /**
     * indicates support for Session Tickets
     * bit 0 (1) - set if session tickets are supported
     * bit 1 (2) - set if the implementation is faulty [not implemented]
     * bit 2 (4) - set if the server is intolerant to the extension
     */
    public $sessionTickets;

    /**
     * true if OCSP stapling is deployed on the server
     */
    public $ocspStapling;

    /**
     * same as Cert.revocationStatus, but for the stapled OCSP response.
     */
    public $staplingRevocationStatus;

    /**
     * description of the problem with the stapled OCSP response, if any.
     */
    public $staplingRevocationErrorMessage;

    /**
     * if SNI support is required to access the web site.
     */
    public $sniRequired;

    /**
     * status code of the final HTTP response seen. When submitting HTTP requests, redirections are followed, but only if they lead to the same hostname. If this field is not available, that means the HTTP request failed.
     */
    public $httpStatusCode;

    /**
     * available on a server that responded with a redirection to some other hostname.
     */
    public $httpForwarding;

    /**
     * true if the server supports at least one RC4 suite.
     */
    public $supportsRc4;

    /**
     * indicates support for Forward Secrecy
     * bit 0 (1) - set if at least one browser from our simulations negotiated a Forward Secrecy suite.
     * bit 1 (2) - set based on Simulator results if FS is achieved with modern clients. For example, the server supports ECDHE suites, but not DHE.
     * bit 2 (4) - set if all simulated clients achieve FS. In other words, this requires an ECDHE + DHE combination to be supported.
     */
    public $forwardSecrecy;

    /**
     * true if RC4 is used with modern clients.
     */
    public $rc4WithModern;

    /**
     * instance of SimDetails.
     */
    public $sims;

    /**
     * true if the server is vulnerable to the Heartbleed attack.
     */
    public $heartbleed;

    /**
     * true if the server supports the Heartbeat extension.
     */
    public $heartbeat;

    /**
     * results of the CVE-2014-0224 test:
     * -1 - test failed
     * 0 - unknown
     * 1 - not vulnerable
     * 2 - possibly vulnerable, but not exploitable
     * 3 - vulnerable and exploitable
     */
    public $openSslCcs;

    /**
     * true if the endpoint is vulnerable to POODLE; false otherwise
     */
    public $poodle;

    /**
     * results of the POODLE TLS test:
     * -3 - timeout
     * -2 - TLS not supported
     * -1 - test failed
     * 0 - unknown
     * 1 - not vulnerable
     * 2 - vulnerable
     */
    public $poodleTls;

    /**
     * true if the server supports TLS_FALLBACK_SCSV, false if it doesn't.
     * This field will not be available if the server's support for
     * TLS_FALLBACK_SCSV can't be tested because it supports only
     * one protocol version (e.g., only TLS 1.2).
     */
    public $fallbackScsv;

    /**
     * true of the server is vulnerable to the FREAK attack,
     * meaning it supports 512-bit key exchange.
     */
    public $freak;

    /**
     * information about the availability of certificate transparency information (embedded SCTs):
     *
     * bit 0 (1) - SCT in certificate
     * bit 1 (2) - SCT in the stapled OCSP response
     * bit 2 (4) - SCT in the TLS extension (ServerHello)
     */
    public $hasSct;

    /**
     * list of hex-encoded DH primes used by the server
     *
     * @var string[]
     */
    public $dhPrimes;

    /**
     * whether the server uses known DH primes:
     * 0 - no
     * 1 - yes, but they're not weak
     * 2 - yes and they're weak
     */
    public $dhUsesKnownPrimes;

    /**
     * true if the DH ephemeral server value is reused.
     */
    public $dhYsReuse;

    /**
     * true if the server uses DH parameters weaker than 1024 bits.
     */
    public $logjam;
}
