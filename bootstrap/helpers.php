<?php
/**
 * Created by PhpStorm.
 * User: HongXunPan
 * Date: 2020/4/12
 * Time: 15:55
 */

if (!function_exists('money_format_from_db')) {
    function money_format_from_db($number , $decimals = 0 , $dec_point = '.' , $thousands_sep = ',')
    {
        return number_format(($number / 100 . ''), $decimals, $dec_point, $thousands_sep);
    }
}

if (!function_exists('money_format_to_db')) {
    function money_format_to_db($number, $decimals = 0, $dec_point = '.' , $thousands_sep = ',')
    {
        return number_format($number * 100 . '', $decimals, $dec_point, $thousands_sep);
    }
}