<?php

namespace AdventOfCode;

class Direction
{
    const NORTH = 'north';
    const SOUTH = 'south';
    const EAST = 'east';
    const WEST = 'west';

    const LEFT = 'left';
    const RIGHT = 'right';

    private $directionMap = [
        self::LEFT => [
            self::NORTH => self::WEST,
            self::WEST => self::SOUTH,
            self::SOUTH => self::EAST,
            self::EAST => self::NORTH,
        ],
        self::RIGHT => [
            self::NORTH => self::EAST,
            self::WEST => self::NORTH,
            self::SOUTH => self::WEST,
            self::EAST => self::SOUTH,
        ],
    ];

    /**
     * @var string
     */
    private $current;

    /**
     * Direction constructor.
     *
     * @param string $current
     */
    public function __construct(string $current)
    {
        $this->current = $current;
    }

    /**
     * @param string $turn
     *
     * @return string
     */
    public function turn(string $turn)
    {
        if (self::LEFT === $turn) {
            $this->current = $this->getForTurn(self::LEFT);
            return;
        }

        $this->current = $this->getForTurn(self::RIGHT);
    }

    /**
     * @param string $turn
     *
     * @return string
     */
    private function getForTurn(string $turn): string
    {
        return $this->directionMap[$turn][$this->current];
    }

    /**
     * @return string
     */
    public function getCurrent(): string
    {
        return $this->current;
    }

    /**
     * @param string $turn
     *
     * @return string
     */
    public function map(string $turn): string
    {
        if ('R' === $turn) {
            return self::RIGHT;
        }

        if ('L' === $turn) {
            return self::LEFT;
        }
    }
}
