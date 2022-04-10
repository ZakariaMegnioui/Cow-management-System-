<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionlaitieresujetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productionlaitieresujets', function (Blueprint $table) {
            $table->id();
            $table->integer('NLACT')->nullable();
            $table->string('AgeVelage', 9)->nullable();
            $table->decimal('KgLait', 18, 13)->nullable();
            $table->decimal('MG', 17, 16)->nullable();
            $table->decimal('KgMG', 18, 15)->nullable();
            $table->decimal('Prot', 18, 17)->nullable();
            $table->decimal('KgProt', 18, 15)->nullable();
            $table->bigInteger('sujet_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('sujet_id')->references(['id'])->on('sujets')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productionlaitieresujets');
    }
}
