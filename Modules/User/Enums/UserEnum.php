<?php

namespace Modules\User\Enums;

use App\Enums\BaseEnum;


/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserEnum extends BaseEnum
{

    //degree_type
    const DEGREE_TYPE_PRIMARY_SCHOOL = 0;
    const DEGREE_TYPE_MIDDLE_SCHOOL = 1;
    const DEGREE_TYPE_COLLEGE = 2;
    const DEGREE_TYPE_UNDERGRADUATE= 3;
    const DEGREE_TYPE_MASTER = 4;
    const DEGREE_TYPE_DOCTOR = 5;

    public static $degreeTypeMap = [
        self::DEGREE_TYPE_PRIMARY_SCHOOL => '小学',
        self::DEGREE_TYPE_MIDDLE_SCHOOL => '中学',
        self::DEGREE_TYPE_COLLEGE => '大专',
        self::DEGREE_TYPE_UNDERGRADUATE => '本科',
        self::PROFICIENCY_MASTER => '硕士',
        self::DEGREE_TYPE_DOCTOR => '博士',
    ];


    const SEX_UNKNOWN = 0;
    const SEX_MAN = 1;
    const SEX_WOMAN = 2;

    //熟练度
    const PROFICIENCY_KNOW = 1;
    const PROFICIENCY_FAMILIAR = 2;
    const PROFICIENCY_MASTER = 3;

    public static $proficiencyMap = [
        self::PROFICIENCY_KNOW => '了解',
        self::PROFICIENCY_FAMILIAR => '熟悉',
        self::PROFICIENCY_MASTER => '精通',
    ];


    //education_status 教育状态
    const EDUCATION_STATUS_ACTIVE = 1;
    const EDUCATION_STATUS_GRADUATED = 2;

    public static $educationStatusMap = [
        self::EDUCATION_STATUS_ACTIVE => '在读',
        self::EDUCATION_STATUS_GRADUATED => '已毕业',
    ];
}
