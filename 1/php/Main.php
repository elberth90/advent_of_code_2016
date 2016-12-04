<?php

use AdventOfCode\Coord;
use AdventOfCode\Direction;
use AdventOfCode\DistanceGauge\DistanceGauge;
use AdventOfCode\Parser\SequenceParser;
use AdventOfCode\Position;

require_once __DIR__ . '/vendor/autoload.php';

$filename = '../input.txt';

$sequenceParser = new SequenceParser(fopen($filename, 'r'));

$position = new Position(new Direction(Direction::NORTH), new Coord(0, 0));

foreach ($sequenceParser->read() as $line) {
    $position->move(new \AdventOfCode\Instruction($line));
}

echo sprintf("Result for part 1: %d\n", DistanceGauge::measure(new Coord(0, 0), $position->getCoord()));


$position = new Position(new Direction(Direction::NORTH), new Coord(0, 0));
$rememberPosition = new \AdventOfCode\VisitedDecorator($position);

foreach ($sequenceParser->read() as $line) {
    $rememberPosition->move(new \AdventOfCode\Instruction($line));
    if ($rememberPosition->isVisitedTwice()) {
        break;
    }
}

echo sprintf("Result for part 2: %d\n", DistanceGauge::measure(new Coord(0, 0), $rememberPosition->getCoord()));
