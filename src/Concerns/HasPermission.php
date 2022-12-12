<?php

namespace Kastanaz\LaravelUtility\Concerns;

use Facades\Kastanaz\LaravelUtility\Services\PermissionService;
use Kastanaz\LaravelUtility\Models\Permission;
use Kastanaz\LaravelUtility\Services\RoleService;

trait HasPermission
{
    public function permissions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Permission::class);
    }

    public function can(string $name, string $action = null): bool
    {
        if (is_null($action)) {
            $explode = explode('-', $name);
            $name = $explode[0];
            $action = $explode[1];
        }

        if (!PermissionService::isPermissionActive($name, $action)) {
            return false;
        }

        if ($this->isSuperadmin()) {
            return true;
        }
        $permissions = $this->permissions->keyBy('name');
        return isset($permissions[$name]) ? $permissions[$name]->$action : false;
    }

    public function setPermissions(array $permissions)
    {
        $service = new RoleService($this->id);
        $service->setPermissions($permissions);
    }

    public function isSuperadmin(): bool
    {
        return $this->level == 1;
    }
}
