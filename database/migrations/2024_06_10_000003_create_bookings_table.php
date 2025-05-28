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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->foreignId('instructor_id')->nullable()->constrained('instructors')->nullOnDelete();

            // Customer details (useful when user is not registered yet)
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();

            // Booking details
            $table->date('preferred_date');
            $table->time('preferred_time')->nullable();
            $table->integer('number_of_participants');
            $table->enum('experience_level', ['Beginner', 'Novice', 'Intermediate', 'Advanced'])->default('Beginner');
            $table->text('special_requests')->nullable();

            // Payment and status
            $table->decimal('total_price', 8, 2);
            $table->enum('status', ['Pending', 'Confirmed', 'Completed', 'Cancelled', 'No-Show', 'Rescheduled'])->default('Pending');
            $table->boolean('is_paid')->default(false);
            $table->string('payment_method')->nullable();
            $table->string('payment_reference')->nullable();
            $table->timestamp('paid_at')->nullable();

            // Administrative fields
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
