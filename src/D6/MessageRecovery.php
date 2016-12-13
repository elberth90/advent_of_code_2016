<?php

namespace AdventOfCode\D6;

class MessageRecovery
{
    const SPLIT_LENGTH = 1;

    /**
     * @var array
     */
    private $partialMessage = [];

    /**
     * @param string $message
     */
    public function consume(string $message)
    {
        foreach (str_split($message, self::SPLIT_LENGTH) as $index => $char) {
            $this->partialMessage[$index][$char] =
                isset($this->partialMessage[$index][$char]) ? $this->partialMessage[$index][$char] + 1 : 0;
        }
    }

    /**
     * @param callable $decryptFunction
     *
     * @return string
     */
    public function recover(callable $decryptFunction): string
    {
        $result = array_map(function (&$item) use ($decryptFunction) {
            $item = $decryptFunction($item);
            reset($item);

            return key($item);
        }, $this->partialMessage);

        return implode('', $result);
    }
}
