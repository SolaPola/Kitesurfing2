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
        // Only run if table doesn't exist to avoid conflicts
        if (!Schema::hasTable('instructors')) {
            Schema::create('instructors', function (Blueprint $table) {
                $table->id(); // Id (PK)
                $table->foreignId('user_id')->constrained()->onDelete('cascade'); // UserId (FK)
                $table->string('number')->nullable(); // Make it nullable to avoid conflicts
                $table->boolean('isactive')->default(true); // Isactive
                $table->text('remark')->nullable(); // Remark
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructors');
    }
};
