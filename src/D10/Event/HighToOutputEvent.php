<?php

namespace AdventOfCode\D10\Event;

use AdventOfCode\D10\Instruction\HighToOutputInstruction;
use Symfony\Component\EventDispatcher\Event;

class HighToOutputEvent extends Event
{
    /**
     * @var HighToOutputInstruction
     */
    private $instruction;

    /**
     * @param HighToOutputInstruction $instruction
     */
    public function __construct(HighToOutputInstruction $instruction)
    {
        $this->instruction = $instruction;
    }

    /**
     * @return HighToOutputInstruction
     */
    public function getInstruction(): HighToOutputInstruction
    {
        return $this->instruction;
    }
}
