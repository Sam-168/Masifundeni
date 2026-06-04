<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrolments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')       // student
                  ->constrained()
                  ->cascadeOnDelete();
            $table->foreignId('course_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->enum('status', ['pending', 'active', 'completed', 'dropped'])
                  ->default('pending');
            $table->decimal('grade', 5, 2)->nullable();  // e.g. 78.50
            $table->timestamp('enrolled_at')->nullable();
            $table->timestamps();

            // A student can only enrol in a course once
            $table->unique(['user_id', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrolments');
    }
};
