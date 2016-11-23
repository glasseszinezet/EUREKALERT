<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_question', function (Blueprint $table) {
            $table->integer('campaign_id')->unsigned()->index()->foreign("campaign_id")->references("campaigns")->onDelete("cascade");
            $table->integer('question_id')->unsigned()->index()->foreign("question_id")->references("questions")->onDelete("cascade");
            $table->timestamps();
            $table->primary(['campaign_id','question_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_question');
    }
}
