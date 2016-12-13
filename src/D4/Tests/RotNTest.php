<?php

namespace AdventOfCode\D4\Tests;

use AdventOfCode\D4\RotN;

class RotNTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider rotProvider
     */
    public function test_rotN($text, $n, $expected)
    {
        $result = RotN::rot($text, $n);
        $this->assertEquals($expected, $result);
    }

    /**
     * @return array
     */
    public function rotProvider(): array
    {
        return [
            [
                '$string' => 'foo bar',
                '$n' => 25,
                '$expected' => 'enn azq',
            ],
            [
                '$string' => 'foo bar',
                '$n' => 22,
                '$expected' => 'bkk xwn',
            ],
        ];
    }
}
