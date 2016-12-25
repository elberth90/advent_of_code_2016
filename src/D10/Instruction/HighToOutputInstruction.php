<?php

namespace AdventOfCode\D10\Instruction;

class HighToOutputInstruction implements Instruction
{
    /**
     * @var int
     */
    private $botIndex;

    /**
     * @var int
     */
    private $highBotIndex;

    /**
     * @param int $botIndex
     * @param int $highBotIndex
     */
    public function __construct(int $botIndex, int $highBotIndex)
    {
        $this->botIndex = $botIndex;
        $this->highBotIndex = $highBotIndex;
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
    public function getHighBotIndex(): int
    {
        return $this->highBotIndex;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return self::HIGH_TO_OUTPUT;
    }
}
