<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionAnswerOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_option_question', function (Blueprint $table) {
            $table->integer('question_id')->unsigned()->index()->foreign("question_id")->references("questions")->onDelete("cascade");
            $table->integer('answer_option_id')->unsigned()->index()->foreign("answer_option_id")->references("answer_options")->onDelete("cascade");
            $table->timestamps();
            $table->primary(['question_id','answer_option_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer_option_question');
    }
}
