<?php

namespace AdventOfCode\D9;

class DecompressionLength
{
    const MARKER = '|(?P<marker>(\(\d*x\d*\)))|';

    /**
     * @param string $data
     * @param int    $carry
     *
     * @return int
     */
    public function simpleLength(string $data, int $carry = 0): int
    {
        if (!preg_match(self::MARKER, $data, $match)) {
            $carry += strlen($data);

            return $carry;
        }

        $marker = new Marker($match['marker']);
        $pos = strpos($data, $marker->getCommand());
        $carry += $pos;
        $data = substr($data, $pos);
        $data = substr($data, strlen($marker->getCommand()));
        $carry += $marker->getSubsequentLength() * $marker->getRepeat();
        $data = substr($data, $marker->getSubsequentLength());

        return $this->simpleLength($data, $carry);

    }

    /**
     * @param string $data
     * @param int    $carry
     *
     * @return int
     */
    public function complexLength(string $data, int $carry = 0): int
    {
        if (!preg_match(self::MARKER, $data, $match)) {
            $carry += strlen($data);

            return $carry;
        }

        $marker = new Marker($match['marker']);
        $pos = strpos($data, $marker->getCommand());
        $carry += $pos;
        $data = substr($data, $pos);
        $data = substr($data, strlen($marker->getCommand()));
        $carry += $this->complexLength(substr($data, 0, $marker->getSubsequentLength())) * $marker->getRepeat();
        $data = substr($data, $marker->getSubsequentLength());

        return $this->complexLength($data, $carry);
    }
}
