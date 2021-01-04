<?php

use PHPUnit\Framework\TestCase;
use Basic\Arrays;

class ArraysTest extends TestCase
{
    public function testHead(): void
    {
        $actual = Arrays::head([]);
        self::assertNull($actual);

        $actual = Arrays::head([1,2,3,4,5]);
        self::assertSame(1, $actual);

        $actual = Arrays::head(["あいうえお", "かきくけこ"]);
        self::assertSame("あいうえお", $actual);
    }

    public function testMap(): void
    {
        $actual = Arrays::map(
            fn($v) => $v * 2,
            [1,2,3,4]
        );
        self::assertSame([2,4,6,8], $actual);
    }

    public function testFilter(): void
    {
        $actual = Arrays::filter(
            fn($v) => $v % 2 === 0,
            range(0, 10)
        );
        self::assertSame([0,2,4,6,8,10], $actual);
    }

    public function testCollect(): void
    {
        $actual = Arrays::collect(
            filtering: fn($v) => $v % 2 === 0,
            mapping: fn($v) => $v ** 2,
            target: range(1, 10)
        );
        self::assertSame([4, 16, 36, 64, 100], $actual);
    }

    public function testMerge(): void
    {
        $actual = Arrays::merge([1,2,3], [4,5,6]);
        self::assertSame([1,2,3,4,5,6], $actual);

        $actual = Arrays::merge([1,2,3], [4,5,6], [7,8,9]);
        self::assertSame([1,2,3,4,5,6,7,8,9], $actual);

        $empty = [];
        $actual = Arrays::merge($empty, [4,5,6], [7,8,9]);
        self::assertSame([4,5,6,7,8,9], $actual);
        self::assertSame([], $empty);

        $actual = Arrays::merge([1,2,3], []);
        self::assertSame([1,2,3], $actual);

        $actual = Arrays::merge(['one'=>1,'two'=>2], ['three'=>3, 'four'=>4]);
        self::assertSame(['one'=>1,'two'=>2,'three'=>3, 'four'=>4], $actual);
    }

    public function testContainsKey(): void
    {
        $actual = Arrays::containsKey(['one'=>1, 'two'=>2], 'two');
        self::assertTrue($actual);

        $actual = Arrays::containsKey([1=>'one', 3=>'three'], 2);
        self::assertFalse($actual);
    }

    public function testMin(): void
    {
        $actual = Arrays::min([10,1,20,100,50]);
        self::assertSame(1, $actual);

        $actual2 = Arrays::min(['y', 'b', 'a', 'x']);
        self::assertSame('a', $actual2);
    }
}
