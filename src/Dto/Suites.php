<?php

namespace SURFnet\SslLabs\Dto;

class Suites
{
    /**
     * @var Suite[]
     */
    public $list;

    /**
     * true if the server actively selects cipher suites;
     * if null, we were not able to determine if the server has a preference
     */
    public $preference;
}
