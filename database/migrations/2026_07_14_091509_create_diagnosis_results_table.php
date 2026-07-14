<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * Snapshot of the inference engine's OUTPUT for one diagnosis session —
 * one row per candidate disease in the ranking. This does NOT violate the
 * "don't store Prior/Likelihood/Posterior" rule: those intermediate values
 * are never written anywhere. Only the final computed percentage for a
 * completed, historical session is kept, purely so a user can revisit or
 * export a past result without re-running the calculation. Recomputing
 * probabilities from training_cases will never touch this table.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diagnosis_results', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('diagnosis_session_id')->constrained('diagnosis_sessions')->cascadeOnDelete();
            $table->foreignUuid('disease_id')->constrained('diseases')->restrictOnDelete();
            $table->decimal('probability_percentage', 6, 3);
            $table->unsignedTinyInteger('rank_order')->comment('1 = most probable disease');
            $table->boolean('is_top_result')->default(false);
            $table->string('algorithm', 30)->default('naive_bayes')
                ->comment('Allows future algorithms to coexist without a schema change');
            $table->timestamps();

            $table->unique(['diagnosis_session_id', 'disease_id'], 'diagnosis_results_unique');
            $table->index(['diagnosis_session_id', 'rank_order'], 'diagnosis_results_session_rank_index');
        });

        DB::statement("ALTER TABLE diagnosis_results ADD CONSTRAINT chk_diagnosis_results_probability CHECK (probability_percentage BETWEEN 0 AND 100)");
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnosis_results');
    }
};