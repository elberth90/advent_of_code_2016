<?php

namespace AdventOfCode\Instruction;

interface Instruction
{
    const COMMAND = 'command';
    const NEXT_LINE = 'next_line';

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return string
     */
    public function getCommand(): string;
}
