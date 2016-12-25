<?php

namespace AdventOfCode\D10\StreamHandler;

class InitBotStreamFilter extends \PHP_User_Filter
{
    const IS_INIT = '|value \d+ goes to bot \d+\\n|';

    /**
     * @param resource $in
     * @param resource $out
     * @param int      $consumed
     * @param bool     $closing
     *
     * @return int
     */
    function filter($in, $out, &$consumed, $closing): int
    {
        $matches = '';
        while ($bucket = stream_bucket_make_writeable($in)) {
            preg_match_all(self::IS_INIT, $bucket->data, $matches);
            $bucket->data = implode('', reset($matches));
            $consumed += $bucket->datalen;
            stream_bucket_append($out, $bucket);
        }

        return PSFS_PASS_ON;
    }
}
