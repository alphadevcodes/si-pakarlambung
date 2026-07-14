<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use App\Models\Concerns\HasUuid;
use App\Models\Pivots\DiagnosisSymptom;
use App\Models\Pivots\DiseaseSymptom;
use App\Models\Pivots\TrainingCaseSymptom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Master data for a symptom. Shown as a checkbox on the public diagnosis
 * form (Step 2) and reused across the Knowledge Base and Training Dataset.
 */
class Symptom extends Model
{
    use HasFactory, HasUuid, HasSlug, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'slug',
        'description',
        'category',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------
    */

    public function diseases(): BelongsToMany
    {
        return $this->belongsToMany(Disease::class, 'disease_symptom')
            ->using(DiseaseSymptom::class)
            ->withPivot(['created_by'])
            ->withTimestamps();
    }

    public function trainingCases(): BelongsToMany
    {
        return $this->belongsToMany(TrainingCase::class, 'training_case_symptom')
            ->using(TrainingCaseSymptom::class)
            ->withTimestamps();
    }

    public function diagnosisSessions(): BelongsToMany
    {
        return $this->belongsToMany(DiagnosisSession::class, 'diagnosis_symptoms')
            ->using(DiagnosisSymptom::class)
            ->withTimestamps();
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /*
    |--------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}