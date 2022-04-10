<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndexfonctionnelsperesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indexfonctionnelsperes', function (Blueprint $table) {
            $table->id();
            $table->decimal('SCS', 3)->nullable();
            $table->decimal('LONG', 2, 1)->nullable();
            $table->decimal('FERT', 2, 1)->nullable();
            $table->decimal('FN', 2, 1)->nullable();
            $table->decimal('FV', 2, 1)->nullable();
            $table->integer('Precision')->nullable();
            $table->bigInteger('pere_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('pere_id')->references(['id'])->on('peres')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indexfonctionnelsperes');
    }
}
