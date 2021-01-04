<?php

use PHPUnit\Framework\TestCase;
use Basic\Dates;

class DatesTest extends TestCase
{
    public function testNow()
    {
        try {
            $now = Dates::now();
            self::assertSame(date('Y/m/d H:i'), $now->format('Y/m/d H:i'));
        } catch (Exception $e) {
            self::fail("fail: {$e->getMessage()}");
        }
    }

    public function testDateTimeFail()
    {
        // should be thrown Exception due to invalid date format(hello).
        self::expectException(Exception::class);

        Dates::strToDateTime('hello');
    }

    public function testDateTime()
    {
        // first format
        $d = Dates::strToDateTime('2021-01-01 10:00:30');
        self::assertSame('2021-01-01 10:00:30', $d->format('Y-m-d H:i:s'));

        // second format
        $d = Dates::strToDateTime('20210101100030');
        self::assertSame('2021-01-01 10:00:30', $d->format('Y-m-d H:i:s'));

        // third format
        $d = Dates::strToDateTime('May 27 2021 01:23:09');
        self::assertSame('2021-05-27 01:23:09', $d->format('Y-m-d H:i:s'));
    }

    public function testStrToDateTimeIntFail()
    {
        self::assertFalse(Dates::strToDateTimeInt('hello'), "due to invalid format.");
    }

    public function testStrToDateTimeInt()
    {
        // first format
        $actualInt = Dates::strToDateTimeInt('2021-01-01 10:00:30');
        if ($actualInt === false) {
            self::fail('fail: cannot parse string');
        }
        $actual = date('Y/m/d H:i:s', $actualInt);
        if ($actual === false) {
            self::fail('fail: cannot format');
        }
        self::assertSame('2021/01/01 10:00:30', $actual);

        // second format
        $actualInt = Dates::strToDateTimeInt('20210101100030');
        if ($actualInt === false) {
            self::fail('fail: cannot parse string');
        }
        $actual = date('Y-m-d H:i:s', $actualInt);
        if ($actual === false) {
            self::fail('fail: cannot format');
        }
        self::assertSame('2021-01-01 10:00:30', $actual);

        // third format
        $actualInt = Dates::strToDateTimeInt('May 27 2021 01:23:09');
        if ($actualInt === false) {
            self::fail('fail: cannot parse string');
        }
        $actual = date('Y-m-d H:i:s', $actualInt);
        if ($actual === false) {
            self::fail('fail: cannot format');
        }
        self::assertSame('2021-05-27 01:23:09', $actual);
    }

    public function testSetTimeZone()
    {
        $d = Dates::strToDateTime('2021-01-01 10:00:30');

        $actual = Dates::setTimeZone($d, Dates::JST);
        self::assertSame('2021-01-01 19:00:30', $actual->format('Y-m-d H:i:s'));

        $actual2 = Dates::setTimeZone($d, Dates::VST);
        self::assertSame('2021-01-01 17:00:30', $actual2->format('Y-m-d H:i:s'));

        $actual3 = Dates::setTimeZone(null, Dates::VST);
        self::assertNull($actual3);
    }

    public function testMinusPlusDay()
    {
        $baseDateTime = '2021-01-01 10:00:30';
        $d = Dates::strToDateTime($baseDateTime);

        $actual = Dates::modifyDay($d, -1);
        self::assertSame('2020-12-31 10:00:30', $actual->format('Y-m-d H:i:s'));

        $actual2 = Dates::modifyDay($actual, 1);
        self::assertSame($baseDateTime, $actual2->format('Y-m-d H:i:s'));

        $actual3 = Dates::modifyDay(null, -100);
        self::assertNull($actual3);
    }

    public function testBefore()
    {
        $d1 = Dates::strToDateTime('2021-01-01 10:00:29');
        $d2 = Dates::strToDateTime('2021-01-01 10:00:30');

        self::assertTrue(Dates::before($d1, $d2));
        self::assertFalse(Dates::before($d2, $d1));
    }

    public function testAfter()
    {
        $d1 = Dates::strToDateTime('2021-01-01 10:00:30');
        $d2 = Dates::strToDateTime('2021-01-01 10:00:29');

        self::assertTrue(Dates::after($d1, $d2));
        self::assertFalse(Dates::after($d2, $d1));
    }
}
