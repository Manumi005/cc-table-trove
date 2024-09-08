<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueConstraintToCustomizationsTable extends Migration
{
    public function up()
    {
        Schema::table('customizations', function (Blueprint $table) {
            // Add unique constraint to reservation_id
            $table->unique('reservation_id');
        });
    }

    public function down()
    {
        Schema::table('customizations', function (Blueprint $table) {
            // Drop unique constraint from reservation_id
            $table->dropUnique(['reservation_id']);
        });
    }
}
