<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

/**
 * Extends Spatie's base Role model only to expose the extra `description`
 * column added in the permission tables migration. Register this in
 * config/permission.php ('models.role' => \App\Models\Role::class) so
 * the package resolves this class instead of its own.
 */
class Role extends SpatieRole
{
    protected $fillable = [
        'name',
        'guard_name',
        'description',
    ];
}