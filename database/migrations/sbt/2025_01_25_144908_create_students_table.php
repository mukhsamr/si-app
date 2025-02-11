<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('sbt')->create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->unique()->nullable();
            $table->string('name');
            $table->string('nickname')->nullable();
            $table->date('birth_date');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('sbt')->dropIfExists('students');
    }
};
