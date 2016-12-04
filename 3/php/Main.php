<?php

require_once __DIR__ . '/vendor/autoload.php';

$filename = '../input.txt';
$fp = fopen($filename, "r");
$counter = 0;
while (($line = fgets($fp)) !== false) {
    $line = preg_split('|\\s+|', trim($line));
    try {
        new \AdventOfCode\Triangle(...$line);
        $counter++;
    } catch (\AdventOfCode\Exceptions\InvalidTriangleException $e) {
        //just ignore it
    }
}
fclose($fp);

echo sprintf("Result for part 1: %s\n", $counter);


$fp = fopen($filename, "r");
$counter = 0;
$sides = [];
while (($line = fgets($fp)) !== false) {
    $line = preg_split('|\\s+|', trim($line));
    $sides[] = $line;
    if (3 === count($sides)) {
        $sides = array_map(null, ...$sides);

        $counter += array_reduce($sides, function ($carry, $item) {
            try {
                new \AdventOfCode\Triangle(...$item);
                $carry++;
            } catch (\AdventOfCode\Exceptions\InvalidTriangleException $e) {
                //just ignore it
            }
            return $carry;
        }, 0);
        $sides = [];
    }
}
fclose($fp);

echo sprintf("Result for part 2: %s\n", $counter);

