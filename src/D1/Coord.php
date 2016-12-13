<?php

namespace AdventOfCode\D1;

class Coord
{
    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;

    /**
     * Coord constructor.
     *
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

//    /**
//     * @param int $x
//     *
//     * @return Coord
//     */
//    public function setX(int $x): Coord
//    {
//        $this->x = $x;
//
//        return $this;
//    }
//
//    /**
//     * @param int $y
//     *
//     * @return Coord
//     */
//    public function setY(int $y): Coord
//    {
//        $this->y = $y;
//
//        return $this;
//    }
}
