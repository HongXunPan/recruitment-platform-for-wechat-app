<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\Modules\Recruitment\Entities\Welfare::class, function (Faker $faker) {
    return [
        //
        'welfare' => $faker->unique(true)->asciify('welfare****'),
        'sort' => $faker->numberBetween(0, 100),
    ];
});
