<?php

namespace AdventOfCode\D10\Event;

use AdventOfCode\D10\Instruction\LowForBotInstruction;
use Symfony\Component\EventDispatcher\Event;

class LowForBotEvent extends Event
{
    /**
     * @var LowForBotInstruction
     */
    private $instruction;

    /**
     * @param LowForBotInstruction $instruction
     */
    public function __construct(LowForBotInstruction $instruction)
    {
        $this->instruction = $instruction;
    }

    /**
     * @return LowForBotInstruction
     */
    public function getInstruction(): LowForBotInstruction
    {
        return $this->instruction;
    }
}
