<?php

namespace AdventOfCode\Utils\Tests;

use AdventOfCode\Utils\LineReader;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    private $data = "aaaaaaaa \n
                    bbbbbb\n
                    cccccc\n
                    ddddddd\n";

    public function test_that_parser_return_generator()
    {
        $parser = new LineReader(
            $this->getStreamResource($this->data)
        );

        /** @var \Generator $generator */
        $generator = $parser->read();
        $this->isInstanceOf(\Generator::class, $generator);
        foreach (explode("\n", $this->data) as $item) {
            $this->assertEquals(trim($item), $generator->current());
            $generator->next();
        }
    }

    /**
     * @param string $data
     *
     * @return resource
     */
    private function getStreamResource($data)
    {
        $stream = fopen('php://memory', 'r+');
        fwrite($stream, $data);
        rewind($stream);

        return $stream;
    }
}
