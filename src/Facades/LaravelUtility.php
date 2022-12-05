<?php

namespace Kastanaz\LaravelUtility\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Kastanaz\LaravelUtility\LaravelUtility
 */
class LaravelUtility extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Kastanaz\LaravelUtility\LaravelUtility::class;
    }
}
