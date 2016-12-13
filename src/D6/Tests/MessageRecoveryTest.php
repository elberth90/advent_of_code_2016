<?php

namespace AdventOfCode\D6\Tests;

use AdventOfCode\D6\MessageRecovery;

class MessageRecoveryTest extends \PHPUnit_Framework_TestCase
{
    private $data = [
        'eedadn',
        'drvtee',
        'eandsr',
        'raavrd',
        'atevrs',
        'tsrnev',
        'sdttsa',
        'rasrtv',
        'nssdts',
        'ntnada',
        'svetve',
        'tesnvt',
        'vntsnd',
        'vrdear',
        'dvrsen',
        'enarar',
    ];

    public function test_that_message_can_be_recovered()
    {
        $decrypt = function ($item) {
            arsort($item);

            return $item;
        };
        $messageRecovery = new MessageRecovery();
        foreach ($this->data as $line) {
            $messageRecovery->consume($line);
        }

        $result = $messageRecovery->recover($decrypt);
        $this->assertEquals('easter', $result);
    }

    public function test_that_message_can_be_recovered_with_other_decrypt_function()
    {
        $decrypt = function ($item) {
            asort($item);

            return $item;
        };
        $messageRecovery = new MessageRecovery();
        foreach ($this->data as $line) {
            $messageRecovery->consume($line);
        }

        $result = $messageRecovery->recover($decrypt);
        $this->assertEquals('advent', $result);
    }
}
