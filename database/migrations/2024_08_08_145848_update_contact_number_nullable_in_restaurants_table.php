<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            // Modify the contact_number column to be nullable
            $table->string('contact_number', 20)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            // Revert contact_number column to be not nullable
            $table->string('contact_number', 20)->nullable(false)->change();
        });
    }
};
