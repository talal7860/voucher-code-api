<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\SpecialOffer::class, function (Faker $faker) {
  return [
    'name' => $faker->name,
    'discount_percentage_cents' => $faker->randomNumber(4)
  ];
});
