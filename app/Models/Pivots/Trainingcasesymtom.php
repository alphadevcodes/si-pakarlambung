<?php

namespace App\Models\Pivots;

use App\Models\Symptom;
use App\Models\TrainingCase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Explicit pivot model for training_case_symptom. Kept as a real class
 * (instead of an anonymous pivot) for consistency with DiseaseSymptom
 * and DiagnosisSymptom, and to leave room for future columns (e.g.
 * severity) without reshaping the relationship definitions.
 */
class TrainingCaseSymptom extends Pivot
{
    protected $table = 'training_case_symptom';

    public $incrementing = true;

    protected $fillable = [
        'training_case_id',
        'symptom_id',
    ];

    public function trainingCase(): BelongsTo
    {
        return $this->belongsTo(TrainingCase::class);
    }

    public function symptom(): BelongsTo
    {
        return $this->belongsTo(Symptom::class);
    }
}