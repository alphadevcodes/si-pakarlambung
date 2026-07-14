<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * Historical medical cases entered by Medical Experts. This is the ONLY
 * source used to compute Prior Probability and Likelihood at diagnosis
 * time — those values are never persisted, only derived on demand from
 * validated rows here (validation_status = 'validated').
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('training_cases', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('case_number', 30)->unique();
            $table->foreignUuid('disease_id')->constrained('diseases')->restrictOnDelete()
                ->comment('Confirmed disease for this historical case');
            $table->unsignedTinyInteger('age');
            $table->string('gender', 10);
            $table->string('occupation', 100)->nullable();
            $table->text('medical_history')->nullable();
            $table->date('diagnosis_date');
            $table->string('validation_status', 20)->default('pending')
                ->comment('pending | validated | rejected');
            $table->foreignId('validated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('validated_at')->nullable();
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['disease_id', 'validation_status'], 'training_cases_disease_status_index');
            $table->index('validation_status');
            $table->index('diagnosis_date');
        });

        DB::statement("ALTER TABLE training_cases ADD CONSTRAINT chk_training_cases_age CHECK (age BETWEEN 0 AND 120)");
        DB::statement("ALTER TABLE training_cases ADD CONSTRAINT chk_training_cases_gender CHECK (gender IN ('male', 'female'))");
        DB::statement("ALTER TABLE training_cases ADD CONSTRAINT chk_training_cases_validation_status CHECK (validation_status IN ('pending', 'validated', 'rejected'))");
    }

    public function down(): void
    {
        Schema::dropIfExists('training_cases');
    }
};