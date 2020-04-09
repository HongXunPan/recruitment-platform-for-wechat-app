<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\Modules\User\Entities\EducationExperience::class, function (Faker $faker) {
    $beginDate = $faker->date();
    return [
        //
        'school' => $faker->state . $faker->word . '学校',
        'major' => $faker->jobTitle . '培训班',
        'degree_type' => $faker->randomElement(array_keys(\Modules\User\Enums\UserEnum::$degreeTypeMap)),
        'begin_date' => $beginDate,
        'end_date' => $faker->date('Y-m-d', $beginDate),
        'desc' => $faker->paragraph(),
    ];
});
