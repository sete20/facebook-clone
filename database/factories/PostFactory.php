<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use App\Post;
$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id'=>factory(user::class),
        'body'=>$faker->sentence,
        'image'=>'https://placeimg.com/100/100/any?' . rand(1, 100),
    ];
});
