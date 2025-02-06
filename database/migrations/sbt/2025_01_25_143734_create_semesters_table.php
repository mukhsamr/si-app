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
        Schema::connection('sbt')->create('semesters', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('semester');
            $table->string('period');
            $table->boolean('is_active')->default(false);

            $table->unique(['semester', 'period']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('sbt')->dropIfExists('semesters');
    }
};
