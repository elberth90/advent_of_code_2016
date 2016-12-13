<?php

namespace AdventOfCode\D1;

class Instruction
{
    /**
     * @var string
     */
    private $direction;

    /**
     * @var string
     */
    private $distance;

    public function __construct($command)
    {
        $this->direction = $command[0];
        $this->distance = substr($command, 1);
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @return string
     */
    public function getDistance(): string
    {
        return $this->distance;
    }
}
