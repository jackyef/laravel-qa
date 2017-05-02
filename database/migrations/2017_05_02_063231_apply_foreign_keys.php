<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ApplyForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function(Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->unsigned();
            $table->foreign('first_post_id')
                ->references('id')->on('posts')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->unsigned();
            $table->foreign('accepted_answer_id')
                ->references('id')->on('posts')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->unsigned();
        });


        Schema::table('posts', function(Blueprint $table) {
            $table->foreign('question_id')
                ->references('id')->on('questions')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->unsigned();
        });


        Schema::table('comments', function(Blueprint $table) {
            $table->foreign('post_id')
                ->references('id')->on('posts')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->unsigned();
        });


        Schema::table('question_has_tags', function(Blueprint $table) {
            $table->foreign('question_id')
                ->references('id')->on('questions')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->unsigned();
            $table->foreign('tag_id')
                ->references('id')->on('tags')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->unsigned();
        });


        Schema::table('user_voted_posts', function(Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->unsigned();
            $table->foreign('post_id')
                ->references('id')->on('posts')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->unsigned();
        });



        Schema::table('user_voted_comments', function(Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->unsigned();
            $table->foreign('comment_id')
                ->references('id')->on('comments')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->unsigned();
        });





    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
