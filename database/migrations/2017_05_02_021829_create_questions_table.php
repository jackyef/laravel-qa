<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question_title');
            $table->integer('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->unsigned();
            $table->integer('first_post_id');
            $table->foreign('first_post_id')
                ->references('id')->on('posts')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->unsigned();
            $table->integer('accepted_answer_id');
            $table->foreign('accepted_answer_id')
                ->references('id')->on('posts')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->unsigned();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
