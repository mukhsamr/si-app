<?php

use App\Models\Sbt\Plan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('sbt')->create('plan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Plan::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('type', [
                "title",
                "timeline",
                "stepline",
                "mayor_agenda",
                "minor_routine",
            ]);
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('sbt')->dropIfExists('plan_details');
    }
};
