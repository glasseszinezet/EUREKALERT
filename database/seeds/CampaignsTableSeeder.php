<?php

use Illuminate\Database\Seeder;

class CampaignsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Campaign::create(['name' => 'GH_POLLS', 'uuid' => "41e34ea6-f6f5-47a9-8e00-8300f3d959bb"]);
    }
}
