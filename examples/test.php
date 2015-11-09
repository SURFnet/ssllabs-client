<?php

use Guzzle\Http\Client as HttpClient;
use SURFnet\SslLabs\Client;
use SURFnet\SslLabs\Dto\Endpoint;
use SURFnet\SslLabs\Service\GradeComparatorService;
use SURFnet\SslLabs\Service\SynchronousAnalyzeService;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;

require __DIR__ . '/../vendor/autoload.php';

ini_set('xdebug.var_display_max_depth', 8);
date_default_timezone_set('Europe/Amsterdam');

$httpClient = new HttpClient(
    'https://api.ssllabs.com/api/v2/',
    array(
        'headers' => array(
            'User-Agent' => 'Demo - SSL Labs Client v1.0 (https://github.com/surfnet/ssl-labs)',
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ),
    )
);

$normalizer = new PropertyNormalizer();
$serializer = new Serializer(
    array($normalizer),
    array(new JsonEncoder())
);

$client = new Client($httpClient, $serializer);

$info = $client->info();

var_dump($info);

$hostname     = isset($argv[1]) ? $argv[1] : 'surfnet.nl';
$passingGrade = isset($argv[2]) ? $argv[2] : Endpoint::GRADE_B;

print "Starting analysis @ SSL Labs of $hostname" . PHP_EOL;

$api = new SynchronousAnalyzeService($client);
$hostDto = $api->analyze($hostname);

$validated = true;
$comparator = new GradeComparatorService();
foreach ($hostDto->endpoints as $endpoint) {
  if (!$comparator->isHigherThan($endpoint->grade, $passingGrade)) {
    $validated = false;
  }
}

if ($validated) {
    print "[PASS] SSL Labs gives $hostname an equal or greater grade than the required grade $passingGrade" . PHP_EOL;
}
else {
    print "[FAIL] SSL Labs gives $hostname a grade less than the required grade $passingGrade" . PHP_EOL;
}
