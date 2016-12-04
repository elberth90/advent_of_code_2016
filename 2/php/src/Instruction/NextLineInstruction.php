<?php

namespace AdventOfCode\Instruction;

class NextLineInstruction implements Instruction
{
    /**
     * @var string
     */
    private $command;

    /**
     * @param string $command
     */
    public function __construct(string $command)
    {
        $this->command = $command;
    }

    /**
     * @inheritdoc
     */
    public function getType(): string
    {
        return self::NEXT_LINE;
    }

    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return $this->command;
    }
}
