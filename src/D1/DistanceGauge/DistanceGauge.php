<?php

namespace AdventOfCode\D1\DistanceGauge;

use AdventOfCode\D1\Coord;

class DistanceGauge
{
    public static function measure(Coord $startPoint, Coord $endPoint)
    {
        $x = $endPoint->getX() - $startPoint->getX();
        $y = $endPoint->getY() - $startPoint->getY();

        return abs($x) + abs ($y);
    }
}
