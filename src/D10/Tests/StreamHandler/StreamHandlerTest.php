<?php

namespace AdventOfCode\D10\Tests\StreamHandler;

use AdventOfCode\D10\StreamHandler\StreamHandler;

class StreamHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider memoryProvider
     */
    public function test_that_handler_can_open_file($input, $expectedLines)
    {
        $handler = new StreamHandler('data:text/plain,' . implode('', $input));

        $generator = $handler->getLine();
        foreach ($expectedLines as $line) {
            $this->assertEquals(trim($line), $generator->current());
            $generator->next();
        }
    }

    /**
     * @dataProvider memoryProviderInitFilter
     */
    public function test_that_handler_can_filter_init_bot($input, $expectedLines)
    {
        $streamPath = sprintf('data:text/plain,%s', implode('', $input));
        $handler = new StreamHandler($streamPath, StreamHandler::INIT_FILTER);

        $generator = $handler->getLine();
        foreach ($expectedLines as $line) {
            $this->assertEquals(trim($line), $generator->current());
            $generator->next();
        }
    }

    /**
     * @dataProvider memoryProviderCommandFilter
     */
    public function test_that_handler_can_filter_command($input, $expectedLines)
    {
        $streamPath = sprintf('data:text/plain,%s', implode('', $input));
        $handler = new StreamHandler($streamPath, StreamHandler::COMMAND_FILTER);

        $generator = $handler->getLine();
        foreach ($expectedLines as $line) {
            $this->assertEquals(trim($line), $generator->current());
            $generator->next();
        }
    }

    /**
     * @return array
     */
    public function memoryProvider(): array
    {
        $input = [
            "value 2 goes to bot 141\n",
            "value 3 goes to bot 142\n",
            "bot 12 gives low to bot 65 and high to bot 23\n",
            "value 4 goes to bot 143\n",
            "bot 15 gives low to bot 34 and high to bot 76\n",
            "bot 16 gives low to bot 23 and high to bot 34\n",
            "value 1 goes to bot 144\n",
        ];

        return [
            [
                '$input' => $input,
                '$expectedLines' => $input,
            ],
        ];
    }

    /**
     * @return array
     */
    public function memoryProviderInitFilter(): array
    {
        $input = [
            "value 2 goes to bot 141\n",
            "value 3 goes to bot 142\n",
            "bot 12 gives low to bot 65 and high to bot 23\n",
            "value 4 goes to bot 143\n",
            "bot 15 gives low to bot 34 and high to bot 76\n",
            "bot 16 gives low to bot 23 and high to bot 34\n",
            "value 1 goes to bot 144\n",
        ];

        return [
            [
                '$input' => $input,
                '$expectedLines' => [
                    "value 2 goes to bot 141\n",
                    "value 3 goes to bot 142\n",
                    "value 4 goes to bot 143\n",
                    "value 1 goes to bot 144\n",
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function memoryProviderCommandFilter(): array
    {
        $input = [
            "value 2 goes to bot 141\n",
            "value 3 goes to bot 142\n",
            "bot 12 gives low to bot 65 and high to bot 23\n",
            "value 4 goes to bot 143\n",
            "bot 15 gives low to bot 34 and high to bot 76\n",
            "bot 16 gives low to bot 23 and high to bot 34\n",
            "value 1 goes to bot 144\n",
            "bot 1 gives low to output 1 and high to bot 0\n",
            "bot 0 gives low to output 2 and high to output 0\n",
        ];

        return [
            [
                '$input' => $input,
                '$expectedLines' => [
                    "bot 12 gives low to bot 65\n",
                    "bot 12 gives high to bot 23\n",
                    "bot 15 gives low to bot 34\n",
                    "bot 15 gives high to bot 76\n",
                    "bot 16 gives low to bot 23\n",
                    "bot 16 gives high to bot 34\n",
                    "bot 1 gives low to output 1\n",
                    "bot 1 gives high to bot 0\n",
                    "bot 0 gives low to output 2\n",
                    "bot 0 gives high to output 0\n",
                ],
            ],
        ];
    }
}
