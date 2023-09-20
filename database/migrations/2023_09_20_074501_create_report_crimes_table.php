<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('report_crimes', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('role');
            $table->string('gender');
            $table->string('crime_type');
            $table->text('description');
            $table->string('location');
            $table->string('random_code')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_crimes');
    }
};
