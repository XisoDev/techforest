<?php


/**
 * Get a time gap between server's timezone and XE's timezone
 *
 * @return int
 */
function zgap()
{
    $time_zone = $GLOBALS['_time_zone'];
    if($time_zone < 0)
    {
        $to = -1;
    }
    else
    {
        $to = 1;
    }

    $t_hour = substr($time_zone, 1, 2) * $to;
    $t_min = substr($time_zone, 3, 2) * $to;

    $server_time_zone = date("O");
    if($server_time_zone < 0)
    {
        $so = -1;
    }
    else
    {
        $so = 1;
    }

    $c_hour = substr($server_time_zone, 1, 2) * $so;
    $c_min = substr($server_time_zone, 3, 2) * $so;

    $g_min = $t_min - $c_min;
    $g_hour = $t_hour - $c_hour;

    $gap = $g_min * 60 + $g_hour * 60 * 60;
    return $gap;
}

/**
 * YYYYMMDDHHIISS format changed to unix time value
 *
 * @param string $str Time value in format of YYYYMMDDHHIISS
 * @return int
 */
function ztime($str)
{
    if(!$str)
    {
        return;
    }

    $str = preg_replace("/[^0-9]*/s", "", $str);

    if (strlen($str) === 9 || (strlen($str) === 10 && $str <= 2147483647))
    {
        return intval($str);
    }

    $hour = (int) substr($str, 8, 2);
    $min = (int) substr($str, 10, 2);
    $sec = (int) substr($str, 12, 2);
    $year = (int) substr($str, 0, 4);
    $month = (int) substr($str, 4, 2);
    $day = (int) substr($str, 6, 2);
    if(strlen($str) <= 8)
    {
        $gap = 0;
    }
    else
    {
        $gap = zgap();
    }

    return mktime($hour, $min, $sec, $month ? $month : 1, $day ? $day : 1, $year) + $gap;
}

/**
 * If the recent post within a day, output format of YmdHis is "min/hours ago from now". If not within a day, it return format string.
 *
 * @param string $date Time value in format of YYYYMMDDHHIISS
 * @param string $format If gap is within a day, returns this format.
 * @return string
 */
function getTimeGap($date, $format = 'Y.m.d')
{

    $date = preg_replace("/[^0-9]*/s", "", $date);

    $gap = $_SERVER['REQUEST_TIME'] + zgap() - ztime($date);

    if($gap < 60)
    {
        $buff = sprintf("분 전", (int) ($gap / 60) + 1);
    }
    elseif($gap < 60 * 60)
    {
        $buff = sprintf("분 전", (int) ($gap / 60) + 1);
    }
    elseif($gap < 60 * 60 * 2)
    {
        $buff = sprintf("시간 전", (int) ($gap / 60 / 60) + 1);
    }
    elseif($gap < 60 * 60 * 24)
    {
        $buff = sprintf("시간 전", (int) ($gap / 60 / 60) + 1);
    }
    else
    {
        $buff = zdate($date, $format);
    }

    return $buff;
}

/**
 * Name of the month return
 *
 * @param int $month Month
 * @param boot $short If set, returns short string
 * @return string
 */
function getMonthName($month, $short = TRUE)
{
    $short_month = array('', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    $long_month = array('', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    return !$short ? $long_month[$month] : $short_month[$month];
}

/**
 * Change the time format YYYYMMDDHHIISS to the user defined format
 *
 * @param string|int $str YYYYMMDDHHIISS format time values
 * @param string $format Time format of php date() function
 * @param bool $conversion Means whether to convert automatically according to the language
 * @return string
 */
function zdate($str, $format = 'Y-m-d H:i:s')
{
    // return null if no target time is specified
    if(!$str)
    {
        return;
    }
    //숫자만 남기기.
    $str = preg_replace("/[^0-9]*/s", "", $str);

    // If year value is less than 1970, handle it separately.
    if((int) substr($str, 0, 4) < 1970)
    {
        $hour = (int) substr($str, 8, 2);
        $min = (int) substr($str, 10, 2);
        $sec = (int) substr($str, 12, 2);
        $year = (int) substr($str, 0, 4);
        $month = (int) substr($str, 4, 2);
        $day = (int) substr($str, 6, 2);

        $trans = array(
            'Y' => $year,
            'y' => sprintf('%02d', $year % 100),
            'm' => sprintf('%02d', $month),
            'n' => $month,
            'd' => sprintf('%02d', $day),
            'j' => $day,
            'G' => $hour,
            'H' => sprintf('%02d', $hour),
            'g' => $hour % 12,
            'h' => sprintf('%02d', $hour % 12),
            'i' => sprintf('%02d', $min),
            's' => sprintf('%02d', $sec),
            'M' => getMonthName($month),
            'F' => getMonthName($month, FALSE)
        );

        $string = strtr($format, $trans);
    }
    else
    {
        // if year value is greater than 1970, get unixtime by using ztime() for date() function's argument.
        $string = date($format, ztime($str));
    }
    // change day and am/pm for each language
    $unit_week = array('월','화','수,','목','금','토','일');
    $unit_meridiem = array('오전','오후','오전','오후');
    $string = str_replace(array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'), $unit_week, $string);
    $string = str_replace(array('am', 'pm', 'AM', 'PM'), $unit_meridiem, $string);
    return $string;
}