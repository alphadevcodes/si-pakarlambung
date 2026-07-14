<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * This IS the Knowledge Base: it only records which symptoms belong to
 * which disease, as ticked by the Medical Expert. No probability, weight,
 * or likelihood value is stored here — those are computed at diagnosis
 * time by the inference engine from the Training Dataset, per the
 * "no stored probabilities" requirement. This keeps the schema algorithm
 * agnostic: a future inference engine (e.g. Decision Tree, Certainty Factor)
 * can reuse this exact table.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('disease_symptom', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('disease_id')->constrained('diseases')->cascadeOnDelete();
            $table->foreignUuid('symptom_id')->constrained('symptoms')->cascadeOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['disease_id', 'symptom_id'], 'disease_symptom_unique');
            $table->index('symptom_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disease_symptom');
    }
};