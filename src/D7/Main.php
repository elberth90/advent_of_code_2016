<?php

use AdventOfCode\D7\IpV7Validator;
use AdventOfCode\D7\Parser;

require_once __DIR__ . '/../../vendor/autoload.php';

$filename = __DIR__ . '/input.txt';

$fp = fopen($filename, 'r');

$parser = new Parser($fp);
$tlsCounter = $sslCounter = 0;
foreach ($parser->read() as $ip) {
    if (IpV7Validator::isTls($ip)) {
        $tlsCounter++;
    }

    if (IpV7Validator::isSsl($ip)) {
        $sslCounter++;
    }
}

echo sprintf("Result for part 1: %s\n", $tlsCounter);
echo sprintf("Result for part 2: %s\n", $sslCounter);
