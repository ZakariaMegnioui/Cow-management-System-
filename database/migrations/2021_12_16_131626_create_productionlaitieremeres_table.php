<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionlaitieremeresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productionlaitieremeres', function (Blueprint $table) {
            $table->id();
            $table->integer('NLACT')->nullable();
            $table->string('AgeVelage', 9)->nullable();
            $table->decimal('KgLait', 19, 14)->nullable();
            $table->decimal('MG', 17, 16)->nullable();
            $table->decimal('KgMG', 18, 15)->nullable();
            $table->decimal('Prot', 19, 18)->nullable();
            $table->decimal('KgProt', 19, 16)->nullable();
            $table->bigInteger('meres_ID')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('meres_ID')->references(['id'])->on('meres')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productionlaitieremeres');
    }
}
