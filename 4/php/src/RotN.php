<?php

namespace AdventOfCode;

class RotN
{
    const ALPHABET_COUNT = 26;

    /**
     * @param string $text
     * @param int    $n
     *
     * @return string
     */
    public static function rot(string $text, int $n): string
    {
        $n = $n % self::ALPHABET_COUNT;
        $result = array_map(function ($char) use ($n) {
            $char = ord($char);
            if ($char >= 97 && $char <= 122) {
                $char += $n;
                if ($char > 122) {
                    $char -= 26;
                }
            }

            return chr($char);
        }, str_split($text, 1));

        return implode('', $result);
    }
}
