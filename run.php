<?php

require __DIR__ . '/vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Transfer;
use Aws\Retry\Configuration;

$bucket = 'dev-pdumoulin';
$key = 'php-upload-test';

$debug = false;
$concurrency = 40;
$mup = 16;
$part_size = 5;
$retry_mode = 'legacy';
$retry_count = 3;

$curl_verbose = true;
$curl_maxlifetime_conn = 0;
$curl_forbid_reuse = false;
$curl_tcp_keepidle = 60;

$retry_config = new Aws\Retry\Configuration(
    $retry_mode,
    $retry_count
);
$config = array(
    'retries' => $retry_config,
    'debug' => $debug,
    'http' => array(
        'curl' => array(
            CURLOPT_VERBOSE => $curl_verbose,
            CURLOPT_FORBID_REUSE => $curl_forbid_reuse,
            CURLOPT_MAXLIFETIME_CONN => $curl_maxlifetime_conn,
            CURLOPT_TCP_KEEPIDLE => $curl_tcp_keepidle
        )
    )
);

$connection = S3Client::factory($config);

$manager = new \Aws\S3\Transfer(
    $connection,
    "/tmp/input",
    "s3://$bucket/$key",
    array(
        'debug' => $debug,
        'concurrency' => $concurrency,
        'mup_threshold' => $mup * 1048576,
        'part_size' => $part_size * 1048576
    )
);
$manager->transfer();
print("Transfer complete!\n");
