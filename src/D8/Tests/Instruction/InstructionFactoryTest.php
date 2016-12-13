<?php

namespace AdventOfCode\D8\Tests\Instruction;

use AdventOfCode\D8\Instruction\Instruction;
use AdventOfCode\D8\Instruction\InstructionFactory;
use AdventOfCode\D8\Instruction\RectInstruction;
use AdventOfCode\D8\Instruction\RotateColInstruction;
use AdventOfCode\D8\Instruction\RotateRowInstruction;

/**
 * @property InstructionFactory factory
 */
class InstructionFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->factory = new InstructionFactory();
    }

    public function test_that_factory_will_return_rect_instruction()
    {
        /** @var RectInstruction $instruction */
        $instruction = $this->factory->create('rect 2x1');
        $this->assertInstanceOf(Instruction::class, $instruction);
        $this->assertEquals(Instruction::RECT, $instruction->getType());
        $this->assertEquals(2, $instruction->getCols());
        $this->assertEquals(1, $instruction->getRows());
    }

    public function test_that_factory_will_return_rotate_row_instruction()
    {
        /** @var RotateRowInstruction $instruction */
        $instruction = $this->factory->create('rotate row y=0 by 5');
        $this->assertInstanceOf(Instruction::class, $instruction);
        $this->assertEquals(Instruction::ROTATE_ROW, $instruction->getType());
        $this->assertEquals(0, $instruction->getRow());
        $this->assertEquals(5, $instruction->getValue());
    }

    public function test_that_factory_will_return_rotate_col_instruction()
    {
        /** @var RotateColInstruction $instruction */
        $instruction = $this->factory->create('rotate column x=0 by 1');
        $this->assertInstanceOf(Instruction::class, $instruction);
        $this->assertEquals(Instruction::ROTATE_COL, $instruction->getType());
        $this->assertEquals(0, $instruction->getCol());
        $this->assertEquals(1, $instruction->getValue());
    }

    /**
     * @expectedException \AdventOfCode\D8\Exceptions\InvalidInstructionException
     */
    public function test_that_factory_will_throw_exception_when_invalid_instruction()
    {
        $this->factory->create('foo');
    }
}
