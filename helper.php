<?php

use Facades\Kastanaz\LaravelUtility\Services\SettingService;
use Facades\Kastanaz\LaravelUtility\Services\ImageUploadService;

/**
 * Get setting
 *
 * @param string|null $name
 * @return void
 */
function setting(string $name = '')
{
    return SettingService::get($name);
}

function image_asset($url)
{
    return $url ? ImageUploadService::url($url) : null;
}

function format_rupiah($amount)
{
    return number_format($amount, 0, ',', '.');
}
