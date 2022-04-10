<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrandmerepaternellesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grandmerepaternelles', function (Blueprint $table) {
            $table->id();
            $table->string('N', 45)->nullable();
            $table->dateTime('DateNaissance')->nullable();
            $table->string('Race', 45)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grandmerepaternelles');
    }
}
