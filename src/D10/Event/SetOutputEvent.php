<?php

namespace AdventOfCode\D10\Event;

use AdventOfCode\D10\Instruction\SetValueInstruction;
use Symfony\Component\EventDispatcher\Event;

class SetOutputEvent extends Event
{
    /**
     * @var SetValueInstruction
     */
    private $instruction;

    /**
     * @param SetValueInstruction $instruction
     */
    public function __construct(SetValueInstruction $instruction)
    {
        $this->instruction = $instruction;
    }

    /**
     * @return SetValueInstruction
     */
    public function getInstruction(): SetValueInstruction
    {
        return $this->instruction;
    }
}
