<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * Master data for gastric diseases. Managed by Administrator & Medical Expert.
 * UUID primary key: disease codes may be referenced publicly (diagnosis result
 * pages, PDF exports) without leaking sequential row counts.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diseases', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code', 20)->unique()->comment('Short clinical code, e.g. GASTRITIS-01');
            $table->string('name', 150);
            $table->string('slug', 180)->unique();
            $table->text('description');
            $table->text('causes')->nullable();
            $table->text('treatment')->nullable();
            $table->text('prevention')->nullable();
            $table->text('medical_advice')->nullable();
            $table->string('icon_path', 255)->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->index('is_active');
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diseases');
    }
};