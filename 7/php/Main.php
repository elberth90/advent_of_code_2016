<?php

require_once 'vendor/autoload.php';

$filename = '../input.txt';
$fp = fopen($filename, 'r');

$parser = new \AdventOfCode\Parser($fp);
$tlsCounter = $sslCounter = 0;
foreach ($parser->read() as $ip) {
    if (\AdventOfCode\IpV7Validator::isTls($ip)) {
        $tlsCounter++;
    }

    if (\AdventOfCode\IpV7Validator::isSsl($ip)) {
        $sslCounter++;
    }
}

echo sprintf("Result for part 1: %s\n", $tlsCounter);
echo sprintf("Result for part 2: %s\n", $sslCounter);
