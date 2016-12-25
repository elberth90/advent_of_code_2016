<?php

namespace AdventOfCode\D10\Instruction;

class SetValueInstruction implements Instruction
{
    /**
     * @var int
     */
    private $botIndex;

    /**
     * @var int
     */
    private $value;

    /**
     * @param int $botIndex
     * @param int $value
     */
    public function __construct(int $botIndex, int $value)
    {
        $this->botIndex = $botIndex;
        $this->value = $value;
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
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return self::INIT_BOT;
    }
}
