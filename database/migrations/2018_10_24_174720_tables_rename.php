<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablesRename extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('town', 'towns');
        Schema::rename('region', 'regions');
        Schema::rename('booking', 'bookings');
        Schema::rename('property', 'properties');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('towns', 'town');
        Schema::rename('regions', 'region');
        Schema::rename('bookings', 'booking');
        Schema::rename('properties', 'property');
    }
}
