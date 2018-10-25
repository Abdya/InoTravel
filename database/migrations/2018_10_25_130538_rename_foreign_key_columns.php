<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameForeignKeyColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->renameColumn('owner', 'ownerId');
        });
        Schema::table('bookings', function (Blueprint $table) {
            $table->integer( 'propertyId');
        });
        Schema::table('country', function (Blueprint $table) {
            $table->renameColumn('country', 'countryId');
        });
        Schema::table('towns', function (Blueprint $table) {
            $table->renameColumn('country', 'countryId');
            $table->renameColumn('region', 'regionId');
        });
        Schema::table('regions', function (Blueprint $table) {
            $table->renameColumn('country', 'countryId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->renameColumn('ownerId', 'owner');
        });
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn( 'propertyId');
        });
        Schema::table('country', function (Blueprint $table) {
            $table->renameColumn('countryId', 'country');
        });
        Schema::table('towns', function (Blueprint $table) {
            $table->renameColumn('countryId', 'country');
            $table->renameColumn('regionId', 'region');
        });
        Schema::table('regions', function (Blueprint $table) {
            $table->renameColumn('countryId', 'country');
        });
    }
}
