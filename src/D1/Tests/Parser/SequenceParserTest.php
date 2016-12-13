<?php

namespace AdventOfCode\D1\Tests\Parser;

use AdventOfCode\D1\Parser\SequenceParser;

/**
 * @property resource       resource
 * @property SequenceParser parser
 */
class SequenceParserTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->resource = $this->prepareStreamResource("A1, B2, C3,\n D4, E5,\n F6");
        $this->parser = new SequenceParser($this->resource);
    }

    /**
     * @param string $data
     *
     * @return resource
     */
    private function prepareStreamResource($data)
    {
        $stream = fopen('php://memory', 'r+');
        fwrite($stream, $data);
        rewind($stream);

        return $stream;
    }

    public function test_that_read_method_will_return_generator()
    {
        $result = $this->parser->read();
        $this->assertInstanceOf(\Generator::class, $result);

        $expected = ['A1', 'B2', 'C3', 'D4', 'E5', 'F6'];
        foreach ($result as $key => $line) {
            $this->assertEquals($expected[$key], $line);
        }
    }
}
