<?php

namespace AdventOfCode\Tests;

use AdventOfCode\SimpleCodeCracker;

class SimpleCodeCrackerTest extends \PHPUnit_Framework_TestCase
{
    public function test_code_cracker()
    {
        $cracker = new SimpleCodeCracker('abc');
        $this->assertEquals('18f47a30', $cracker->getCode());
    }
}
