<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOpeningHoursToRestaurantsTable extends Migration
{
    public function up()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->time('opening_hours_start')->nullable();
            $table->time('opening_hours_end')->nullable();
        });
    }

    public function down()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropColumn(['opening_hours_start', 'opening_hours_end']);
        });
    }
}
