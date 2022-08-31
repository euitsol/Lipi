<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsssJtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dsss_jts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('semester_id');
            $table->string('student_id');
            $table->unsignedBigInteger('section_id');
            $table->string('session');
            $table->timestamps();
            
            $table->foreign('department_id')->references('id')->on("departments")->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('semester_id')->references('id')->on("semesters")->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on("section")->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dsss_jts');
    }
}