<?php

namespace AdventOfCode\D8;

use AdventOfCode\D8\Exceptions\InvalidInstructionException;
use AdventOfCode\D8\Instruction\Instruction;
use AdventOfCode\D8\Instruction\RectInstruction;
use AdventOfCode\D8\Instruction\RotateColInstruction;
use AdventOfCode\D8\Instruction\RotateRowInstruction;

class Display
{
    const ON = 'X';

    private static $supportedInstructions = [
        Instruction::RECT,
        Instruction::ROTATE_COL,
        Instruction::ROTATE_ROW,
    ];

    /**
     * @var int
     */
    private $cols;

    /**
     * @var int
     */
    private $rows;

    /**
     * @var array
     */
    private $pixels;

    /**
     * @param int $cols
     * @param int $rows
     */
    public function __construct(int $cols, int $rows)
    {
        $this->cols = $cols;
        $this->rows = $rows;

        $this->pixels = array_fill(0, $this->rows, []);
    }

    /**
     * @param Instruction $instruction
     *
     * @throws InvalidInstructionException
     */
    public function perform(Instruction $instruction)
    {
        if (!in_array($instruction->getType(), static::$supportedInstructions)) {
            throw new InvalidInstructionException();
        }
        if (Instruction::RECT === $instruction->getType()) {
            /** @var RectInstruction $instruction */
            $this->performRect($instruction);
        }

        if (Instruction::ROTATE_ROW === $instruction->getType()) {
            /** @var RotateRowInstruction $instruction */
            $this->performRotateRow($instruction);
        }

        if (Instruction::ROTATE_COL === $instruction->getType()) {
            /** @var RotateColInstruction $instruction */
            $this->performRotateCol($instruction);
        }
    }

    /**
     * @param RectInstruction $instruction
     */
    private function performRect(RectInstruction $instruction)
    {
        for ($i = 0; $i < $instruction->getRows(); $i++) {
            $this->pixels[$i] = $this->pixels[$i] + array_fill(0, $instruction->getCols(), self::ON);
        }
    }

    /**
     * @param RotateRowInstruction $instruction
     */
    private function performRotateRow(RotateRowInstruction $instruction)
    {
        $toChange = [];
        $row = $instruction->getRow();
        for ($i = 0; $i < $this->cols; $i++) {
            if (isset($this->pixels[$row][$i])) {
                $toChange[($i+$instruction->getValue())%$this->cols] = self::ON;
            }
        }

        for ($i = 0; $i < $this->cols; $i++) {
            if (isset($toChange[$i])) {
                $this->pixels[$row][$i] = self::ON;
                continue;
            }
            unset($this->pixels[$row][$i]);
        }
    }

    /**
     * @param RotateColInstruction $instruction
     */
    private function performRotateCol(RotateColInstruction $instruction)
    {
        $toChange = [];
        $col = $instruction->getCol();
        for ($i = 0; $i < $this->rows; $i++) {
            if (isset($this->pixels[$i][$col])) {
                $toChange[($i+$instruction->getValue())%$this->rows] = self::ON;
            }
        }

        for ($i = 0; $i < $this->rows; $i++) {
            if (isset($toChange[$i])) {
                   $this->pixels[$i][$col] = self::ON;
                   continue;
            }
            unset($this->pixels[$i][$col]);
        }
    }

    /**
     * @return int
     */
    public function countLitPixels(): int
    {
        return array_reduce($this->pixels, function(int $carry, array $item) {
            $carry += count($item);
            return $carry;
        }, 0);
    }

    public function printScreen()
    {
        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->cols; $j++) {
                if (isset($this->pixels[$i][$j])) {
                    echo $this->pixels[$i][$j];
                } else {
                    echo ' ';
                }
            }
            echo "\n";
        }
        echo "\n";
    }
}
