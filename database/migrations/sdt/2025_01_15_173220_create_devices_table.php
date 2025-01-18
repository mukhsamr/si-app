<?php

use App\Models\Sdt\Rak;
use App\Models\Sdt\Student;
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
        Schema::connection('sdt')->create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('uid')->unique();
            $table->boolean('type')->default(false);
            $table->foreignIdFor(Rak::class)->constrained();
            $table->foreignIdFor(Student::class)->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('sdt')->dropIfExists('devices');
    }
};
