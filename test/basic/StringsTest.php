<?php

use PHPUnit\Framework\TestCase;
use Basic\Strings;

class StringsTest extends TestCase
{
    protected function setUp(): void
    {
    }

    public function testGetUpper()
    {
        $actual = Strings::toUpper("hello,world!");
        self::assertSame("HELLO,WORLD!", $actual);
    }

    public function testSplit()
    {
        $actual = Strings::split(",", "hello,world!");
        self::assertSame("hello", $actual[0]);
        self::assertSame("world!", $actual[1]);
    }

    public function testSize()
    {
        $actual = Strings::size("hello,world!");
        self::assertSame(12, $actual);

        $actual = Strings::size("あいうえお");
        self::assertSame(5, $actual);
    }

    public function testContains()
    {
        $actual = Strings::contains("hello, world!", "llo");
        self::assertSame(true, $actual);

        $actual = Strings::contains("こんにちは", "にち");
        self::assertSame(true, $actual);
    }

    public function testSubStr()
    {
        $actual = Strings::take("hello,world!", 5);
        self::assertSame("hello", $actual);

        $actual = Strings::take("あいうえおかきくけこ", 5);
        self::assertSame("あいうえお", $actual);
    }

    public function testToInt()
    {
        $actual = Strings::toInt("123");
        self::assertSame(123, $actual);

        // should be thrown Exception.
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage("invalid number format.");

        Strings::toInt("hello");
    }

    public function testFoo()
    {
        $actual = 0.1 + 0.1 + 0.1 + 0.1 + 0.1 + 0.1 + 0.1 + 0.1 + 0.1 + 0.1;
        self::assertSame(1.0, $actual);
    }
}
