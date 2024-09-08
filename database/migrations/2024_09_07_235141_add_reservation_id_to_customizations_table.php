<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReservationIdToCustomizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customizations', function (Blueprint $table) {
            $table->unsignedBigInteger('reservation_id')->after('id'); // Add the column after the id column
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade'); // Add foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customizations', function (Blueprint $table) {
            $table->dropForeign(['reservation_id']); // Drop foreign key first
            $table->dropColumn('reservation_id'); // Then drop the column
        });
    }
}
