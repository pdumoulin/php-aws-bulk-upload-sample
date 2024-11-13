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

$retry_config = new Aws\Retry\Configuration(
    $retry_mode,
    $retry_count
);
$config = array(
    'retries' => $retry_config,
    'debug' => $debug
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
