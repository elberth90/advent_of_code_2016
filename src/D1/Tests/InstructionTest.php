<?php

namespace AdventOfCode\D1\Tests;

use AdventOfCode\D1\Instruction;

class InstructionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider instructionProvider
     */
    public function test_that_instruction_can_be_parsed($command, $direction, $distance)
    {
        $instruction = new Instruction($command);
        $this->assertEquals($direction, $instruction->getDirection());
        $this->assertEquals($distance, $instruction->getDistance());
    }

    /**
     * @return array
     */
    public function instructionProvider()
    {
        return [
            ['L4', 'L', 4],
            ['R4', 'R', 4],
            ['R2', 'R', 2],
            ['L1', 'L', 1],
        ];
    }
}
