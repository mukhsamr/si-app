<?php

use App\Models\Family;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('app')->create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Family::class)->nullable()->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('nik')->unique()->nullable();
            $table->string('nis')->unique()->nullable();
            $table->string('name');
            $table->string('nickname')->nullable();
            $table->boolean('gender')->default(0);
            $table->date('birth_date');
            $table->string('birth_place')->nullable();
            $table->unsignedInteger('birth_order')->nullable();
            $table->string('school')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->unsignedInteger('weight')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('is_active')->default(0);
            $table->boolean('is_graduate')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('app')->dropIfExists('students');
    }
};
