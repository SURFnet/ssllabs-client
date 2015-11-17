<?php
namespace SURFnet\SslLabs\Service;

use SURFnet\SslLabs\Dto\Host;

interface AnalyzeServiceInterface
{
    /**
     * @param string $hostName
     * @param bool|false $full
     * @return Host
     */
    public function analyze($hostName, $full = false);
}
