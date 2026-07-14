<?php

namespace App\Models;

use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * One row per PDF export of a diagnosis result. A registered-user-only
 * feature — the Service/Policy layer is responsible for rejecting guests
 * before a row here would ever be created.
 */
class PdfExportHistory extends Model
{
    use HasFactory, HasUuid;

    public $timestamps = true;

    protected $fillable = [
        'diagnosis_session_id',
        'user_id',
        'file_path',
        'file_name',
        'file_size_bytes',
        'exported_at',
    ];

    protected function casts(): array
    {
        return [
            'exported_at' => 'datetime',
            'file_size_bytes' => 'integer',
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}