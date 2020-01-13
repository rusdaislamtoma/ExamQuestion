<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeQuestionCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('make_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_id');
            $table->integer('subject_id');
            $table->unsignedInteger('subject_section_id')->nullable();
            $table->string('chapter');
            $table->enum('difficulty',['basic','medium','hard']);
            $table->text('question');
            $table->longText('image');
            $table->string('option');
            $table->double('mark',10,2);
            $table->softDeletes();
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
        Schema::dropIfExists('make_questions');
    }
}
