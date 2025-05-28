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
        // Check if the timeslots table exists
        if (!Schema::hasTable('timeslots')) {
            // Create the timeslots table first if it doesn't exist
            Schema::create('timeslots', function (Blueprint $table) {
                $table->id();
                $table->time('start_time');
                $table->time('end_time');
                $table->foreignId('location_id')->constrained()->onDelete('cascade');
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // Add timeslot_id column to bookings table
        if (Schema::hasTable('bookings') && !Schema::hasColumn('bookings', 'timeslot_id')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->foreignId('timeslot_id')->nullable()->after('preferred_date');

                // Add foreign key constraint only if the timeslots table exists
                if (Schema::hasTable('timeslots')) {
                    $table->foreign('timeslot_id')->references('id')->on('timeslots')->nullOnDelete();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('bookings') && Schema::hasColumn('bookings', 'timeslot_id')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->dropForeign(['timeslot_id']);
                $table->dropColumn('timeslot_id');
            });
        }

        // Drop the timeslots table only if it was created by this migration
        if (Schema::hasTable('timeslots')) {
            Schema::dropIfExists('timeslots');
        }
    }
};
