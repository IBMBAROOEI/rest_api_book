<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name_writer');
            $table->string('name_book');
            $table->string('image')->nullable();
            $table->date('year_printbook')->nullable();
            $table->integer('view_book')->default(0);
            $table->integer('price_book');
            $table->integer('status')->default(0);
            $table->unsignedBigInteger('categore_id');
            $table->foreign('categore_id')->references('id')->on('categores')->onDelete('cascade');
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
        Schema::dropIfExists('Books');
    }
}
