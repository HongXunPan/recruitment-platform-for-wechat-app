<?php

namespace Modules\Recruitment\Enums;

use App\Enums\BaseEnum;


/**
 * 用户求职枚举
 * Class UserWorkEnum
 * @package Modules\Recruitment\Enum
 */
final class UserWorkEnum extends BaseEnum
{

    //期望工作类型
    const HOPE_WORK_TYPE_NO_LIMIT = 0;
    const HOPE_WORK_TYPE_SHORT_TIME = 1;
    const HOPE_WORK_TYPE_LONG_TIME = 2;
    const HOPE_WORK_TYPE_INTERNSHIP = 3;

    public $hopeWorkTypeMap = [
        self::HOPE_WORK_TYPE_NO_LIMIT => '不限',
        self::HOPE_WORK_TYPE_SHORT_TIME => '短期兼职',
        self::HOPE_WORK_TYPE_LONG_TIME => '长期兼职',
        self::HOPE_WORK_TYPE_INTERNSHIP => '实习',
    ];

    //期望短期工作时间
    const HOPE_WORK_TIME_NO_LIMIT = 0;
    const HOPE_WORK_TIME_WEEKDAY = 1;
    const HOPE_WORK_TIME_WEEKEND = 2;
    const HOPE_WORK_TIME_HOLIDAYS = 3;
    const HOPE_WORK_TIME_WINTER_OR_SUMMER_VACATION = 4;

    public $hopeWorkTimeMap = [
        self::HOPE_WORK_TIME_NO_LIMIT => '不限',
        self::HOPE_WORK_TIME_WEEKDAY => '周末',
        self::HOPE_WORK_TIME_HOLIDAYS => '节假日',
        self::HOPE_WORK_TIME_WINTER_OR_SUMMER_VACATION => '寒暑假',
    ];

}
