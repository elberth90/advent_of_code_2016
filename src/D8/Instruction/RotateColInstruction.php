<?php

namespace AdventOfCode\D8\Instruction;

class RotateColInstruction implements Instruction
{
    private $type = self::ROTATE_COL;

    /**
     * @var int
     */
    private $col;

    /**
     * @var int
     */
    private $value;

    /**
     * @param int $col
     * @param int $value
     */
    public function __construct(int $col, int $value)
    {
        $this->col = $col;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getCol(): int
    {
        return $this->col;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
