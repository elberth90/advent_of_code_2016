<?php

namespace AdventOfCode\D2\Instruction;

class InstructionFactory
{
    private $availableCommands = ['U', 'D', 'L', 'R'];
    private $nextLineCommands = ['N'];

    /**
     * @param string $command
     *
     * @return Instruction
     */
    public function create(string $command)
    {
        if (in_array($command, $this->availableCommands)) {
            return new CommandInstruction($command);
        }

        if (in_array($command, $this->nextLineCommands)) {
            return new NextLineInstruction($command);
        }
    }
}
