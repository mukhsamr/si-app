<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('app')->create('semesters', function (Blueprint $table) {
            $table->id();
            $table->string('semester');
            $table->string('year');
            $table->boolean('is_active')->default(0);

            $table->unique(['semester', 'year']);
        });
    }

    public function down(): void
    {
        Schema::connection('app')->dropIfExists('semesters');
    }
};
