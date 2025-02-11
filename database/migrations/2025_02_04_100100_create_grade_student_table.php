<?php

use App\Models\Grade;
use App\Models\Semester;
use App\Models\Student;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('app')->create('grade_student', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(Grade::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(Semester::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();

            $table->unique(['student_id', 'grade_id', 'semester_id']);
        });
    }

    public function down(): void
    {
        Schema::connection('app')->dropIfExists('grade_student');
    }
};
