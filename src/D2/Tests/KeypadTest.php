<?php

namespace AdventOfCode\D2\Tests;

use AdventOfCode\D2\Instruction\CommandInstruction;
use AdventOfCode\D2\Instruction\NextLineInstruction;
use AdventOfCode\D2\Keypad;

class KeypadTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider instructionProvider
     */
    public function test_that_proper_code_will_be_produced($instructions, $expectedCode)
    {
        $keypad = new Keypad();

        foreach ($instructions as $instruction) {
            $keypad->enter($instruction);
        }
        $this->assertEquals($expectedCode, $keypad->getCode());
    }

    /**
     * @return array
     */
    public function instructionProvider(): array
    {
        return [
            [
                '$instructions' => [
                    new CommandInstruction('U'),
                    new CommandInstruction('L'),
                    new CommandInstruction('L'),
                    new NextLineInstruction('N'),
                    new CommandInstruction('R'),
                    new CommandInstruction('R'),
                    new CommandInstruction('D'),
                    new CommandInstruction('D'),
                    new CommandInstruction('D'),
                    new NextLineInstruction('N'),
                    new CommandInstruction('L'),
                    new CommandInstruction('U'),
                    new CommandInstruction('R'),
                    new CommandInstruction('D'),
                    new CommandInstruction('L'),
                    new NextLineInstruction('N'),
                    new CommandInstruction('U'),
                    new CommandInstruction('U'),
                    new CommandInstruction('U'),
                    new CommandInstruction('U'),
                    new CommandInstruction('D'),
                    new NextLineInstruction('N'),
                ],
                '$expectedCode' => 1985,
            ],
            [
                '$instructions' => [
                    new CommandInstruction('U'),
                    new NextLineInstruction('N'),
                    new CommandInstruction('L'),
                    new NextLineInstruction('N'),
                    new CommandInstruction('R'),
                    new CommandInstruction('R'),
                    new NextLineInstruction('N'),
                    new CommandInstruction('D'),
                    new NextLineInstruction('N'),
                ],
                '$expectedCode' => 2136,
            ],
            [
                '$instructions' => [
                    new CommandInstruction('U'),
                    new CommandInstruction('D'),
                    new CommandInstruction('D'),
                    new CommandInstruction('L'),
                    new CommandInstruction('R'),
                    new CommandInstruction('L'),
                    new NextLineInstruction('N'),
                    new CommandInstruction('L'),
                    new CommandInstruction('R'),
                    new CommandInstruction('L'),
                    new CommandInstruction('L'),
                    new CommandInstruction('L'),
                    new CommandInstruction('L'),
                    new CommandInstruction('R'),
                    new CommandInstruction('U'),
                    new CommandInstruction('D'),
                    new NextLineInstruction('N'),
                    new CommandInstruction('U'),
                    new CommandInstruction('U'),
                    new NextLineInstruction('N'),
                    new CommandInstruction('L'),
                    new CommandInstruction('R'),
                    new CommandInstruction('L'),
                    new CommandInstruction('L'),
                    new CommandInstruction('L'),
                    new CommandInstruction('R'),
                    new CommandInstruction('R'),
                    new CommandInstruction('R'),
                    new CommandInstruction('D'),
                    new NextLineInstruction('N'),
                ],
                '$expectedCode' => 7826,
            ],
        ];
    }

    /**
     * @dataProvider customKeypad
     */
    public function test_that_proper_code_will_be_produced_with_custom_keypad(
        $customKeypad,
        $instructions,
        $expectedCode
    ) {
        $keypad = new Keypad($customKeypad);

        foreach ($instructions as $instruction) {
            $keypad->enter($instruction);
        }
        $this->assertEquals($expectedCode, $keypad->getCode());
    }

    /**
     * @return array
     */
    public function customKeypad(): array
    {
        return [
            [
                '$customKeypad' => [
                    [3, 2, 1],
                    [6, 5, 4],
                    [9, 8, 7],
                ],
                '$instructions' => [
                    new CommandInstruction('U'),
                    new NextLineInstruction('N'),
                    new CommandInstruction('L'),
                    new NextLineInstruction('N'),
                    new CommandInstruction('R'),
                    new CommandInstruction('R'),
                    new NextLineInstruction('N'),
                    new CommandInstruction('D'),
                    new NextLineInstruction('N'),
                ],
                '$expectedCode' => 2314,
            ],
        ];
    }
}
