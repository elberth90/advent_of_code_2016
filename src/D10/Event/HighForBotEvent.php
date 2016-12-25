<?php

namespace AdventOfCode\D10\Event;

use AdventOfCode\D10\Instruction\HighForBotInstruction;
use Symfony\Component\EventDispatcher\Event;

class HighForBotEvent extends Event
{
    /**
     * @var HighForBotInstruction
     */
    private $instruction;

    /**
     * @param HighForBotInstruction $instruction
     */
    public function __construct(HighForBotInstruction $instruction)
    {
        $this->instruction = $instruction;
    }

    /**
     * @return HighForBotInstruction
     */
    public function getInstruction(): HighForBotInstruction
    {
        return $this->instruction;
    }
}
