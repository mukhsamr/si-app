<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('app')->create('families', function (Blueprint $table) {
            $table->id();
            $table->string('kk')->unique();
            $table->string('father_name');
            $table->string('father_job')->nullable();
            $table->string('mother_name');
            $table->string('mother_job')->nullable();
            $table->unsignedInteger('children')->default(0);
            $table->text('address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('app')->dropIfExists('families');
    }
};
