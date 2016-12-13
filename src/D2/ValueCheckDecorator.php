<?php

namespace AdventOfCode\D2;

use AdventOfCode\D2\Instruction\Instruction;

class ValueCheckDecorator extends Keypad
{
    /**
     * @var array
     */
    private $customKeypad;

    /**
     * @param array $customKeypad
     * @param int   $startRow
     * @param int   $startCol
     */
    public function __construct(array $customKeypad, int $startRow, int $startCol)
    {
        parent::__construct($customKeypad, $startRow, $startCol);
        $this->customKeypad = $customKeypad;
    }

    public function enter(Instruction $instruction)
    {
        $row = $this->currentRow;
        $col = $this->currentCol;
        parent::enter($instruction);

        if (is_null($this->customKeypad[$this->currentRow][$this->currentCol])) {
            $this->currentRow = $row;
            $this->currentCol = $col;
        }
    }
}
