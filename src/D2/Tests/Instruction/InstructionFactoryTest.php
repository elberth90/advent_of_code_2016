<?php

namespace AdventOfCode\D2\Tests\Instruction;

use AdventOfCode\D2\Instruction\Instruction;
use AdventOfCode\D2\Instruction\InstructionFactory;

/**
 * @property InstructionFactory factory
 */
class InstructionFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->factory = new InstructionFactory();
    }

    /**
     * @dataProvider streamProvider
     */
    public function test_that_factory_will_produce_proper_objects($command, $type)
    {
        $instruction = $this->factory->create($command);
        $this->assertInstanceOf(Instruction::class, $instruction);
        $this->assertEquals($type, $instruction->getType());
    }

    /**
     * @return array
     */
    public function streamProvider(): array
    {
        return [
            [
                '$command' => 'U',
                '$type' => Instruction::COMMAND,
            ],
            [
                '$command' => 'D',
                '$type' => Instruction::COMMAND,
            ],
            [
                '$command' => 'L',
                '$type' => Instruction::COMMAND,
            ],
            [
                '$command' => 'R',
                '$type' => Instruction::COMMAND,
            ],
            [
                '$command' => 'N',
                '$type' => Instruction::NEXT_LINE,
            ],
        ];
    }
}
