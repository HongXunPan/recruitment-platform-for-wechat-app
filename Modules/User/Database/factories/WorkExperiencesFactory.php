<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\Modules\User\Entities\WorkExperience::class, function (Faker $faker) {
    $begin_date = $faker->date();
    return [
        //
        'company' => $faker->company,
        'job' => $faker->jobTitle,
        'begin_date' => $begin_date,
        'end_date' => $faker->date('Y-m-d', $begin_date),
        'desc' => $faker->paragraph(),

//         * @property int $user_id
    ];
});
