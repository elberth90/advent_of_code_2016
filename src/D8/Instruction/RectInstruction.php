<?php

namespace AdventOfCode\D8\Instruction;

class RectInstruction implements Instruction
{
    private $type = self::RECT;

    /**
     * @var int
     */
    private $cols;

    /**
     * @var int
     */
    private $rows;

    /**
     * @param int $cols
     * @param int $rows
     */
    public function __construct(int $cols, int $rows)
    {
        $this->cols = $cols;
        $this->rows = $rows;
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
    public function getCols(): int
    {
        return $this->cols;
    }

    /**
     * @return int
     */
    public function getRows(): int
    {
        return $this->rows;
    }
}
