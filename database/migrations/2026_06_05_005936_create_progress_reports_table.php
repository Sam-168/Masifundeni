<?php

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
        Schema::create('progress_reports', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('course_id')->constrained()->cascadeOnDelete();
        $table->decimal('average_grade', 5, 2)->default(0);
        $table->integer('completed_items')->default(0);
        $table->timestamp('generated_at')->nullable();
        $table->timestamps();

        $table->unique(['student_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_reports');
    }
};
