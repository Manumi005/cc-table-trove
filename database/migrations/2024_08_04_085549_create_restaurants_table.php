<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('contact_number')->nullable();
            $table->string('address')->nullable();
            $table->json('cuisine_type')->nullable();
            $table->string('opening_hours')->nullable();
            $table->text('details')->nullable();
            $table->json('images')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}
