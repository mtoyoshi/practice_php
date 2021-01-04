<?php
namespace Basic;

use JetBrains\PhpStorm\Pure;

class Arrays
{

    /**
     * 先頭要素を返します
     * @param array $target 対象の配列を指定
     * @return mixed 戻り値
     */
    #[Pure] public static function head(array $target): mixed
    {
        return count($target) <= 0 ? null : $target[0];
    }

    /**
     * @param callable $callback
     * @param array $target
     * @return array
     */
    #[Pure] public static function map(callable $callback, array $target): array
    {
        return array_map($callback, $target);
    }

    #[Pure] public static function filter(callable $callback, array $target): array
    {
        return array_merge(
            array_filter($target, $callback)
        );
    }

    #[Pure] public static function collect(callable $filtering, callable $mapping, array $target): array
    {
        return self::map(
            $mapping,
            self::filter($filtering, $target)
        );
    }

    #[Pure] public static function merge(array $target1, array ...$targets) :array
    {
        return array_merge($target1, ...$targets);
    }

    #[Pure] public static function containsKey(array $target, int|string $key) :bool
    {
        foreach ($target as $k => $v) {
            if ($k === $key) {
                return true;
            }
        }
        return false;
    }

    public static function min(array $target) :mixed
    {
        return min($target);
    }
}
