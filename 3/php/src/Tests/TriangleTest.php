<?php

namespace AdventOfCode\Tests;

use AdventOfCode\Triangle;

class TriangleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider sideLengths
     */
    public function test_valid_triangle($sideA, $sideB, $sideC)
    {
        new Triangle($sideA, $sideB, $sideC);
    }

    /**
     * @dataProvider invalidSideLengths
     * @expectedException \AdventOfCode\Exceptions\InvalidTriangleException
     */
    public function test_invalid_triangle($sideA, $sideB, $sideC)
    {
        new Triangle($sideA, $sideB, $sideC);
    }

    /**
     * @return array
     */
    public function sideLengths(): array
    {
        return [
            [5, 6, 7],
            [7, 9, 15],
            [7, 3, 6],
        ];
    }

    /**
     * @return array
     */
    public function invalidSideLengths(): array
    {
        return [
            [5, 10, 25],
            [4, 8, 2],
            [6, 8, 15],
            [5, 5, 10],
        ];
    }
}
