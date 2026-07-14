<?php

namespace App\Models;

use App\Models\Concerns\HasUuid;
use App\Models\Pivots\DiagnosisSymptom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * One row per diagnosis attempt (guest or registered — see `user()`).
 * This single model backs the public diagnosis flow, "Diagnosis History",
 * and "Saved Diagnosis": there is no separate table/model for guests,
 * since the only difference is a nullable user_id.
 */
class DiagnosisSession extends Model
{
    use HasFactory, HasUuid, SoftDeletes;

    public const STATUS_PENDING = 'pending';
    public const STATUS_COMPLETED = 'completed';

    protected $fillable = [
        'user_id',
        'full_name',
        'gender',
        'age',
        'occupation',
        'address',
        'phone_number',
        'medical_history',
        'additional_notes',
        'status',
        'ip_address',
        'user_agent',
        'diagnosed_at',
    ];

    protected function casts(): array
    {
        return [
            'age' => 'integer',
            'diagnosed_at' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Symptoms selected in Step 2 ("Diagnosis Answers").
     */
    public function symptoms(): BelongsToMany
    {
        return $this->belongsToMany(Symptom::class, 'diagnosis_symptoms')
            ->using(DiagnosisSymptom::class)
            ->withTimestamps();
    }

    /**
     * Full ranked list of candidate diseases with their computed
     * probability, ordered most-probable first.
     */
    public function results(): HasMany
    {
        return $this->hasMany(DiagnosisResult::class)->orderBy('rank_order');
    }

    /**
     * The single most probable disease for this session.
     */
    public function topResult(): HasOne
    {
        return $this->hasOne(DiagnosisResult::class)->where('is_top_result', true);
    }

    public function pdfExports(): HasMany
    {
        return $this->hasMany(PdfExportHistory::class);
    }

    /*
    |--------------------------------------------------------------------
    | Scopes / Helpers
    |--------------------------------------------------------------------
    */

    public function scopeGuests($query)
    {
        return $query->whereNull('user_id');
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    public function isGuest(): bool
    {
        return $this->user_id === null;
    }

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }
}