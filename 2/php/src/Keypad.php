<?php

namespace AdventOfCode;

use AdventOfCode\Instruction\Instruction;

class Keypad
{
    const DEFAULT_KEYPAD = [
        [1, 2, 3],
        [4, 5, 6],
        [7, 8, 9],
    ];


    /**
     * @var int
     */
    protected $currentRow = 1;

    /**
     * @var int
     */
    protected $currentCol = 1;

    /**
     * @var array
     */
    private $code = [];

    /**
     * @var array
     */
    private $keypad = null;

    /**
     * @var int
     */
    private $maxRows;

    /**
     * @var
     */
    private $maxCols;

    /**
     * @param array|null $customKeypad
     * @param int        $startRow
     * @param int        $startCol
     */
    public function __construct(array $customKeypad = null, int $startRow = null, int $startCol = null)
    {
        $this->keypad = $customKeypad ?: self::DEFAULT_KEYPAD;
        if (!is_null($startRow)) {
            $this->currentRow = $startRow;
        }

        if (!is_null($startCol)) {
            $this->currentCol = $startCol;
        }

        $this->prepareBorders();
    }

    private function prepareBorders()
    {
        $this->maxRows = count($this->keypad) - 1;
        $this->maxCols = count(reset($this->keypad)) - 1;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return implode('', $this->code);
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
        $this->code[] = $this->keypad[$this->currentRow][$this->currentCol];
    }

    /**
     * @param string $command
     */
    private function processCommand(string $command)
    {
        if (in_array($command, ['U', 'D'])) {
            $nextRow = ('D' === $command) ? $this->currentRow + 1 : $this->currentRow - 1;
            if ($nextRow >= 0 && $nextRow <= $this->maxRows) {
                $this->currentRow = $nextRow;
            }

        }

        if (in_array($command, ['L', 'R'])) {
            $nextCol = ('R' === $command) ? $this->currentCol + 1 : $this->currentCol - 1;
            if ($nextCol >= 0 && $nextCol <= $this->maxCols) {
                $this->currentCol = $nextCol;
            }
        }
    }
}
