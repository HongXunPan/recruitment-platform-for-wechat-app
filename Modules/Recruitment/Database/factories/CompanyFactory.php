<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\Modules\Recruitment\Entities\Company::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->city . $faker->unique()->company,
        'logo' => $faker->imageUrl('200', '200', 'technics', true, 'company_logo'),
        'intro' => $faker->paragraphs(4, true),
        'is_identify' => $faker->numberBetween(0, 1),
        'contacts' => $faker->name(),
        'phone' => $faker->unique()->regexify('/^1[34578]{1}\d{9}$/'),
        'welfare_ids' => implode(',', $faker->randomElements(range(1, 100), $faker->numberBetween(0, 100))),

//    * @property mixed|null $location 当前地理信息
//    * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Recruitment\Entities\CompanyImage[] $images
    ];
});

