<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\Modules\Recruitment\Entities\JobTag::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->unique()->asciify('tag****'),
        'sort' => $faker->numberBetween(0, 100),
    ];
});
