<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Property extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('region');
            $table->string('town');
            $table->string('address');
            $table->integer('beds');
            $table->string('photo');
            $table->integer('owner');
            $table->boolean('internet');
            $table->boolean('wifi');
            $table->boolean('tv');
            $table->boolean('airConditioning');
            $table->boolean('washer');
            $table->boolean('pets');
            $table->boolean('houseplants');
            $table->boolean('smoking');
            $table->boolean('alcohol');
            $table->string('extraInformation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('property');
    }
}
