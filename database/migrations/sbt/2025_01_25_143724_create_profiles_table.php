<?php

use App\Models\Sbt\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('sbt')->create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('name');
            $table->string('nickname');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('sbt')->dropIfExists('profiles');
    }
};
