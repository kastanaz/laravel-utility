<?php

namespace Kastanaz\LaravelUtility\Services;

use Illuminate\Support\Collection;

class PermissionService
{
    private Collection $permissions;

    public function __construct()
    {
        $this->permissions = collect($this->getConfigPermission());
    }

    private function getConfigPermission()
    {
        return config('permission.list');
    }

    public function getListPermission(): Collection
    {
        return $this->permissions->map(function($item) {
            $item['alias'] = __('utility::' . $item['alias']);

            foreach ($item['permission'] as $inline => $value) {
                $item['inline'][$item['name'] .'-'. $inline] = $value;
            }

            return $item;
        });
    }

    public function getPermission($name)
    {
        return $this->permissions->where('name', $name);
    }

    public function isPermissionActive($name, $action)
    {
        return $this->permissions->where('name', $name)->first()['permission'][$action];
    }

    // public function getInlineName(array $permission)
    // {
    //     return $permission['name']
    // }
}
