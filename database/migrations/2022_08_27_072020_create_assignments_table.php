<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('semester_name');
            $table->string('group')->nullable();
            $table->string('assignment_title');
            $table->string('assignment_given_file');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('student_user_id')->nullable();         
            $table->string('assignment_taken_file')->nullable();
            $table->string('user_roll');         
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
        
        Schema::dropIfExists('assignments');
    }
}