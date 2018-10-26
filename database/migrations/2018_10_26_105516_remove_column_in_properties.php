<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnInProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('pets');
            $table->dropColumn('houseplants');
            $table->dropColumn('smoking');
            $table->dropColumn('alcohol');
            $table->dropColumn('wifi');
            $table->dropColumn('tv');
            $table->dropColumn('airConditioning');
            $table->dropColumn('washer');
            $table->dropColumn('internet');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
