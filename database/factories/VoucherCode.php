<?php

use Faker\Generator as Faker;
use App\SpecialOffer;
use App\Recipient;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\VoucherCode::class, function (Faker $faker) {
  $specialOffer = factory(SpecialOffer::class)->create();
  $recipient = factory(Recipient::class)->create();
  return [
    'special_offer_id' => $specialOffer->id,
    'recipient_id' => $recipient->id,
    'expiration_date' => $faker->dateTimeBetween('+ 10 days', '+ 1 year')->format('Y-m-d H:i:s')
  ];
});
