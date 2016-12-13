<?php

use AdventOfCode\D2\Instruction\InstructionFactory;
use AdventOfCode\D2\ValueCheckDecorator;

require_once __DIR__ . '/../../vendor/autoload.php';

$filename = __DIR__ . '/input.txt';


$keypad = new \AdventOfCode\D2\Keypad();
$instructionFactory = new InstructionFactory();
$fp = fopen($filename, 'r');
while (false !== ($char = fgetc($fp))) {
    $char = ($char === PHP_EOL) ? 'N' : $char;
    $instruction = $instructionFactory->create($char);
    $keypad->enter($instruction);
}
fclose($fp);

echo sprintf("Result for part 1: %s\n", $keypad->getCode());


$customKeypad = [
    [null, null, 1, null, null],
    [null, 2, 3, 4, null, null],
    [5, 6, 7, 8, 9],
    [null, 'A', 'B', 'C', null],
    [null, null, 'D', null, null],
];

$keypad = new ValueCheckDecorator($customKeypad, 2, 0);
$fp = fopen($filename, 'r');
while (false !== ($char = fgetc($fp))) {
    $char = ($char === PHP_EOL) ? 'N' : $char;
    $instruction = $instructionFactory->create($char);
    $keypad->enter($instruction);
}
fclose($fp);

echo sprintf("Result for part 2: %s\n", $keypad->getCode());
