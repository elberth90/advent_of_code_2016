<?php

namespace AdventOfCode\D10\Instruction;

class InstructionFactory
{
    const IS_INIT_BOT = '|value (?P<value>\d+) goes to bot (?P<botIndex>\d+)|';
    const IS_LOW_FOR_BOT = '|^bot (?P<botIndex>\d+) gives low to bot (?P<lowBotIndex>\d+)|';
    const IS_HIGH_FOR_BOT = '|^bot (?P<botIndex>\d+) gives high to bot (?P<highBotIndex>\d+)|';
    const IS_LOW_TO_OUTPUT = '|^bot (?P<botIndex>\d+) gives low to output (?P<lowBotIndex>\d+)|';
    const IS_HIGH_TO_OUTPUT = '|^bot (?P<botIndex>\d+) gives high to output (?P<highBotIndex>\d+)|';

    /**
     * @param string $instruction
     *
     * @return Instruction
     */
    public function create(string $instruction): Instruction
    {
        if (preg_match(self::IS_INIT_BOT, $instruction, $match)) {
            return new SetValueInstruction($match['botIndex'], $match['value']);
        }

        if (preg_match(self::IS_LOW_FOR_BOT, $instruction, $match)) {
            return new LowForBotInstruction($match['botIndex'], $match['lowBotIndex']);
        }

        if (preg_match(self::IS_HIGH_FOR_BOT, $instruction, $match)) {
            return new HighForBotInstruction($match['botIndex'], $match['highBotIndex']);
        }

        if (preg_match(self::IS_LOW_TO_OUTPUT, $instruction, $match)) {
            return new LowToOutputInstruction($match['botIndex'], $match['lowBotIndex']);
        }

        if (preg_match(self::IS_HIGH_TO_OUTPUT, $instruction, $match)) {
            return new HighToOutputInstruction($match['botIndex'], $match['highBotIndex']);
        }
    }
}
