<?php

namespace AdventOfCode\D8\Tests;

use AdventOfCode\D8\Display;
use AdventOfCode\D8\Instruction\RectInstruction;
use AdventOfCode\D8\Instruction\RotateColInstruction;
use AdventOfCode\D8\Instruction\RotateRowInstruction;

class DisplayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider instructionProvider
     */
    public function test_display_can_return_lit_pixels(int $cols, int $rows, array $instructions, int $expected)
    {
        $display = new Display($cols, $rows);
        foreach ($instructions as $instruction) {
            $display->perform($instruction);
        }

        $this->assertEquals($expected, $display->countLitPixels());
    }

    /**
     * @return array
     */
    public function instructionProvider(): array
    {
        return [
            [
                '$cols' => 7,
                '$rows' => 3,
                '$instructions' => [
                    new RectInstruction(3, 2),
                    new RotateColInstruction(1, 1),
                    new RotateRowInstruction(0, 4),
                    new RotateColInstruction(1, 1),
                ],
                '$expected' => 6,
            ],
            [
                '$cols' => 7,
                '$rows' => 3,
                '$instructions' => [
                    new RectInstruction(2, 2),
                    new RotateRowInstruction(0, 3),
                    new RotateRowInstruction(1, 3),
                    new RectInstruction(2, 2),

                ],
                '$expected' => 8,
            ],
        ];
    }
}
