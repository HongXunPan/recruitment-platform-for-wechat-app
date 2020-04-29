<?php
/**
 * Created by PhpStorm.
 * User: HongXunPan
 * Date: 2020/4/12
 * Time: 15:55
 */

if (!function_exists('money_format_from_db')) {
    function money_format_from_db($number , $decimals = 2 , $dec_point = '.' , $thousands_sep = ',')
    {
        return number_format(($number / 100 . ''), $decimals, $dec_point, $thousands_sep);
    }
}

if (!function_exists('money_format_to_db')) {
    function money_format_to_db($number, $decimals = 2, $dec_point = '.' , $thousands_sep = ',')
    {
        return number_format($number * 100 . '', $decimals, $dec_point, $thousands_sep);
    }
}

if (!function_exists('indexed_array_to_json')) {
    function indexed_array_to_json(&$value, $key, $data = ['key', 'value'])
    {
        $value = [$data[0] => $key, $data[1] => $value];
    }
}
