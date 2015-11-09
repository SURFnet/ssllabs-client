<?php

namespace SURFnet\SslLabs;

use Guzzle\Http\Client as HttpClient;
use SURFnet\SslLabs\Dto\Endpoint;
use SURFnet\SslLabs\Dto\Host;
use SURFnet\SslLabs\Dto\StatusCodes;
use Symfony\Component\Serializer\Serializer;
use SURFnet\SslLabs\Dto\Info;

class Client
{
    const ALL_ON = 'on';
    const ALL_DONE = 'done';

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * Client constructor.
     * @param HttpClient $httpClient
     * @param Serializer $serializer
     */
    public function __construct(
        HttpClient $httpClient,
        Serializer $serializer
    ) {
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
    }

    /**
     * @return Info
     */
    public function info()
    {
        $request = $this->httpClient->get('info');

        $response = $request->send();

        return $this->serializer->deserialize(
            $response->getBody(true),
            Info::CLASS_NAME,
            'json'
        );
    }

    /**
     * @param $host
     * @param bool|false $publish
     * @param null $startNew
     * @param bool|false $fromCache
     * @param null $maxAge
     * @param null $all
     * @param bool|false $ignoreMismatch
     * @return Host
     */
    public function analyze(
        $host,
        $publish = false,
        $startNew = null,
        $fromCache = false,
        $maxAge = null,
        $all = null,
        $ignoreMismatch = false
    ) {
        $arguments = array(
            'host'              => $host,
            'publish'           => $this->encodeBooleanValue($publish),
            'startNew'          => $this->encodeBooleanValue($startNew),
            'fromCache'         => $this->encodeBooleanValue($fromCache),
            'maxAge'            => $maxAge,
            'all'               => $all,
            'ignoreMismatch'    => $this->encodeBooleanValue($ignoreMismatch),
        );
        $arguments = array_filter($arguments);
        $arguments = array_map(function($val) { return urlencode($val); }, $arguments);
        $path = 'analyze?' . http_build_query($arguments);

        $request = $this->httpClient->get($path);

        $response = $request->send();

        return $this->serializer->deserialize(
            $response->getBody(true),
            Host::CLASS_NAME,
            'json'
        );
    }

    public function getEndpointData($host, $s, $fromCache = false)
    {
        $arguments = array(
            'host'              => $host,
            's'                 => $s,
            'fromCache'         => $this->encodeBooleanValue($fromCache),
        );
        $arguments = array_filter($arguments);
        $arguments = array_map(function($val) { return urlencode($val); }, $arguments);
        $path = 'getEndpointData?' . http_build_query($arguments);

        $request = $this->httpClient->get($path);

        $response = $request->send();

        return $this->serializer->deserialize(
            $response->getBody(true),
            Endpoint::CLASS_NAME,
            'json'
        );
    }

    public function getStatusCodes()
    {
        $request = $this->httpClient->get('getStatusCodes');

        $response = $request->send();

        return $this->serializer->deserialize(
            $response->getBody(true),
            StatusCodes::CLASS_NAME,
            'json'
        );
    }

    private function encodeBooleanValue($value)
    {
        if (is_null($value)) {
            return null;
        }

        if ($value) {
            return 'on';
        }

        return 'off';
    }
}
