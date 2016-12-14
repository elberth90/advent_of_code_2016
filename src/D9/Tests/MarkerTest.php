<?php

namespace AdventOfCode\D9\Tests;

use AdventOfCode\D9\Marker;

class MarkerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider markerProvider
     */
    public function test_that_marker_can_be_created(string $markerCommand, int $subsequentLength, int $repeat)
    {
        $marker = new Marker($markerCommand);
        $this->assertEquals($subsequentLength, $marker->getSubsequentLength());
        $this->assertEquals($repeat, $marker->getRepeat());
        $this->assertEquals($markerCommand, $marker->getCommand());
    }

    /**
     * @return array
     */
    public function markerProvider(): array
    {
        return [
            [
                '$markerCommand' => '(1x5)',
                '$subsequentLength' => 1,
                '$repeat' => 5,
            ],
            [
                '$markerCommand' => '(10x2)',
                '$subsequentLength' => 10,
                '$repeat' => 2,
            ],
            [
                '$markerCommand' => '(6x3)',
                '$subsequentLength' => 6,
                '$repeat' => 3,
            ],
            [
                '$markerCommand' => '(1234x65)',
                '$subsequentLength' => 1234,
                '$repeat' => 65,
            ],
        ];
    }
}
