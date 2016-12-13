<?php

use AdventOfCode\D6\MessageRecovery;
use AdventOfCode\D6\Parser;

require_once __DIR__ . '/../../vendor/autoload.php';

$filename = __DIR__ . '/input.txt';

$fp = fopen($filename, 'r');

$parser = new Parser($fp);
$recovery = new MessageRecovery();
foreach ($parser->read() as $message) {
    $recovery->consume($message);
}

$decrypt = function ($item) {
  arsort($item);

  return $item;
};
echo sprintf("Result for part 1: %s\n", $recovery->recover($decrypt));


$decrypt = function ($item) {
    asort($item);

    return $item;
};
echo sprintf("Result for part 2: %s\n", $recovery->recover($decrypt));


