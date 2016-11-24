<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Sistema\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Sistema\Entities\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'responsible' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'obs' => $faker->sentence,
    ];
});

$factory->define(Sistema\Entities\Project::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'progress' => $faker->numberBetween(1, 100),
        'status' => $faker->numberBetween(1, 3),
        'due_date' => $faker->date(),
        'owner_id' => $faker->numberBetween(1, 10),
        'client_id' => $faker->numberBetween(1, 10),
    ];
});

$factory->define(Sistema\Entities\ProjectNote::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->name,
        'note' => $faker->paragraph(),
        'project_id' => $faker->numberBetween(1, 10),
    ];
});

$factory->define(Sistema\Entities\ProjectTask::class, function (Faker\Generator $faker) {
        return [
            'name' => $faker->name,
            'start_date' => $faker->date(),
            'due_date' => $faker->date(),
            'status' => $faker->numberBetween(1, 3),
            'project_id' => $faker->numberBetween(1, 11),
        ];
});
