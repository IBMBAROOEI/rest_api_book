<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('password');
            $table->string('email')->unique();
            $table->integer('age');
            $table->string('image')->nullable();
            $table->date('birthday');
            $table->string('gender');
            $table->unsignedBigInteger('education_id');
            $table->foreign('Education_id')->references('id')->on('Educations')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('date_login')->nullable();
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
        Schema::dropIfExists('users');
    }
}
