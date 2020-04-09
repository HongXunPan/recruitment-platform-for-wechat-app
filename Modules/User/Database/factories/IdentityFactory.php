<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\Modules\User\Entities\Identity::class, function (Faker $faker) {
    return [
        //
//        'real_name' => $faker->name(),
        'no' => app('identity_faker')->one(),
        'image_front' => $faker->imageUrl(),
        'image_back' => $faker->imageUrl(),
        'school' => $faker->state . $faker->word . '学校',
        'graduate_at' => $faker->date('Y-m-d'),
        'status' => $faker->numberBetween(0, 1),

    ];
});
