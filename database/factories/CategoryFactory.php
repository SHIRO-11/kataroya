<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'category_name' => $faker->slug,
        'post_id' => function () {
            return factory(App\Post::class)->create()->id;
        }
    ];
});
