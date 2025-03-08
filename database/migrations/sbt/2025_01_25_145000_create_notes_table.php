<?php

use App\Enums\Unit;
use App\Models\Sbt\Student;
use App\Models\Sbt\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('sbt')->create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('title');
            $table->enum('unit', Unit::values());
            $table->boolean('type')->default(0);
            $table->text('note');
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('sbt')->dropIfExists('notes');
    }
};
