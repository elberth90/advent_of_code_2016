<?php

require_once __DIR__ . '/vendor/autoload.php';

$filename = '../input.txt';

$fp = fopen($filename, 'r');

$keypad = new \AdventOfCode\Keypad();
$instructionFactory = new \AdventOfCode\Instruction\InstructionFactory();
while (false !== ($char = fgetc($fp))) {
    $char = ($char === PHP_EOL) ? 'N' : $char;
    $instruction = $instructionFactory->create($char);
    $keypad->enter($instruction);
}
fclose($fp);

echo sprintf("Result for part 1: %d\n", $keypad->getCode());
