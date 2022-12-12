<?php

namespace Kastanaz\LaravelUtility\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Kastanaz\LaravelUtility\Concerns\HasPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory, HasUuids, HasPermission;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    public function setAttributeName($value)
    {
        return strtolower($value);
    }
}
