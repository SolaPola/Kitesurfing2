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
        // Only modify the table if it exists
        if (Schema::hasTable('instructors')) {
            Schema::table('instructors', function (Blueprint $table) {
                // Only add columns if they don't exist
                if (!Schema::hasColumn('instructors', 'number')) {
                    $table->string('number')->nullable();
                }
                if (!Schema::hasColumn('instructors', 'phone')) {
                    $table->string('phone')->nullable();
                }
                if (!Schema::hasColumn('instructors', 'address')) {
                    $table->string('address')->nullable();
                }
                if (!Schema::hasColumn('instructors', 'city')) {
                    $table->string('city')->nullable();
                }
                if (!Schema::hasColumn('instructors', 'postal_code')) {
                    $table->string('postal_code')->nullable();
                }
                if (!Schema::hasColumn('instructors', 'bsn')) {
                    $table->string('bsn', 9)->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // If you need to rollback, drop the columns
        if (Schema::hasTable('instructors')) {
            Schema::table('instructors', function (Blueprint $table) {
                $columns = ['number', 'phone', 'address', 'city', 'postal_code', 'bsn'];
                $existingColumns = [];

                foreach ($columns as $column) {
                    if (Schema::hasColumn('instructors', $column)) {
                        $existingColumns[] = $column;
                    }
                }

                if (!empty($existingColumns)) {
                    $table->dropColumn($existingColumns);
                }
            });
        }
    }
};
