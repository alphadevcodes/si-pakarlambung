<?php

namespace App\Models;

use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Generic audit trail row. `auditable_type` / `auditable_id` follow
 * Laravel's default morph column naming, so any current or future model
 * (Disease, Symptom, TrainingCase, Role, ...) can be audited via the same
 * table without new migrations.
 */
class AuditLog extends Model
{
    use HasUuid;

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'action',
        'auditable_type',
        'auditable_id',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
    ];

    protected function casts(): array
    {
        return [
            'old_values' => 'array',
            'new_values' => 'array',
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

    public function auditable(): MorphTo
    {
        return $this->morphTo();
    }

    /*
    |--------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------
    */

    public function scopeAction($query, string $action)
    {
        return $query->where('action', $action);
    }

    public function scopeForModel($query, string $type, string $id)
    {
        return $query->where('auditable_type', $type)->where('auditable_id', $id);
    }
}