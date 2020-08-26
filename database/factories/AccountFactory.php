<?php

/** @var Factory $factory */

use App\Account;
use App\Model;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
