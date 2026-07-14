<?php

namespace App\Models;

use App\Models\Concerns\HasUuid;
use App\Models\Pivots\TrainingCaseSymptom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * A historical, expert-confirmed case. Together with its symptoms this
 * is the ONLY data the Naive Bayes engine reads to derive Prior
 * Probability and Likelihood — nothing computed is ever written back
 * onto this model.
 */
class TrainingCase extends Model
{
    use HasFactory, HasUuid, SoftDeletes;

    public const STATUS_PENDING = 'pending';
    public const STATUS_VALIDATED = 'validated';
    public const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'case_number',
        'disease_id',
        'age',
        'gender',
        'occupation',
        'medical_history',
        'diagnosis_date',
        'validation_status',
        'validated_by',
        'validated_at',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'age' => 'integer',
            'diagnosis_date' => 'date',
            'validated_at' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------
    */

    public function disease(): BelongsTo
    {
        return $this->belongsTo(Disease::class);
    }

    public function symptoms(): BelongsToMany
    {
        return $this->belongsToMany(Symptom::class, 'training_case_symptom')
            ->using(TrainingCaseSymptom::class)
            ->withTimestamps();
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function validatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    /*
    |--------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------
    */

    public function scopeValidated($query)
    {
        return $query->where('validation_status', self::STATUS_VALIDATED);
    }

    public function scopePending($query)
    {
        return $query->where('validation_status', self::STATUS_PENDING);
    }

    public function scopeRejected($query)
    {
        return $query->where('validation_status', self::STATUS_REJECTED);
    }

    public function scopeForDisease($query, string $diseaseId)
    {
        return $query->where('disease_id', $diseaseId);
    }

    public function isValidated(): bool
    {
        return $this->validation_status === self::STATUS_VALIDATED;
    }
}