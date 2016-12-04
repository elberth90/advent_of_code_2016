<?php

namespace AdventOfCode\Tests;

use AdventOfCode\TriangleCounter;

class TriangleCounterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider sideLengths
     */
    public function test_that_counter_will_return_proper_number_of_valid_triangles($sides, $validTriangles)
    {
        $counter = new TriangleCounter();
        foreach ($sides as $side) {
            $counter->add($side);
        }

        $this->assertEquals($validTriangles, count($counter));
    }

    /**
     * @return array
     */
    public function sideLengths(): array
    {
        return [
            [
                '$sides' => [101, 301, 501, 103, 302, 502, 102, 303, 503, 201, 401, 601, 202, 402, 602, 203, 403, 603],
                '$validTriangles' => 6
            ],
        ];
    }
}
