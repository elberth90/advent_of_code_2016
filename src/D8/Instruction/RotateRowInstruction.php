<?php

namespace AdventOfCode\D8\Instruction;

class RotateRowInstruction implements Instruction
{
    private $type = self::ROTATE_ROW;

    /**
     * @var int
     */
    private $row;

    /**
     * @var int
     */
    private $value;

    /**
     * @param int $row
     * @param int $value
     */
    public function __construct(int $row, int $value)
    {
        $this->row = $row;
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
    public function getRow(): int
    {
        return $this->row;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
