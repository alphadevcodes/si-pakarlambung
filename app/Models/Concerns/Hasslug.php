<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

/**
 * Applied to models that expose a public-friendly slug derived from `name`
 * (diseases, symptoms). Keeps slug generation out of controllers/Livewire
 * components so it can never be forgotten or duplicated (DRY, SRP).
 */
trait HasSlug
{
    public static function bootHasSlug(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug) && ! empty($model->name)) {
                $model->slug = $model->generateUniqueSlug($model->name);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('name') && ! $model->isDirty('slug')) {
                $model->slug = $model->generateUniqueSlug($model->name, $model->getKey());
            }
        });
    }

    protected function generateUniqueSlug(string $name, ?string $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $suffix = 1;

        $query = static::withTrashed()->where('slug', $slug);
        if ($ignoreId) {
            $query->whereKeyNot($ignoreId);
        }

        while ($query->exists()) {
            $slug = "{$base}-{$suffix}";
            $suffix++;

            $query = static::withTrashed()->where('slug', $slug);
            if ($ignoreId) {
                $query->whereKeyNot($ignoreId);
            }
        }

        return $slug;
    }
}