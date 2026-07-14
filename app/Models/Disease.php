<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use App\Models\Concerns\HasUuid;
use App\Models\Pivots\DiseaseSymptom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Master data for a gastric disease. Deliberately "thin": it exposes
 * relationships and simple query scopes only. Computing probabilities
 * or rankings does NOT belong here — that's the Inference Engine
 * service's job (Single Responsibility Principle).
 */
class Disease extends Model
{
    use HasFactory, HasUuid, HasSlug, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'slug',
        'description',
        'causes',
        'treatment',
        'prevention',
        'medical_advice',
        'icon_path',
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

    /**
     * The Knowledge Base: symptoms the Medical Expert has associated
     * with this disease. No probability/weight column on the pivot.
     */
    public function symptoms(): BelongsToMany
    {
        return $this->belongsToMany(Symptom::class, 'disease_symptom')
            ->using(DiseaseSymptom::class)
            ->withPivot(['created_by'])
            ->withTimestamps();
    }

    public function trainingCases(): HasMany
    {
        return $this->hasMany(TrainingCase::class);
    }

    public function diagnosisResults(): HasMany
    {
        return $this->hasMany(DiagnosisResult::class);
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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}