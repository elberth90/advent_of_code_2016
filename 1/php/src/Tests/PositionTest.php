<?php

namespace AdventOfCode\Tests;

use AdventOfCode\Coord;
use AdventOfCode\Direction;
use AdventOfCode\Instruction;
use AdventOfCode\Position;

/**
 * @property Position position
 */
class PositionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider moveProvider
     */
    public function test_that_move_can_change_direction_and_coordinates(
        Position $startingPosition,
        $move,
        Coord $expected
    ) {
        $startingPosition->move($move);
        $this->assertEquals($expected, $startingPosition->getCoord());
    }

    public function moveProvider()
    {
        return [
            [
                '$startingPosition' => new Position(new Direction(Direction::NORTH), new Coord(0, 0)),
                '$move' => new Instruction('R5'),
                '$expected' => new Coord(5, 0)
            ],
            [
                '$startingPosition' => new Position(new Direction(Direction::EAST), new Coord(5, 0)),
                '$move' => new Instruction('L5'),
                '$expected' => new Coord(5, 5)
            ],
            [
                '$startingPosition' => new Position(new Direction(Direction::NORTH), new Coord(5, 5)),
                '$move' => new Instruction('R5'),
                '$expected' => new Coord(10, 5)
            ]
        ];
    }
}
