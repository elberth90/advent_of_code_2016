<?php

namespace AdventOfCode\D7\Tests;

use AdventOfCode\D7\Parser;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    private $data = "abba[mnop]qrst\n
                    abcd[bddb]xyyx\n
                    aaaa[qwer]tyui\n
                    ioxxoj[asdfgh]zxcvbn\n";

    public function test_that_parser_return_generator()
    {
        $parser = new Parser(
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
