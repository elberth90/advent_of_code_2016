<?php

namespace AdventOfCode\D1;

class VisitedDecorator
{
    const MINIMUM_POINTS = 5;

    /**
     * @var Coord[]
     */
    public $metPoints = [];

    /**
     * @var Position
     */
    private $position;

    /**
     * @var Coord|null
     */
    private $intersectionCoord;

    public function __construct(Position $position)
    {
        $this->position = $position;
        $this->metPoints[] = $this->position->getCoord();
    }

    /**
     * @param Instruction $instruction
     */
    public function move(Instruction $instruction)
    {
        $this->position->move($instruction);
        $this->metPoints[] = $this->position->getCoord();

    }

    /**
     * @return bool
     */
    public function isVisitedTwice(): bool
    {
        if (count($this->metPoints) < self::MINIMUM_POINTS) {
            return false;
        }

        $lastPoint = end($this->metPoints);
        $prevPoint = $this->metPoints[count($this->metPoints) - 2];

        for ($i = 0; $i < count($this->metPoints) - 3; $i++) {
            $endPoint = $this->metPoints[$i + 1];
            $startPoint = $this->metPoints[$i];

            if ($this->areIntersection($lastPoint, $prevPoint, $endPoint, $startPoint)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param Coord $lastPoint
     * @param Coord $prevPoint
     * @param Coord $endPoint
     * @param Coord $startPoint
     *
     * @return bool
     */
    public function areIntersection(Coord $lastPoint, Coord $prevPoint, Coord $endPoint, Coord $startPoint): bool
    {
        list ($A1, $B1, $C1) = $this->defineLine($lastPoint, $prevPoint);
        list ($A2, $B2, $C2) = $this->defineLine($endPoint, $startPoint);

        $det = $A1 * $B2 - $A2 * $B1;
        if (0 != $det) {
            $x = ($B2 * $C1 - $B1 * $C2) / $det;
            $y = ($A1 * $C2 - $A2 * $C1) / $det;

            $possibleIntersection = new Coord($x, $y);

            if (
                $this->isOnLine($possibleIntersection, $prevPoint, $lastPoint) &&
                $this->isOnLine($possibleIntersection, $endPoint, $startPoint)
            ) {
                $this->intersectionCoord = new Coord($x, $y);

                return true;
            }
        }

        return false;
    }

    /**
     * @param Coord $firstPoint
     * @param Coord $secondPoint
     *
     * @return array
     */
    private function defineLine(Coord $firstPoint, Coord $secondPoint)
    {
        // Ax + By = C
        $A = $secondPoint->getY() - $firstPoint->getY();
        $B = $firstPoint->getX() - $secondPoint->getX();
        $C = $A * $firstPoint->getX() + $B * $firstPoint->getY();

        return [$A, $B, $C];
    }

    /**
     * @param Coord $needle
     * @param Coord $startPoint
     * @param Coord $endPoint
     *
     * @return bool
     */
    private function isOnLine(Coord $needle, Coord $startPoint, Coord $endPoint): bool
    {
        if (
            $this->isBetween($needle->getX(), $endPoint->getX(), $startPoint->getX()) &&
            $this->isBetween($needle->getY(), $endPoint->getY(), $startPoint->getY())
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param int $check
     * @param int $first
     * @param int $second
     *
     * @return bool
     */
    private function isBetween(int $check, int $first, int $second): bool
    {
        return (min($first, $second) <= $check && $check <= max($first, $second));
    }

    /**
     * @return Coord
     */
    public function getCoord(): Coord
    {
        return $this->intersectionCoord;
    }
}
