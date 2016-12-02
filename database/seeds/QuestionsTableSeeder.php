<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Question::create(['text' => "How interested are you in the 2016 presidential election?"]);
        \App\Question::create(['text' => "Which of the following will you identify with?"]);
        \App\Question::create(['text' => "Regardless of how you might vote, who do you trust to do a better job with the Economy"]);
        \App\Question::create(['text' => "Regardless of how you might vote, who do you trust to do a better job in terms of Health"]);
        \App\Question::create(['text' => "Regardless of how you might vote, who do you trust to do a better job in terms of Education"]);
        \App\Question::create(['text' => "Regardless of how you might vote, who do you trust to do a better job in terms of Electricity"]);
        \App\Question::create(['text' => "Regardless of how you might vote, who do you trust to do a better job in terms of Water"]);
        \App\Question::create(['text' => "Who would you consider more trust trustworthy"]);
        \App\Question::create(['text' => "Regardless of how you plan to vote, who do you think WILL win in December"]);
        \App\Question::create(['text' => "Which comes closest to your feelings about the way the current government is working"]);
//        \App\Question::create(['text' => "Regardless of how you might vote, who do you trust to do a better job in regards to the Economy, Water, Health, Education and Electricity. Thanks for participating."]);
        \App\Question::create(['text' => "Who will you vote for to solve Ghana's issues"]);
    }
}
