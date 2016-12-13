<?php

use AdventOfCode\D1\Coord;
use AdventOfCode\D1\Direction;
use AdventOfCode\D1\DistanceGauge\DistanceGauge;
use AdventOfCode\D1\Instruction;
use AdventOfCode\D1\Parser\SequenceParser;
use AdventOfCode\D1\Position;
use AdventOfCode\D1\VisitedDecorator;

require_once __DIR__ . '/../../vendor/autoload.php';

$filename = __DIR__ . '/input.txt';

$sequenceParser = new SequenceParser(fopen($filename, 'r'));

$position = new Position(new Direction(Direction::NORTH), new Coord(0, 0));

foreach ($sequenceParser->read() as $line) {
    $position->move(new Instruction($line));
}

echo sprintf("Result for part 1: %d\n", DistanceGauge::measure(new Coord(0, 0), $position->getCoord()));


$position = new Position(new Direction(Direction::NORTH), new Coord(0, 0));
$rememberPosition = new VisitedDecorator($position);

foreach ($sequenceParser->read() as $line) {
    $rememberPosition->move(new Instruction($line));
    if ($rememberPosition->isVisitedTwice()) {
        break;
    }
}

echo sprintf("Result for part 2: %d\n", DistanceGauge::measure(new Coord(0, 0), $rememberPosition->getCoord()));
