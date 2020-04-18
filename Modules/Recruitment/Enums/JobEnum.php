<?php
/**
 * Created by PhpStorm.
 * User: HongXunPan
 * Date: 2020/4/5
 * Time: 12:01
 */

namespace Modules\Recruitment\Enums;


use App\Enums\BaseEnum;

class JobEnum extends BaseEnum
{
    //工作时间
    const WORK_TIME_NO_LIMIT = 0;
    const WORK_TIME_MORNING = 1;
    const WORK_TIME_AFTERNOON = 2;
    const WORK_TIME_NIGHT = 3;

    public static $workTimeMap = [
        self::WORK_TIME_NO_LIMIT => '不限',
        self::WORK_TIME_MORNING => '上午',
        self::WORK_TIME_AFTERNOON => '下午',
        self::WORK_TIME_NIGHT => '晚上'
    ];

    //性别要求
    const SEX_NOT_LIMIT = 0;
    const SEX_MAN = 1;
    const SEX_WOMAN = 2;

    public static $sexRequireMap = [
        self::SEX_NOT_LIMIT => '不限',
        self::SEX_MAN => '男',
        self::SEX_WOMAN => '女',
    ];

    const STATUS_NORMAL = 0;
    const STATUS_DISABLE = 1;

    public static $statusMap = [
        self::STATUS_NORMAL => '正常',
        self::STATUS_DISABLE => '下线',
    ];

    //工作周期
    const WORK_CIRCLE_NO_LIMIT = 0;
    const WORK_CIRCLE_SHORT_TIME = 1;
    const WORK_CIRCLE_WEEKEND = 2;
    const WORK_CIRCLE_LONG_TIME = 3;

    public static $workCircleMap = [
        self::WORK_CIRCLE_NO_LIMIT => '不限',
        self::WORK_CIRCLE_SHORT_TIME => '短期兼职',
        self::WORK_CIRCLE_WEEKEND => '周末兼职',
        self::WORK_CIRCLE_LONG_TIME => '长期兼职',
    ];

    const SORT_DEFAULT = 1;
    const SORT_NEWEST = 2;
    const SORT_DISTANCE = 3;

    public static $sortMap = [
        self::SORT_DEFAULT => '综合排序',
        self::SORT_NEWEST => '最新发布',
        self::SORT_DISTANCE => '离我最近',
    ];
}
