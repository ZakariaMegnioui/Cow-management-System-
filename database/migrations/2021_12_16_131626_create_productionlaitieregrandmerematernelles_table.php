<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionlaitieregrandmerematernellesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productionlaitieregrandmerematernelles', function (Blueprint $table) {
            $table->id();
            $table->integer('N_LACT')->nullable();
            $table->string('Age_V_lage', 9)->nullable();
            $table->string('Kg_Lait', 18)->nullable();
            $table->decimal('MG', 19, 18)->nullable();
            $table->decimal('KgMG', 18, 15)->nullable();
            $table->decimal('Prot', 19, 18)->nullable();
            $table->decimal('KgProt', 19, 16)->nullable();
            $table->bigInteger('GMMaternelle_Id')->unsigned();;
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('GMMaternelle_Id')->references(['id'])->on('grandmerematernelles')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productionlaitieregrandmerematernelles');
    }
}
