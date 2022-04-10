<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSujetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sujets', function (Blueprint $table) {

            $table->id();

            $table->string('NSNIT', 16)->nullable();
            $table->dateTime('DateNaissance')->nullable();
            $table->string('Race', 8)->nullable();
            $table->string('Adresse', 42)->nullable();
            $table->string('NTravail', 45)->unique();
            $table->string('Type', 45)->nullable();
            $table->string('Etat', 45)->nullable();
            $table->string('Sexe', 45)->nullable();
            $table->string('Cause')->nullable();
            $table->string('InfoCause')->nullable();
            $table->string("image1")->nullable();;
            $table->string("image2")->nullable();;
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('meres_ID')->nullable()->unsigned();
            $table->bigInteger('peres_ID')->nullable()->unsigned();
            $table->bigInteger('GrandPerePaternels_ID')->unsigned()->nullable();
            $table->bigInteger('GrandPereMaternels_ID')->unsigned()->nullable();
            $table->bigInteger('GrandMerePaternelles_ID')->unsigned()->nullable();
            $table->bigInteger('GrandMereMaternelles_ID')->unsigned()->nullable();
            $table->bigInteger('EleveurProprietaires_ID')->unsigned()->nullable();
            $table->bigInteger('EleveurNaisseurs_ID')->unsigned()->nullable();
             $table->foreign('user_id')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('meres_ID')->references(['id'])->on('meres')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('peres_ID')->references(['id'])->on('peres')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('GrandPerePaternels_ID')->references(['id'])->on('grandperepaternels')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('GrandPereMaternels_ID')->references(['id'])->on('grandperematernels')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('GrandMerePaternelles_ID')->references(['id'])->on('grandmerepaternelles')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('GrandMereMaternelles_ID')->references(['id'])->on('grandmerematernelles')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('EleveurProprietaires_ID')->references(['id'])->on('eleveurproprietaires')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('EleveurNaisseurs_ID')->references(['id'])->on('eleveurnaisseurs')->onUpdate('CASCADE')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sujets');

    }
}
