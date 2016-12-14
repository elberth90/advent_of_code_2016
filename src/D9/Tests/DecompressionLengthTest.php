<?php

namespace AdventOfCode\D9\Tests;

use AdventOfCode\D9\DecompressionLength;

class DecompressionLengthTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider compressedData
     */
    public function test_that_length_of_decompressed_text_data_will_be_returned_in_simple(
        string $data,
        int $expectedLength
    ) {
        $decompressionLength = new DecompressionLength();
        $result = $decompressionLength->simpleLength($data);
        $this->assertEquals($expectedLength, $result, $data);
    }

    /**
     * @dataProvider complexCompressedData
     */
    public function test_that_length_of_decompressed_text_data_will_be_returned_in_complex(
        string $data,
        int $expectedLength
    ) {
        $decompressionLength = new DecompressionLength();
        $result = $decompressionLength->complexLength($data);
        $this->assertEquals($expectedLength, $result, $data);
    }

    /**
     * @return array
     */
    public function compressedData(): array
    {
        return [
            [
                '$data' => 'ADVENT',
                '$expectedLength' => 6,
            ],
            [
                '$data' => 'A(1x5)BC',
                '$expectedLength' => 7,
            ],
            [
                '$data' => '(3x3)XYZ',
                '$expectedLength' => 9,
            ],
            [
                '$data' => 'A(2x2)BCD(2x2)EFG',
                '$expectedLength' => 11,
            ],
            [
                '$data' => '(6x1)(1x3)A',
                '$expectedLength' => 6,
            ],
            [
                '$data' => 'X(8x2)(3x3)ABCY',
                '$expectedLength' => 18,
            ],
            [
                '$data' => 'X(8x2)(3x3)ABCY(5x5)(1x2)(3x2)XAV(2x2)XX',
                '$expectedLength' => 53,
            ],
        ];
    }

    /**
     * @return array
     */
    public function complexCompressedData(): array
    {
        return [
            [
                '$data' => '(3x3)XYZ',
                '$expectedLength' => 9,
            ],
            [
                '$data' => 'X(8x2)(3x3)ABCY',
                '$expectedLength' => 20,
            ],
            [
                '$data' => '(27x12)(20x12)(13x14)(7x10)(1x12)A',
                '$expectedLength' => 241920,
            ],
            [
                '$data' => '(25x3)(3x3)ABC(2x3)XY(5x2)PQRSTX(18x9)(3x2)TWO(5x7)SEVEN',
                '$expectedLength' => 445,
            ],
        ];
    }
}
