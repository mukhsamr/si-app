<?php

use App\Models\Student\Plan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('student')->create('plan_details', function (Blueprint $table) {
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

    public function down(): void
    {
        Schema::connection('student')->dropIfExists('plan_details');
    }
};
