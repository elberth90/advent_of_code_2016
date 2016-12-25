<?php

namespace AdventOfCode\D10\Event;

use AdventOfCode\D10\Instruction\LowToOutputInstruction;
use Symfony\Component\EventDispatcher\Event;

class LowToOutputEvent extends Event
{
    /**
     * @var LowToOutputInstruction
     */
    private $instruction;

    /**
     * @param LowToOutputInstruction $instruction
     */
    public function __construct(LowToOutputInstruction $instruction)
    {
        $this->instruction = $instruction;
    }

    /**
     * @return LowToOutputInstruction
     */
    public function getInstruction(): LowToOutputInstruction
    {
        return $this->instruction;
    }
}
