<?php

namespace AdventOfCode;

class Position
{
    /**
     * @var Direction
     */
    private $direction;

    /**
     * @var Coord
     */
    private $coord;

    private $coordMapping = [
        Direction::LEFT => [
            Direction::NORTH => [Position::class, 'subX'],
            Direction::WEST => [Position::class, 'subY'],
            Direction::SOUTH => [Position::class, 'addX'],
            Direction::EAST => [Position::class, 'addY'],
        ],
        Direction::RIGHT => [
            Direction::NORTH => [Position::class, 'addX'],
            Direction::WEST => [Position::class, 'addY'],
            Direction::SOUTH => [Position::class, 'subX'],
            Direction::EAST => [Position::class, 'subY'],
        ],
    ];

    /**
     * @param Direction $direction
     * @param Coord     $coord
     */
    public function __construct(Direction $direction, Coord $coord)
    {
        $this->direction = $direction;
        $this->coord = $coord;
    }

    /**
     * @param Instruction $instruction
     *
     * @return Coord
     */
    public function move(Instruction $instruction)
    {
        $turn = $this->direction->map($instruction->getDirection());
        $distance = $instruction->getDistance();

        call_user_func($this->coordMapping[$turn][$this->direction->getCurrent()], $distance);
        $this->direction->turn($turn);
    }

    /**
     * @return Coord
     */
    public function getCoord(): Coord
    {
        return $this->coord;
    }

    /**
     * @param int $distance
     */
    private function addX(int $distance)
    {
        $this->coord = new Coord($this->coord->getX() + $distance, $this->coord->getY());
    }

    /**
     * @param int $distance
     */
    private function addY(int $distance)
    {
        $this->coord = new Coord($this->coord->getX(), $this->coord->getY() + $distance);
    }

    /**
     * @param int $distance
     */
    private function subX(int $distance)
    {
        $this->coord = new Coord($this->coord->getX() - $distance, $this->coord->getY());
    }

    /**
     * @param int $distance
     */
    private function subY(int $distance)
    {
        $this->coord = new Coord($this->coord->getX(), $this->coord->getY() - $distance);
    }
}
