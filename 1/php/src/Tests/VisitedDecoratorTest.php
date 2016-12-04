<?php

namespace AdventOfCode\Tests;

use AdventOfCode\Coord;
use AdventOfCode\Direction;
use AdventOfCode\Instruction;
use AdventOfCode\Position;
use AdventOfCode\VisitedDecorator;

/**
 * @property VisitedDecorator decorator
 * @property Position         position
 */
class VisitedDecoratorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider instructionProvider
     */
    public function test_that_decorator_will_notify_about_intersection(array $instructions, $intersectionPoint)
    {
        $position = new Position(new Direction(Direction::NORTH), new Coord(0, 0));
        $decorator = new VisitedDecorator($position);

        foreach ($instructions as $instruction) {
            $decorator->move($instruction);
            if ($decorator->isVisitedTwice()) {
                break;
            }
        }

        $possibleIntersectionPoint = $decorator->getCoord();
        $this->assertEquals($intersectionPoint, $possibleIntersectionPoint);
    }

    public function instructionProvider()
    {
        return [
            [
                '$instructions' => [
                    new Instruction('R8'),
                    new Instruction('R4'),
                    new Instruction('R4'),
                    new Instruction('R8'),
                ],
                '$intersectionPoint' => new Coord(4, 0),
            ],
            [
                '$instructions' => [
                    new Instruction('R3'),
                    new Instruction('R2'),
                    new Instruction('R6'),
                    new Instruction('R1'),
                    new Instruction('R7'),
                ],
                '$intersectionPoint' => new Coord(3, -1),
            ],
            [
                '$instructions' => [
                    new Instruction('R7'),
                    new Instruction('L4'),
                    new Instruction('R4'),
                    new Instruction('L2'),
                    new Instruction('L6'),
                    new Instruction('L4'),
                    new Instruction('L5'),
                ],
                '$intersectionPoint' => new Coord(7, 2),
            ],
        ];
    }
}
