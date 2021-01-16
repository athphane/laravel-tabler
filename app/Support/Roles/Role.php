<?php


namespace App\Support\Roles;


use App\Events\RolePermissionsUpdated;
use App\Support\AdminModel\AdminModel;
use App\Support\AdminModel\IsAdminModel;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole implements AdminModel
{
    use IsAdminModel;

    /**
     * Get the admin url attribute
     */
    public function getAdminUrlAttribute(): string
    {
        return route('admin.roles.edit', $this);
    }

    public function getAdminLinkNameAttribute(): string
    {
        return $this->description;
    }

    /**
     * Sync permissions
     *
     * @param array $permissions
     */
    public function syncPermissionIds($permissions)
    {
        $this->permissions()->sync($permissions);
    }
}
