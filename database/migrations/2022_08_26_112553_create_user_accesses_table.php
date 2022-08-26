<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_accesses', function (Blueprint $table) {
            $table->id();
            $table->string('user_roll');
            $table->string('create')->nullable();
            $table->string('edit')->nullable();
            $table->string('delete')->nullable();
            $table->string('department')->nullable();
            $table->string('semester')->nullable();
            $table->string('subject')->nullable();
            $table->string('semester_details')->nullable();
            $table->string('group')->nullable();
            $table->string('class_room')->nullable();
            $table->string('routine')->nullable();
            $table->string('attendance')->nullable();           
            $table->string('assignment')->nullable();
            $table->string('assignment_given')->nullable();
            $table->string('assignment_taken')->nullable();
            $table->string('notice')->nullable();
            $table->string('user')->nullable();
            $table->string('teacher')->nullable();
            $table->string('exam')->nullable();
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
        Schema::dropIfExists('user_accesses');
    }
}