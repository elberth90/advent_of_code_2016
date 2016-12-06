<?php

require_once 'vendor/autoload.php';

$filename = '../input.txt';
$fp = fopen($filename, 'r');

$parser = new \AdventOfCode\Parser($fp);
$recovery = new \AdventOfCode\MessageRecovery();
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


