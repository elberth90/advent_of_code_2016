<?php

namespace AdventOfCode\D10\Tests\Instruction;

use AdventOfCode\D10\Instruction\HighForBotInstruction;
use AdventOfCode\D10\Instruction\HighToOutputInstruction;
use AdventOfCode\D10\Instruction\LowForBotInstruction;
use AdventOfCode\D10\Instruction\LowToOutputInstruction;
use AdventOfCode\D10\Instruction\SetValueInstruction;
use AdventOfCode\D10\Instruction\InstructionFactory;

/**
 * @property InstructionFactory factory
 */
class InstructionFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->factory = new InstructionFactory();
    }

    public function test_that_factory_can_create_InitBotInstruction()
    {
        $instruction = $this->factory->create('value 2 goes to bot 143');
        $this->assertInstanceOf(SetValueInstruction::class, $instruction);
        $this->assertEquals(2, $instruction->getValue());
        $this->assertEquals(143, $instruction->getBotIndex());
    }

    public function test_that_factory_can_create_LowForBotInstruction()
    {
        $instruction = $this->factory->create('bot 12 gives low to bot 65');
        $this->assertInstanceOf(LowForBotInstruction::class, $instruction);
        $this->assertEquals(12, $instruction->getBotIndex());
        $this->assertEquals(65, $instruction->getLowBotIndex());
    }

    public function test_that_factory_can_create_HighForBotInstruction()
    {
        $instruction = $this->factory->create('bot 12 gives high to bot 65');
        $this->assertInstanceOf(HighForBotInstruction::class, $instruction);
        $this->assertEquals(12, $instruction->getBotIndex());
        $this->assertEquals(65, $instruction->getHighBotIndex());
    }

    public function test_that_factory_can_create_LowToOutputInstruction()
    {
        $instruction = $this->factory->create('bot 12 gives low to output 65');
        $this->assertInstanceOf(LowToOutputInstruction::class, $instruction);
        $this->assertEquals(12, $instruction->getBotIndex());
        $this->assertEquals(65, $instruction->getLowBotIndex());
    }

    public function test_that_factory_can_create_HighToOutputInstruction()
    {
        $instruction = $this->factory->create('bot 12 gives high to output 65');
        $this->assertInstanceOf(HighToOutputInstruction::class, $instruction);
        $this->assertEquals(12, $instruction->getBotIndex());
        $this->assertEquals(65, $instruction->getHighBotIndex());
    }
}
