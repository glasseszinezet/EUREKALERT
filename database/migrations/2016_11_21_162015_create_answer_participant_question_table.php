<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerParticipantQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_participant_question', function (Blueprint $table) {
            $table->integer('answer_id')->unsigned()->index()->foreign("answer_id")->references("answers")->onDelete("cascade");
            $table->integer('participant_id')->unsigned()->index()->foreign("participant_id")->references("participants")->onDelete("cascade");
            $table->integer('question_id')->unsigned()->index()->foreign("question_id")->references("questions")->onDelete("cascade");
            $table->timestamps();
//            $table->primary(['question_id','answer_id','question_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer_participant_question');
    }
}
