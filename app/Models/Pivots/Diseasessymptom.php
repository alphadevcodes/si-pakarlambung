<?php

namespace App\Models\Pivots;

use App\Models\Disease;
use App\Models\Symptom;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Explicit pivot model for disease_symptom — this table IS the Knowledge
 * Base. Given its own class (rather than a plain belongsToMany array)
 * because it tracks `created_by`, which a generic pivot array would hide.
 */
class DiseaseSymptom extends Pivot
{
    protected $table = 'disease_symptom';

    public $incrementing = true;

    protected $fillable = [
        'disease_id',
        'symptom_id',
        'created_by',
    ];

    public function disease(): BelongsTo
    {
        return $this->belongsTo(Disease::class);
    }

    public function symptom(): BelongsTo
    {
        return $this->belongsTo(Symptom::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}