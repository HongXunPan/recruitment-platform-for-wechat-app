<?php
/**
 * Created by PhpStorm.
 * User: HongXunPan
 * Date: 2020/4/4
 * Time: 15:13
 */
namespace App\Enums;

use BenSampo\Enum\Enum;

class BaseEnum extends Enum
{
    /**
     * 根据传入的 value 匹配传入的 map 对应的值
     * @param int $value
     * @param array $map
     * @return string
     */
    public static function getDescriptionByMap(int $value, array $map): string
    {
        if (isset($map[$value])) {
            return $map[$value];
        }
        return '';
    }
}