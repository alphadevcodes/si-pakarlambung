<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * Key-value store backing the Administrator's "System Settings" module.
 * `value` is stored as text but cast to its declared `type` on read via
 * the getTypedValueAttribute() accessor, so callers don't need to know
 * the underlying storage format.
 */
class Setting extends Model
{
    public const TYPE_STRING = 'string';
    public const TYPE_INTEGER = 'integer';
    public const TYPE_BOOLEAN = 'boolean';
    public const TYPE_JSON = 'json';

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'description',
    ];

    protected function typedValue(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: fn () => match ($this->type) {
                self::TYPE_INTEGER => (int) $this->value,
                self::TYPE_BOOLEAN => filter_var($this->value, FILTER_VALIDATE_BOOLEAN),
                self::TYPE_JSON => json_decode($this->value, true),
                default => $this->value,
            },
        );
    }

    /*
    |--------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------
    */

    public function scopeGroup($query, string $group)
    {
        return $query->where('group', $group);
    }

    /*
    |--------------------------------------------------------------------
    | Static helpers
    |--------------------------------------------------------------------
    */

    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::rememberForever("setting:{$key}", function () use ($key, $default) {
            $setting = static::where('key', $key)->first();

            return $setting ? $setting->typed_value : $default;
        });
    }

    public static function set(string $key, mixed $value, string $type = self::TYPE_STRING): self
    {
        $stored = $type === self::TYPE_JSON ? json_encode($value) : (string) $value;

        $setting = static::updateOrCreate(
            ['key' => $key],
            ['value' => $stored, 'type' => $type]
        );

        Cache::forget("setting:{$key}");

        return $setting;
    }
}