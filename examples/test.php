<?php
/**
 * Example of Client usage.
 *
 * Note that this requires that you install monolog/monolog as a logger implementation.
 */

use Guzzle\Http\Client as HttpClient;
use SURFnet\SslLabs\Client;
use SURFnet\SslLabs\Dto\Host;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;

require __DIR__ . '/../../../../vendor/autoload.php';

require __DIR__ . '/../src/Client.php';
// Require all files in Dto/
$dtoPath = __DIR__ . '/../src/Dto';
foreach (scandir($dtoPath) as $filename) {
    $path = $dtoPath . '/' . $filename;
    if (is_file($path)) {
        require $path;
    }
}

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

var_dump($client->getStatusCodes());

$host = $client->analyze(
    'surfnet.nl',
    false,
    null,
    null,
    null,
    Client::ALL_DONE
);

var_dump($host);


function doNewAnalyze(Client $client)
{
    $host = $client->analyze(
        'surfnet.nl',
        false,
        true,
        false,
        null,
        Client::ALL_DONE
    );

    while (true) {
        var_dump($host);

        if (in_array($host->status, array(Host::STATUS_ERROR, Host::STATUS_READY))) {
            exit;
        }

        sleep(10);
        $host = $client->analyze('surfnet.nl');
    }
}


