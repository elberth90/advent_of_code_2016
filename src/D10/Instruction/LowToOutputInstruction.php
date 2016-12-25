<?php

namespace AdventOfCode\D10\Instruction;

class LowToOutputInstruction implements Instruction
{
    /**
     * @var int
     */
    private $botIndex;

    /**
     * @var int
     */
    private $lowBotIndex;

    /**
     * @param int $botIndex
     * @param int $lowBotIndex
     */
    public function __construct(int $botIndex, int $lowBotIndex)
    {
        $this->botIndex = $botIndex;
        $this->lowBotIndex = $lowBotIndex;
    }

    /**
     * @return int
     */
    public function getBotIndex(): int
    {
        return $this->botIndex;
    }

    /**
     * @return int
     */
    public function getLowBotIndex(): int
    {
        return $this->lowBotIndex;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return self::LOW_TO_OUTPUT;
    }
}
