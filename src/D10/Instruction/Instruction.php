<?php

namespace AdventOfCode\D10\Instruction;

interface Instruction
{
    const INIT_BOT = 1;
    const LOW_FOR_BOT = 2;
    const HIGH_FOR_BOT = 3;
    const LOW_TO_OUTPUT = 4;
    const HIGH_TO_OUTPUT = 5;

    /**
     * @return int
     */
    public function getType(): int;
}
