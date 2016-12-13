<?php

namespace AdventOfCode\D8\Instruction;

use AdventOfCode\D8\Exceptions\InvalidInstructionException;

class InstructionFactory
{
    const IS_RECT = 'rect';
    const IS_ROTATE_ROW = 'rotate row';
    const IS_ROTATE_COL = 'rotate col';

    /**
     * @param string $givenInstruction
     *
     * @return Instruction
     * @throws InvalidInstructionException
     */
    public function create(string $givenInstruction): Instruction
    {
        if (false !== strpos($givenInstruction, self::IS_RECT)) {
            return $this->buildRectInstruction($givenInstruction);
        }

        if (false !== strpos($givenInstruction, self::IS_ROTATE_ROW)) {
            return $this->buildRotateRowInstruction($givenInstruction);
        }

        if (false !== strpos($givenInstruction, self::IS_ROTATE_COL)) {
            return $this->buildRotateColInstruction($givenInstruction);
        }

        throw new InvalidInstructionException();
    }

    /**
     * @param string $instruction
     *
     * @return RectInstruction
     * @throws InvalidInstructionException
     */
    private function buildRectInstruction(string $instruction): RectInstruction
    {
        $matches = null;
        if (false === preg_match('|(?P<cols>(\d)*)(?:x)(?P<rows>(\d)*)|', $instruction, $matches)) {
            throw new InvalidInstructionException();
        }

        return new RectInstruction((int)$matches['cols'], (int)$matches['rows']);
    }

    /**
     * @param string $instruction
     *
     * @return RotateRowInstruction
     * @throws InvalidInstructionException
     */
    private function buildRotateRowInstruction(string $instruction): RotateRowInstruction
    {
        $matches = null;
        if (false === preg_match('|(?:y=)(?P<row>(\d)*)\sby\s(?P<value>(\d)*)|', $instruction, $matches)) {
            throw new InvalidInstructionException();
        }

        return new RotateRowInstruction((int)$matches['row'], (int)$matches['value']);
    }

    /**
     * @param string $instruction
     *
     * @return RotateColInstruction
     * @throws InvalidInstructionException
     */
    private function buildRotateColInstruction(string $instruction): RotateColInstruction
    {
        $matches = null;
        if (false === preg_match('|(?:x=)(?P<col>(\d)*)\sby\s(?P<value>(\d)*)|', $instruction, $matches)) {
            throw new InvalidInstructionException();
        }

        return new RotateColInstruction((int)$matches['col'], (int)$matches['value']);
    }
}
