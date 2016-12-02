<?php

use Illuminate\Database\Seeder;

class PivotTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Campaign::find(1)->questions()->sync(App\Question::all()->pluck('id')->toArray());
        App\Question::find(1)->answerOptions()->sync([18,11,17,10,21,12]);
        App\Question::find(2)->answerOptions()->sync([1,2,3,4,5,6,21]);
        App\Question::find(3)->answerOptions()->sync([9,13,14,16,19,20]);
        App\Question::find(4)->answerOptions()->sync([9,13,14,16,19,20]);
        App\Question::find(5)->answerOptions()->sync([9,13,14,16,19,20]);
        App\Question::find(6)->answerOptions()->sync([9,13,14,16,19,20]);
        App\Question::find(7)->answerOptions()->sync([9,13,14,16,19,20]);
        App\Question::find(8)->answerOptions()->sync([9,13,14,16,19,20]);
        App\Question::find(9)->answerOptions()->sync([9,13,14,16,19,20]);
        App\Question::find(10)->answerOptions()->sync([8,12,15,21,22,23]);
        App\Question::find(11)->answerOptions()->sync([1,2,3,4,5,6,21]);
    }
}
