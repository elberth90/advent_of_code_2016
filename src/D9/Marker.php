<?php


namespace AdventOfCode\D9;

class Marker
{
    /**
     * @var string
     */
    private $command;

    /**
     * @var int
     */
    private $subsequentLength;

    /**
     * @var int
     */
    private $repeat;

    /**
     * @param string $command
     */
    public function __construct(string $command)
    {
        $this->command = $command;

        preg_match('|(?P<seq>\d*)x(?P<repeat>\d*)|', $command, $match);
        $this->subsequentLength = $match['seq'];
        $this->repeat = $match['repeat'];
    }

    /**
     * @return string
     */
    public function getCommand(): string
    {
        return $this->command;
    }

    /**
     * @return int
     */
    public function getSubsequentLength(): int
    {
        return $this->subsequentLength;
    }

    /**
     * @return int
     */
    public function getRepeat(): int
    {
        return $this->repeat;
    }
}
