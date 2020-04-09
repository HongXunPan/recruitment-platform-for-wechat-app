<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\Modules\Recruitment\Entities\CompanyImage::class, function (Faker $faker) {
    return [
        //
        'image' => $faker->imageUrl(),
        'sort' => $faker->numberBetween(0, 100),
//        * @property int $id
//    * @property int $company_id
    ];
});
