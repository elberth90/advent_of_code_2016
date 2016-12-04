<?php

namespace AdventOfCode\Tests\DistanceGauge;

use AdventOfCode\Coord;
use AdventOfCode\DistanceGauge\DistanceGauge;

class DistanceGaugeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider distanceProvider
     */
    public function test_that_gauge_measure_distance($startPoint, $endPoint, $distance)
    {
        $this->assertEquals($distance, DistanceGauge::measure($startPoint, $endPoint));
    }

    public function distanceProvider()
    {
        return [
            [
                '$startPoint' => new Coord(0, 0),
                '$endPoint' => new Coord(7, 6),
                '$distance' => 13,
            ],
            [
                '$startPoint' => new Coord(-2, -5),
                '$endPoint' => new Coord(9, 12),
                '$distance' => 28,
            ],
            [
                '$startPoint' => new Coord(12, 9),
                '$endPoint' => new Coord(7, 6),
                '$distance' => 8,
            ],
        ];
    }
}
