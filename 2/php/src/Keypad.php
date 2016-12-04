<?php

namespace AdventOfCode;

use AdventOfCode\Instruction\Instruction;

class Keypad
{
    const MIN_ROW = 0;
    const MAX_ROW = 2;
    const MIN_COL = 0;
    const MAX_COL = 2;


    /**
     * @var int
     */
    private $currentRow = 1;

    /**
     * @var int
     */
    private $currentCol = 1;

    /**
     * @var array
     */
    private $code = [];

    /**
     * @var array
     */
    private $keys = [
        [1, 2, 3],
        [4, 5, 6],
        [7, 8, 9],
    ];

    /**
     * @return int
     */
    public function getCode(): int
    {
        return sprintf('%d', implode('', $this->code));
    }

    /**
     * @param Instruction $instruction
     */
    public function enter(Instruction $instruction)
    {
        if (Instruction::NEXT_LINE === $instruction->getType()) {
            $this->processNextLine();
        }

        if (Instruction::COMMAND === $instruction->getType()) {
            $this->processCommand($instruction->getCommand());
        }
    }

    private function processNextLine()
    {
        $this->code[] = $this->keys[$this->currentRow][$this->currentCol];
    }

    /**
     * @param string $command
     */
    private function processCommand(string $command)
    {
        if (in_array($command, ['U', 'D'])) {
            $nextRow = ('D' === $command) ? $this->currentRow + 1 : $this->currentRow - 1;
            if ($nextRow >= self::MIN_ROW && $nextRow <= self::MAX_ROW) {
                $this->currentRow = $nextRow;
            }

        }

        if (in_array($command, ['L', 'R'])) {
            $nextCol = ('R' === $command) ? $this->currentCol + 1 : $this->currentCol - 1;
            if ($nextCol >= self::MIN_COL && $nextCol <= self::MAX_COL) {
                $this->currentCol = $nextCol;
            }
        }
    }
}
