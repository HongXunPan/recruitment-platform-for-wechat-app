<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\Modules\User\Entities\AdeptLanguage::class, function (Faker $faker) {
    return [
        //
        'language' => $faker->languageCode,
        'proficiency' => $faker->randomElement(array_keys(\Modules\User\Enums\UserEnum::$proficiencyMap)),
        'level' => $faker->word(),

//    * @property int $user_id
    ];
});
