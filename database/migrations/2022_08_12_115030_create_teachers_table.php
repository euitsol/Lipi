<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('department_name');
            $table->string('name');
            $table->string('address');
            $table->string('email', 100)->unique();
            $table->string('phone')->unique();
            $table->string('emp_date');
            $table->string('gender');
            $table->string('nationality');
            $table->string('photo');
            $table->string('resume');
            $table->string('username', 100)->unique()->nullable();
            $table->string('password')->nullable();
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
        Schema::dropIfExists('teachers');
    }
}
