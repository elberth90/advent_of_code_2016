<?php

namespace AdventOfCode\D3;

use AdventOfCode\D3\Exceptions\InvalidTriangleException;

class Triangle
{
    /**
     * @var int
     */
    private $sideA;

    /**
     * @var int
     */
    private $sideB;

    /**
     * @var int
     */
    private $sideC;

    /**
     * @param int $sideA
     * @param int $sideB
     * @param int $sideC
     *
     * @throws InvalidTriangleException
     */
    public function __construct(int $sideA, int $sideB, int $sideC)
    {
        $this->sideA = $sideA;
        $this->sideB = $sideB;
        $this->sideC = $sideC;
        if (!$this->isValid()) {
            throw new InvalidTriangleException();
        }
    }

    /**
     * @return bool
     */
    private function isValid(): bool
    {
        if (!$this->isGreaterThan($this->sideA + $this->sideB, $this->sideC)) {
            return false;
        }

        if (!$this->isGreaterThan($this->sideA + $this->sideC, $this->sideB)) {
            return false;
        }

        if (!$this->isGreaterThan($this->sideC + $this->sideB, $this->sideA)) {
            return false;
        }

        return true;
    }

    /**
     * @param int $val1
     * @param int $val2
     *
     * @return bool
     */
    private function isGreaterThan(int $val1, int $val2): bool
    {
        return $val1 > $val2;
    }
}
