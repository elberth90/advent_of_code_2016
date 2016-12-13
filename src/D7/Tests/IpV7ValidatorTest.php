<?php

namespace AdventOfCode\D7\Tests;

use AdventOfCode\D7\IpV7Validator;

class IpV7ValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider ipTlsProvider
     */
    public function test_that_validator_correctly_recognize_tls($ip, $support)
    {
        $this->assertEquals($support, IpV7Validator::isTls($ip), $ip);
    }

    /**
     * @dataProvider ipSslProvider
     */
    public function test_that_validator_correctly_recognize_ssl($ip, $support)
    {
        $this->assertEquals($support, IpV7Validator::isSsl($ip), $ip);
    }

    /**
     * @return array
     */
    public function ipTlsProvider(): array
    {
        return [
            [
                '$ip' => 'abba[mnop]qrst',
                '$support' => true,
            ],
            [
                '$ip' => 'abcd[bddb]xyyx',
                '$support' => false,
            ],
            [
                '$ip' => 'aaaa[qwer]tyui',
                '$support' => false,
            ],
            [
                '$ip' => 'ioxxoj[asdfgh]zxcvbn',
                '$support' => true,
            ],
        ];
    }

    /**
     * @return array
     */
    public function ipSslProvider(): array
    {
        return [
            [
                '$ip' => 'aba[bab]xyz',
                '$support' => true,
            ],
            [
                '$ip' => 'xyx[xyx]xyxzuz',
                '$support' => false,
            ],
            [
                '$ip' => 'aaa[kek]eke',
                '$support' => true,
            ],
            [
                '$ip' => 'zazbz[bzb]cdb',
                '$support' => true,
            ],
            [
                '$ip' => 'zazbz[bzb]cdbaaa[kek]ekeaba',
                '$support' => true,
            ],
            [
                '$ip' => 'zazbz[bzb]cdbaaa[kek]eke[stuff]aba',
                '$support' => true,
            ],
            [
                '$ip' => 'abaccc[cccbab]',
                '$support' => true,
            ],

        ];
    }
}
