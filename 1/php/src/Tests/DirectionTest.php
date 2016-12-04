<?php

namespace AdventOfCode\Tests;

use AdventOfCode\Direction;

class DirectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider turnsProvider
     */
    public function test_turning_will_set_proper_current_direction($current, $turn, $expected)
    {
        $direction = new Direction($current);
        $direction->turn($turn);
        $this->assertEquals($expected, $direction->getCurrent());
    }

    /**
     * @return array
     */
    public function turnsProvider()
    {
        return [
            [
                '$current' => Direction::NORTH,
                '$turn' => Direction::LEFT,
                '$expected' => Direction::WEST,
            ],
            [
                '$current' => Direction::NORTH,
                '$turn' => Direction::RIGHT,
                '$expected' => Direction::EAST,
            ],
            [
                '$current' => Direction::WEST,
                '$turn' => Direction::LEFT,
                '$expected' => Direction::SOUTH,
            ],
            [
                '$current' => Direction::WEST,
                '$turn' => Direction::RIGHT,
                '$expected' => Direction::NORTH,
            ],
            [
                '$current' => Direction::SOUTH,
                '$turn' => Direction::LEFT,
                '$expected' => Direction::EAST,
            ],
            [
                '$current' => Direction::SOUTH,
                '$turn' => Direction::RIGHT,
                '$expected' => Direction::WEST,
            ],
            [
                '$current' => Direction::EAST,
                '$turn' => Direction::LEFT,
                '$expected' => Direction::NORTH,
            ],
            [
                '$current' => Direction::EAST,
                '$turn' => Direction::RIGHT,
                '$expected' => Direction::SOUTH,
            ],
        ];
    }
}
