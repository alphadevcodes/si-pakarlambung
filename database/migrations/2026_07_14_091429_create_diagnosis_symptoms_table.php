<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The "Diagnosis Answers" from Step 2 — which symptoms the user checked
 * for a given diagnosis session. This is the input vector fed into the
 * Naive Bayes engine alongside the Knowledge Base and Training Dataset.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diagnosis_symptoms', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('diagnosis_session_id')->constrained('diagnosis_sessions')->cascadeOnDelete();
            $table->foreignUuid('symptom_id')->constrained('symptoms')->restrictOnDelete();
            $table->timestamps();

            $table->unique(['diagnosis_session_id', 'symptom_id'], 'diagnosis_symptoms_unique');
            $table->index('symptom_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnosis_symptoms');
    }
};