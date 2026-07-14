<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Symptoms recorded as present in a given historical training case.
 * Combined with training_cases.disease_id, this is the raw frequency data
 * the Naive Bayes engine aggregates into Prior Probability and Likelihood
 * at request time.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('training_case_symptom', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('training_case_id')->constrained('training_cases')->cascadeOnDelete();
            $table->foreignUuid('symptom_id')->constrained('symptoms')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['training_case_id', 'symptom_id'], 'training_case_symptom_unique');
            $table->index('symptom_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_case_symptom');
    }
};