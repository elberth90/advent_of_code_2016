<?php

namespace AdventOfCode\D6\Tests;

use AdventOfCode\D6\Parser;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    private $data = "eedadn\n
                    drvtee\n
                    eandsr\n
                    raavrd\n
                    atevrs\n
                    tsrnev\n
                    sdttsa\n
                    rasrtv\n
                    nssdts\n
                    ntnada\n
                    svetve\n
                    tesnvt\n
                    vntsnd\n
                    vrdear\n
                    dvrsen\n
                    enarar\n";

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
