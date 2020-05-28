<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserQuestionAnswerTableSeeder::class,
            FavoritesTableSeeder::class,
            VotablesTableSeeder::class
        ]);


        //factory(App\Answer::class, 100)->create();

        //factory(App\Question::class, 10)->create();
    }
}
