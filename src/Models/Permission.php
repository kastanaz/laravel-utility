<?php

namespace Kastanaz\LaravelUtility\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kastanaz\LaravelUtility\Contracts\PermissionModelContract;

class Permission extends Model implements PermissionModelContract
{
    use HasFactory, HasUuids;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];
}
