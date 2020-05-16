<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use App\Question;
use App\User;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraphs(rand(3, 7), true),
        'votes_count' => rand(0, 100),
        'user_id' => User::pluck('id')->random(),
        'question_id' => Question::pluck('id')->random()
    ];
});
