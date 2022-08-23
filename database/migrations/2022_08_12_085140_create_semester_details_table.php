<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemesterDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semester_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('semester_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('teacher_id');
            $table->timestamps();
            
            $table->foreign('department_id')->references('id')->on("departments")->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('semester_id')->references('id')->on("semesters")->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on("subject_n")->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on("teachers")->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semester_details');
    }
}