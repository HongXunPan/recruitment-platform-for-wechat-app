<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\Modules\User\Entities\User::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->userName(),
        'email' => $faker->email,
        'password' => $faker->password(),
        'mobile' => $faker->unique()->regexify('/^1[34578]{1}\d{9}$/'),
//        'is_identify' => $faker->numberBetween(0, 1),
        'nickname' => $faker->firstName(),
        'real_name' => $faker->name(),
        'avatar' => $faker->imageUrl('200', '200', 'people'),
        'sex' => $faker->numberBetween(0, 2),
        'api_token' => $faker->unique()->password(),

//    * @property mixed|null $location 当前地理信息
//    * @property string|null $openid 微信开放id
//    * @property string|null $union_id 微信union_id
//    * @property string|null $weapp_session_key 微信session_key
//    * @property string $api_token
//    * @property string|null $remember_token
    ];
});

$phonePrefix = array(
    134, 135, 136, 137, 138, 139, 147, 150, 151, 152, 157, 158, 159, 1705, 178, 182, 183, 184, 187, 188, // China Mobile
    130, 131, 132, 145, 155, 156, 1707, 1708, 1709, 1718, 1719, 176, 185, 186, // China Unicom
    133, 153, 1700, 1701, 177, 180, 181, 189, // China Telecom
    170, 171, // virtual operators
);
