<?php

use Facades\Kastanaz\LaravelUtility\Services\SettingService;
use Facades\Kastanaz\LaravelUtility\Services\ImageUploadService;

/**
 * Get a setting value from the SettingService object.
 *
 * @param string|null $name The name of the setting to be retrieved. If no argument is provided, all settings will be returned.
 * @return mixed The setting value, or all settings if no argument is provided.
 */
function setting(string $name = '')
{
    return SettingService::get($name);
}

/**
 * Generate a URL for an image file.
 *
 * @param string $url The URL of the image file.
 * @return string|null The URL of the image file, or null if no argument is provided.
 */
function image_asset($url)
{
    return $url ? ImageUploadService::url($url) : null;
}

/**
 * Format a number as Indonesian rupiah currency.
 *
 * @param int $amount The number to be formatted.
 * @return string The formatted number as Indonesian rupiah currency.
 */
function format_rupiah($amount)
{
    return number_format($amount, 0, ',', '.');
}
