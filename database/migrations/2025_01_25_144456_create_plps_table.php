<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('app')->create('plps', function (Blueprint $table) {
            $table->id();
            $table->string('plp');
            $table->string('type');

            $table->unique(['plp', 'type']);
        });
    }

    public function down(): void
    {
        Schema::connection('app')->dropIfExists('plps');
    }
};
