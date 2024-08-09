<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerIdToProfilesTableV2 extends Migration
{
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Add the customer_id column if it doesn't already exist
            if (!Schema::hasColumn('profiles', 'customer_id')) {
                $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropColumn('customer_id');
        });
    }
}
