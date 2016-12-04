<?php

namespace AdventOfCode\DistanceGauge;

use AdventOfCode\Coord;

class DistanceGauge
{
    public static function measure(Coord $startPoint, Coord $endPoint)
    {
        $x = $endPoint->getX() - $startPoint->getX();
        $y = $endPoint->getY() - $startPoint->getY();

        return abs($x) + abs ($y);
    }
}
