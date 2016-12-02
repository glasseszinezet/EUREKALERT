<?php

use Illuminate\Database\Seeder;

class AnswerOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        App\AnswerOption::create(['text' => "PPP"]);
        App\AnswerOption::create(['text' => "PNC"]);
        App\AnswerOption::create(['text' => "NDP"]);
        App\AnswerOption::create(['text' => "CPP"]);
        App\AnswerOption::create(['text' => "NPP"]);
        App\AnswerOption::create(['text' => "NDC"]);
        App\AnswerOption::create(['text' => "Angry"]);
        App\AnswerOption::create(['text' => "Satisfied"]);
        App\AnswerOption::create(['text' => "Nana Addo"]);
        App\AnswerOption::create(['text' => "Don't Know"]);
        App\AnswerOption::create(['text' => "Interested"]);
        App\AnswerOption::create(['text' => "Don't care"]);
        App\AnswerOption::create(['text' => "John Mahama"]);
        App\AnswerOption::create(['text' => "Nana Konadu"]);
        App\AnswerOption::create(['text' => "Enthusiastic"]);
        App\AnswerOption::create(['text' => "Edward Mahama"]);
        App\AnswerOption::create(['text' => "Not interested"]);
        App\AnswerOption::create(['text' => "Very Interested"]);
        App\AnswerOption::create(['text' => "Paa Kwesi Ndoum"]);
        App\AnswerOption::create(['text' => "Ivor Greenstreet"]);
        App\AnswerOption::create(['text' => "None of the above"]);
        App\AnswerOption::create(['text' => "Dissatisfied"]);
        App\AnswerOption::create(['text' => "Satisfied, but not enthusiastic"]);

    }
}
