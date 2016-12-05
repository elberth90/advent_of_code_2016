<?php

namespace AdventOfCode;

interface CodeCracker
{
    const PROPER_BEGINNING = '00000';
    const PROPER_BEGINNING_LENGTH = 5;
    const PROPER_BEGINNING_START_FROM = 0;
    const CODE_LENGTH = 8;

    /**
     * @return string
     */
    public function getCode(): string;
}
