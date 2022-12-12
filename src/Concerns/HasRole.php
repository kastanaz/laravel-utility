<?php

namespace Kastanaz\LaravelUtility\Concerns;

use Kastanaz\LaravelUtility\Models\Role;

trait HasRole
{
    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Change role of user
     *
     * @param mixed $role
     * @return void
     */
    public function changeRole($role)
    {
        if ($role instanceof Role) {
            $role = $role->id;
        }
        $this->role_id = $role;
        return $this->save();
    }

    public function hasPermission(string $inline): bool
    {
        if ($this->role) {
            return $this->role->can($inline);
        }

        return false;
    }
}
