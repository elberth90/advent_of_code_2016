<?php

namespace AdventOfCode\D2\Tests;

use AdventOfCode\D2\Instruction\CommandInstruction;
use AdventOfCode\D2\Instruction\NextLineInstruction;
use AdventOfCode\D2\ValueCheckDecorator;

class ValueCheckDecoratorTest extends \PHPUnit_Framework_TestCase
{
    const CUSTOM_KEPYAD = [
        [null, null, 1, null, null],
        [null, 2, 3, 4, null, null],
        [5, 6, 7, 8, 9],
        [null, 'A', 'B', 'C', null],
        [null, null, 'D', null, null],
    ];

    /**
     * @dataProvider instructionProvider
     */
    public function test_that_proper_code_will_be_produced($instructions, $expectedCode)
    {
        $decorator = new ValueCheckDecorator(self::CUSTOM_KEPYAD, 2, 0);

        foreach ($instructions as $instruction) {
            $decorator->enter($instruction);
        }
        $this->assertEquals($expectedCode, $decorator->getCode());
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
                '$expectedCode' => '5DB3',
            ],
        ];
    }
}
