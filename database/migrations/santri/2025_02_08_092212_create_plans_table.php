<?php

use App\Models\Santri\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('santri')->create('plans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('title');
            $table->string('pdf')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('santri')->dropIfExists('plans');
    }
};
