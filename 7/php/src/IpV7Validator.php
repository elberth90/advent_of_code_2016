<?php

namespace AdventOfCode;

class IpV7Validator
{
    const IS_TLS = '|(\w)(?!\1)(\w)\2\1|';
    const NOT_TLS = '|\[\w*(\w)(?!\1)(\w)\2\1\w*\]|';
    const IS_SSL = '|(\w)(?!\1)(\w)\1\w*(([][]\w*){2})*[][]\w*\2\1\2|';

    /**
     * @param string $ip
     *
     * @return bool
     */
    public static function isTls(string $ip): bool
    {
        if (preg_match(self::NOT_TLS, $ip)) {
            return false;
        }

        return (bool)preg_match_all(self::IS_TLS, $ip);
    }

    /**
     * @param string $ip
     *
     * @return bool
     */
    public static function isSsl(string $ip): bool
    {
        return (bool) preg_match_all(self::IS_SSL, $ip);
    }
}
