<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'code' => $faker->postcode,
        'name' => $faker->name,
        'age' => $faker->numberBetween($min = 10, $max = 20),
        'gender' => $faker->numberBetween(0,1),
        'email' => $faker->freeEmail,
        'address'=> $faker->address
    ];
});
