<?php

namespace AdventOfCode\D8\Instruction;

interface Instruction
{
    const RECT = 'rect';
    const ROTATE_ROW = 'rotate_row';
    const ROTATE_COL = 'rotate_col';

    public function getType(): string;
}
