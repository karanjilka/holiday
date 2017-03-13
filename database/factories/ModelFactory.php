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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Holiday::class, function (Faker\Generator $faker) {
	$rand_ar = ['0','1'];
	shuffle($rand_ar);
    return [
    	'name'=>$faker->sentence(),
    	'image'=>'deafult-event.jpg',
    	'summary'=>$faker->text,
    	'description'=>$faker->text,
    	'start_date'=>$faker->date(),
    	'end_date'=>$faker->date(),
    	'date_explanation'=>$faker->text,
    	'type'=>'A',
    	'fixed'=>$rand_ar[0],
    ];
});
$factory->define(App\HolidaySubscriber::class, function (Faker\Generator $faker) {
	$daily_ar = ['0','1'];
	$month_ar = ['0','1'];
	$week_ar = ['0','1'];
	shuffle($daily_ar);
	shuffle($month_ar);
	shuffle($week_ar);
    return [
    	'email_id' => $faker->unique()->safeEmail,
    	'daily_preference'=>$daily_ar[0],
    	'weekly_preference'=>$month_ar[0],
    	'monthly_preference'=>$week_ar[0],
        'active'=>'1'
    ];
});
