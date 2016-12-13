<?php

namespace AdventOfCode\D1\Parser;

class SequenceParser
{
    const SEPARATOR = ',';

    /**
     * @var resource
     */
    private $dataStream;

    /**
     * @param resource $dataStream
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
            foreach (explode(self::SEPARATOR, $this->prepare($line)) as $command) {
                if ($command) {
                    yield trim($command);
                }
            }
        }
        rewind($this->dataStream);
    }

    private function prepare(string $line): string
    {
        return trim(rtrim($line, "\r\n"));
    }
}
