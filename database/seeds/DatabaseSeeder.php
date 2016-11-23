<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AnswerOptionsTableSeeder::class);
         $this->call(CampaignsTableSeeder::class);
//         $this->call(ParticipantTableSeeder::class);
         $this->call(QuestionsTableSeeder::class);
         $this->call(PivotTablesSeeder::class);
    }
}
