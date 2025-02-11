<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('app')->create('grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('grade');
            $table->string('type');

            $table->unique(['grade', 'type']);
        });
    }

    public function down(): void
    {
        Schema::connection('app')->dropIfExists('grades');
    }
};
