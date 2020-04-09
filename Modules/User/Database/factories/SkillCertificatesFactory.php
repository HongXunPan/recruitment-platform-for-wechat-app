<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\Modules\User\Entities\SkillCertificate::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->word(),
        'desc' => $faker->paragraph(),
        'images' => $faker->imageUrl(),
//         * @property int $user_id
    ];
});
