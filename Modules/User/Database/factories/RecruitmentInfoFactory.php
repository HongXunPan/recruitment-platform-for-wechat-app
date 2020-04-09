<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\User\Enums\UserWorkEnum;
use Modules\User\Enums\UserEnum;

$factory->define(\Modules\User\Entities\RecruitmentInfo::class, function (Faker $faker) {
    $hopeWorkTypeMap = UserWorkEnum::$hopeWorkTypeMap;
    unset($hopeWorkTypeMap[UserWorkEnum::HOPE_WORK_TYPE_NO_LIMIT]);
    $hopeWorkTimeMap = UserWorkEnum::$hopeWorkTimeMap;
    unset($hopeWorkTimeMap[UserWorkEnum::HOPE_WORK_TIME_NO_LIMIT]);

    return [
        //
        'area_id' => $faker->numberBetween(1, 3632),
        'birth_date' => $faker->date(),
        'height' => $faker->randomFloat(2, 150, 190),
        'education_status' => $faker->randomElement(array_keys(UserEnum::$educationStatusMap)),
        'highest_degree' => $faker->randomElement(array_keys(UserEnum::$degreeTypeMap)),
        'qq' => $faker->regexify('[1-9][0-9]{4,14}'),
        'wechat' => $faker->regexify('^[a-zA-Z]{1}[-_a-zA-Z0-9]{5,19}+$'),
        'hope_work_type' => implode(',', $faker->randomElements(array_keys($hopeWorkTypeMap),
            $faker->numberBetween(0, count(array_keys($hopeWorkTypeMap))))),
        'hope_work_time' => implode(',', $faker->randomElements(array_keys($hopeWorkTimeMap),
            $faker->numberBetween(0, count(array_keys($hopeWorkTimeMap))))),
        'can_full_time' => $faker->randomElement(array_keys(UserWorkEnum::$canFullTimeMap)),
        'self_intro' => $faker->realText(),

    ];
});
