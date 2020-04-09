<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\Modules\Recruitment\Entities\Job::class, function (Faker $faker) {
    $jobTypeIdArr = \Modules\Recruitment\Entities\JobType::query()->where('level', '=', 2)->get('id');
    return [
        //
//        'company_id' => factory(\Modules\Recruitment\Entities\Company::class),
        'title' => $faker->company .':'. $faker->jobTitle . ' ',
        'content' => $faker->realText(),
        'price' => $faker->numberBetween(50 * 100, 2000 * 100),
        'unit' => $faker->randomElement(['小时', '天', '周', '月']),
        'area_id' => $faker->randomElement(range(1, 3632)),
        'tag_ids' => implode(',', $faker->randomElements(range(1, 100), $faker->numberBetween(0, 100))),
        'welfare_ids' => implode(',', $faker->randomElements(range(1, 100), $faker->numberBetween(0, 100))),
        'job_type_ids' => implode(',', $faker->randomElements(
            $jobTypeIdArr,
            $faker->numberBetween(0, count($jobTypeIdArr)))),
        'work_circles' => $faker->randomElement(array_keys(\Modules\Recruitment\Enums\JobEnum::$workCircleMap)),
        'sex_require' => $faker->randomElement(array_keys(\Modules\Recruitment\Enums\JobEnum::$sexRequireMap)),
        'work_time' => $faker->randomElement(array_keys(\Modules\Recruitment\Enums\JobEnum::$workTimeMap)),
        'other_require' => getOtherRequire($faker),
        'view_count' => $faker->numberBetween(),

//    * @property mixed|null $location 地址信息
//    * @property int $status 兼职状态 0正常 1下架
    ];
});

function getOtherRequire(Faker $faker, $num = 20)
{
    static $arr = [];
    if (empty($arr)) {
        for($i = 0; $i< $num; $i++) {
            $arr[] = $faker->word . ':' .$faker->word();
        }
    }
    return implode(',', $faker->randomElements($arr, $faker->numberBetween(0, count($arr))));
}
