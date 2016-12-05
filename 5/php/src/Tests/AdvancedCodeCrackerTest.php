<?php

namespace AdventOfCode\Tests;

use AdventOfCode\AdvancedCodeCracker;

class AdvancedCodeCrackerTest extends \PHPUnit_Framework_TestCase
{
    public function test_code_cracker()
    {
        $cracker = new AdvancedCodeCracker('abc');
        $this->assertEquals('05ace8e3', $cracker->getCode());
    }
}
