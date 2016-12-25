<?php

namespace AdventOfCode\D10\StreamHandler;

use MongoDB\Driver\Command;

class StreamHandler
{
    const INIT_FILTER = 1;
    const COMMAND_FILTER = 2;

    /**
     * @var string
     */
    private $path;

    /**
     * @var resource
     */
    private $stream;
    /**
     * @var int
     */
    private $filter;

    /**
     * StreamHandler constructor.
     *
     * @param string $path
     * @param int    $filter
     */
    public function __construct(string $path, int $filter = null)
    {
        $this->path = $path;
        $this->filter = $filter;
        $this->openStream();
    }

    private function openStream()
    {
        $this->stream = fopen($this->path, 'rw+');
        if (static::INIT_FILTER === $this->filter) {
            stream_filter_register('initBot', InitBotStreamFilter::class);
            stream_filter_append($this->stream, "initBot");
        }

        if (static::COMMAND_FILTER === $this->filter) {
            stream_filter_register('command', CommandStreamFilter::class);
            stream_filter_append($this->stream, "command");
        }
    }

    /**
     * @return \Generator|string
     */
    public function getLine(): \Generator
    {
        while (($line = fgets($this->stream)) !== false) {
            yield trim($line);
        }
        rewind($this->stream);
    }
}
