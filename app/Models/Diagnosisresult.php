<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * One row per candidate disease in a diagnosis session's ranking.
 * Purely a persisted OUTPUT snapshot — Prior/Likelihood/Posterior values
 * used to arrive at `probability_percentage` are never stored anywhere,
 * including here. Recalculating a session re-derives everything fresh
 * from TrainingCase data and simply replaces these rows.
 */
class DiagnosisResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnosis_session_id',
        'disease_id',
        'probability_percentage',
        'rank_order',
        'is_top_result',
        'algorithm',
    ];

    protected function casts(): array
    {
        return [
            'probability_percentage' => 'decimal:3',
            'rank_order' => 'integer',
            'is_top_result' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------
    */

    public function diagnosisSession(): BelongsTo
    {
        return $this->belongsTo(DiagnosisSession::class);
    }

    public function disease(): BelongsTo
    {
        return $this->belongsTo(Disease::class);
    }

    /*
    |--------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------
    */

    public function scopeTopResult($query)
    {
        return $query->where('is_top_result', true);
    }

    public function scopeOrderedByRank($query)
    {
        return $query->orderBy('rank_order');
    }
}