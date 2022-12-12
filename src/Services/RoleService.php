<?php

namespace Kastanaz\LaravelUtility\Services;

use Illuminate\Support\Collection;
use Kastanaz\LaravelUtility\Models\Permission;

class RoleService
{
    private string $roleId;

    public function __construct(string $roleId)
    {
        $this->roleId = $roleId;
    }

    public function setPermission(string $name, array $permission): Permission
    {
        return Permission::updateOrCreate(['role_id' => $this->roleId, 'name' => $name], [
            'create' => $permission['create'],
            'read' => $permission['read'],
            'update' => $permission['update'],
            'delete' => $permission['delete'],
            'manage_other' => $permission['manage_other'],
        ]);
    }

    public function setPermissions(array $permissions): bool
    {
        foreach ($permissions as $name => $permission) {
            $this->setPermission($name, $permission);
        }

        return true;
    }
}
