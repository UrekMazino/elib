<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csfs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('rating1');
            $table->integer('rating2');
            $table->integer('rating3');
            $table->integer('rating4');
            $table->integer('rating5');
            $table->integer('rating6');
            $table->integer('rating7');
            $table->string('comment1');
            $table->string('comment2');
            $table->string('comment3');
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
        Schema::dropIfExists('csfs');
    }
}
