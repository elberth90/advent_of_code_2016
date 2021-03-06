<?php

namespace AdventOfCode\Utils;

class LineReader
{
    /**
     * @var resource
     */
    private $dataStream;

    /**
     * Parser constructor.
     *
     * @param $dataStream
     */
    public function __construct($dataStream)
    {
        $this->dataStream = $dataStream;
    }

    /**
     * @return \Generator
     */
    public function read(): \Generator
    {
        while (($line = fgets($this->dataStream)) !== false) {
            yield trim($line);
        }
        rewind($this->dataStream);
    }
}
