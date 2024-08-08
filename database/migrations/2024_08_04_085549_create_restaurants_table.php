<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name'); // Restaurant name
            $table->string('email')->unique(); // Unique email address
            $table->string('contact_number', 20)->nullable(); // Contact number, nullable
            $table->string('address'); // Restaurant address
            $table->json('cuisine_type'); // JSON field for storing cuisine types
            $table->timestamp('email_verified_at')->nullable(); // Timestamp for email verification
            $table->string('password'); // Password field
            $table->rememberToken(); // Token for "remember me" functionality
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('restaurants'); // Drop the table if the migration is rolled back
    }
};
