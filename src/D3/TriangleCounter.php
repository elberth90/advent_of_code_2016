<?php

namespace AdventOfCode\D3;

use Countable;

class TriangleCounter implements Countable
{
    const MAX_SIDES = 3;

    private $sides = [];

    private $counter = 0;

    /**
     * @param int $side
     */
    public function add(int $side)
    {
        $firstDigit = substr($side, 0, 1);
        $this->sides[$firstDigit][] = $side;
    }

    /**
     * @inheritdoc
     */
    public function count(): int
    {
        $this->findAllTriangles();

        return $this->counter;
    }

    private function findAllTriangles()
    {
        array_walk($this->sides, function (&$items) {
            sort($items);
        });

        $result = array_map(function ($key) {
            return $this->countTrianglesInIndex($key);
        }, array_keys($this->sides));

        $this->counter = array_sum($result);
    }

    /**
     * @param int $index
     *
     * @return int
     */
    private function countTrianglesInIndex(int $index): int
    {
        $count = 0;
        $n = count($this->sides[$index]);

        for ($i = 0; $i < $n - 2; $i++) {
            $k = $i + 2;
            for ($j = $i + 1; $j < $n; $j++) {


                while ($k < $n && $this->sides[$index][$i] + $this->sides[$index][$j] > $this->sides[$index][$k]) {
                    $k += 1;
                }


                $count += $k - $j - 1;
            }
        }

        return $count;
    }
}
