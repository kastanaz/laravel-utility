<?php

namespace Kastanaz\LaravelUtility\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kastanaz\LaravelUtility\Contracts\PermissionModelContract;

class Permission extends Model implements PermissionModelContract
{
    use HasFactory;

    protected $guarded = [];
}
