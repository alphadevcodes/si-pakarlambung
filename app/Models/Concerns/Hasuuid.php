<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

/**
 * Applied to every model whose PK is a UUID (diseases, symptoms,
 * training_cases, diagnosis_sessions, pdf_export_histories, audit_logs).
 * Centralizing this avoids repeating the same boot() logic on six models.
 */
trait HasUuid
{
    public static function bootHasUuid(): void
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function initializeHasUuid(): void
    {
        $this->keyType = 'string';
        $this->incrementing = false;
    }
}