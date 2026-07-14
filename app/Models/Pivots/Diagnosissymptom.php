<?php

namespace App\Models\Pivots;

use App\Models\DiagnosisSession;
use App\Models\Symptom;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Explicit pivot model for diagnosis_symptoms — the checked symptoms
 * ("Diagnosis Answers") for one diagnosis session.
 */
class DiagnosisSymptom extends Pivot
{
    protected $table = 'diagnosis_symptoms';

    public $incrementing = true;

    protected $fillable = [
        'diagnosis_session_id',
        'symptom_id',
    ];

    public function diagnosisSession(): BelongsTo
    {
        return $this->belongsTo(DiagnosisSession::class);
    }

    public function symptom(): BelongsTo
    {
        return $this->belongsTo(Symptom::class);
    }
}