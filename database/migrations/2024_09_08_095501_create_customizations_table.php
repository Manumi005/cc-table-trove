<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customizations', function (Blueprint $table) {
            $table->id();
            $table->json('customizations')->nullable();
            $table->json('special_occasion')->nullable();
            $table->string('table_location')->nullable();
            $table->string('additional_requests')->nullable(); // Add additional requests
            $table->unsignedBigInteger('reservation_id'); // Add reservation ID
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade'); // Add foreign key constraint
            $table->unique('reservation_id'); // Add unique constraint to reservation_id
            $table->timestamps();
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
            $table->dropUnique(['reservation_id']); // Drop unique constraint
        });

        Schema::dropIfExists('customizations');
    }
};
