<?php

namespace AdventOfCode\Tests;

use AdventOfCode\Coord;

class CoordTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider coordProvider
     */
    public function test_that_Coord_can_be_created(int $x, int $y)
    {
        new Coord($x, $y);
    }

    /**
     * @return array
     */
    public function coordProvider(): array
    {
        return [
            [1, 2],
            [9, 8],
            [-4, 17],
        ];
    }
}
