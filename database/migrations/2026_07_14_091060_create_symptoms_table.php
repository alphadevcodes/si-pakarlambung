<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Master data for symptoms shown on the public diagnosis checklist (Step 2)
 * and used to build the Knowledge Base / Training Dataset.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('symptoms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code', 20)->unique()->comment('e.g. SYM-001');
            $table->string('name', 150);
            $table->string('slug', 180)->unique();
            $table->text('description')->nullable();
            $table->string('category', 100)->nullable()->comment('Optional grouping, e.g. Digestive, Pain');
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->index('is_active');
            $table->index('category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('symptoms');
    }
};