<?php

use App\Models\Santri\Plan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('santri')->create('plan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Plan::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('type', Plan::types());
            $table->text('content');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('santri')->dropIfExists('plan_details');
    }
};
