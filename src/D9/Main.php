<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$filename = __DIR__ . '/input.txt';

$f = file_get_contents($filename);

echo (new \AdventOfCode\D9\DecompressionLength())->simpleLength(trim($f));
echo "\n";
echo (new \AdventOfCode\D9\DecompressionLength())->complexLength(trim($f));
echo "\n";
