<?php

namespace AdventOfCode\D10\StreamHandler;

class CommandStreamFilter extends \PHP_User_Filter
{
    const IS_INIT = '#^bot \d+.*\n#m';

    const SPLIT = '#bot\s(?P<botIndex>\d+) gives low to (?:(?:bot )(?P<lowIndex>\d+)|(?:output )(?P<outputLowIndex>\d+)) and high to (?:(?:bot )(?P<highIndex>\d+)|(?:output )(?P<outputHighIndex>\d+))#m';

    /**
     * @var resource
     */
    private $bufferHandle;

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
            $bucket->data = implode('', $this->splitCommand(reset($matches)));
            $consumed += $bucket->datalen;
            stream_bucket_append($out, $bucket);
        }

        return PSFS_PASS_ON;
    }

    /**
     * @param array $matches
     *
     * @return array
     */
    private function splitCommand(array $matches): array
    {
        $data = [];
        $match = null;
        foreach ($matches as $line) {
            preg_match(self::SPLIT, $line, $match);

            $output = sprintf('bot %d', $match['botIndex']);
            if (isset($match['lowIndex']) && $match['lowIndex'] !== '') {
                $output = sprintf("%s gives low to bot %d\n", $output, $match['lowIndex']);
            } else {
                $output = sprintf("%s gives low to output %d\n", $output, $match['outputLowIndex']);
            }
            $data[] = $output;

            $output = sprintf('bot %d', $match['botIndex']);
            if (isset($match['highIndex']) && $match['highIndex'] !== '') {
                $output = sprintf("%s gives high to bot %d\n", $output, $match['highIndex']);
            } else {
                $output = sprintf("%s gives high to output %d\n", $output, $match['outputHighIndex']);
            }
            $data[] = $output;
        }

        return $data;
    }

    public function onCreate()
    {
        $this->bufferHandle = @fopen('php://temp', 'w+');
        if (false !== $this->bufferHandle) {
            return true;
        }

        return false;
    }

    public function onClose()
    {
        @fclose($this->bufferHandle);
    }
}
