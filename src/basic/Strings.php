<?php
namespace Basic;

use JetBrains\PhpStorm\Pure;
use RuntimeException;

class Strings
{

    #[Pure]
    public static function toUpper(string $str) :string
    {
        return strtoupper($str);
    }

    #[Pure]
    public static function split(string $separator, string $target) :array
    {
        return explode(separator: $separator, string: $target);
    }

    #[Pure]
    public static function size(string $str): int
    {
        return mb_strlen($str);
    }

    #[Pure]
    public static function contains(string $target, string $needle) :bool
    {
        return str_contains($target, $needle);
    }

    #[Pure]
    public static function take(string $target, int $len) :string
    {
        return mb_substr($target, 0, $len);
    }

    /**
     * @param string $target
     * @return int
     * @throws RuntimeException
     */
    public static function toInt(string $target) :int
    {
        if (!preg_match("/\d+/", $target)) {
            throw new RuntimeException("invalid number format.");
        }
        return (int)$target;
    }
}
