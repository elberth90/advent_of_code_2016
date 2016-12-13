<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$filename = __DIR__ . '/input.txt';

$fp = fopen($filename, 'r');

$lineReader = new \AdventOfCode\Utils\LineReader($fp);
$instructionFactory = new \AdventOfCode\D8\Instruction\InstructionFactory();
$display = new \AdventOfCode\D8\Display(50, 6);

foreach ($lineReader->read() as $line) {
    $instruction = $instructionFactory->create(trim($line));
    $display->perform($instruction);

}

echo sprintf("Result for part 1: %d\n", $display->countLitPixels());
echo "Result for part 2: \n";
$display->printScreen();
