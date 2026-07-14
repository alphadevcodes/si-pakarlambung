<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * Extends Spatie's base Permission model for symmetry with App\Models\Role.
 * Register in config/permission.php ('models.permission' => \App\Models\Permission::class).
 */
class Permission extends SpatiePermission
{
    //
}