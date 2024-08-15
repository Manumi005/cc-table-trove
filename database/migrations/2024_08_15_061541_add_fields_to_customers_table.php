<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToCustomersTable extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            if (!Schema::hasColumn('customers', 'allergies')) {
                $table->json('allergies')->nullable();
            }

            if (!Schema::hasColumn('customers', 'preferences')) {
                $table->json('preferences')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['allergies', 'preferences']);
        });
    }
}
