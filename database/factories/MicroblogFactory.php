<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Microblog::class, function (Faker $faker) {

    $sentence = $faker->sentence();
        
    $updated_at = $faker->dateTimeThisMonth();
    $created_at = $faker->dateTimeThisMonth($updated_at);

    return [
        // 'name' => $faker->name,
        'content' => $sentence,
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});
