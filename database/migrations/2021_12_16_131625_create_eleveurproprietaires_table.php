<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEleveurproprietairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eleveurproprietaires', function (Blueprint $table) {
            $table->id();
            $table->string('Nom', 21)->nullable();
            $table->string('Prenom', 17)->nullable();
            $table->string('Adresse', 42)->nullable();
            $table->string('CIN')->nullable()->unique();
            $table->string('Etat')->nullable();
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
        Schema::dropIfExists('eleveurproprietaires');
    }
}
