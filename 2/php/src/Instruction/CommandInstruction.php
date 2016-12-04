<?php

namespace AdventOfCode\Instruction;

class CommandInstruction implements Instruction
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
        return self::COMMAND;
    }

    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return $this->command;
    }
}
