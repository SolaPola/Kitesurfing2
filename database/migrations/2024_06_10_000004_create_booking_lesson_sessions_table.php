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
        Schema::create('booking_lesson_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->foreignId('instructor_id')->nullable()->constrained('instructors')->nullOnDelete();
            $table->integer('lesson_number');
            $table->date('lesson_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['Scheduled', 'Completed', 'Cancelled', 'No-Show', 'Rescheduled'])->default('Scheduled');
            $table->text('instructor_notes')->nullable();
            $table->text('student_progress')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_lesson_sessions');
    }
};
