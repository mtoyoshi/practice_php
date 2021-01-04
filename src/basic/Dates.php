<?php
namespace Basic;

use DateTimeZone;
use DateTime;
use Exception;

class Hoge
{

}

class Dates
{
    const JST = 'Asia/Tokyo';
    const VST = 'Asia/Ho_Chi_Minh';

    /**
     * @param DateTimeZone|null $timezone
     * @return DateTime
     * @throws Exception
     */
    public static function now(?DateTimeZone $timezone = null) :DateTime
    {
        return self::strToDateTime('now', $timezone);
    }

    /**
     * @param string $value
     * @param DateTimeZone|null $timezone
     * @return DateTime
     * @throws Exception
     */
    public static function strToDateTime(string $value, ?DateTimeZone $timezone = null) :DateTime
    {
        return new DateTime($value, $timezone);
    }

    public static function strToDateTimeInt(string $value, ?DateTimeZone $timezone = null) :false|int
    {
        return strtotime($value, $timezone);
    }

    public static function modifyDay(?DateTime $target, int $days) :?DateTime
    {
        return $target?->modify($days . " days");
    }

    public static function setTimeZone(?DateTime $target, string $timezone) :?DateTime
    {
        return $target?->setTimezone(new DateTimeZone($timezone));
    }

    /**
     * Is $target1 before $target2?
     * @param DateTime $target1
     * @param DateTime $target2
     * @return bool
     */
    public static function before(DateTime $target1, DateTime $target2) :bool
    {
        return $target1 < $target2;
    }

    /**
     * Is $target1 after $target2?
     * @param DateTime $target1
     * @param DateTime $target2
     * @return bool
     */
    public static function after(DateTime $target1, DateTime $target2) :bool
    {
        return $target1 > $target2;
    }

}
