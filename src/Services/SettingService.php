<?php

namespace Kastanaz\LaravelUtility\Services;

use Kastanaz\LaravelUtility\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class SettingService
{
    /**
     * The cached settings data.
     *
     * @var \Illuminate\Database\Eloquent\Collection|null
     */
    protected $data;

    /**
     * The value of the setting being accessed.
     *
     * @var mixed|null
     */
    protected $value;

    /**
     * The cache key for the settings data.
     *
     * @var string
     */
    protected string $cacheKey = 'setting.cache.key';

    /**
     * Construct
     */
    public function __construct()
    {
        $this->data = $this->getData();
    }

    /**
     * Reset the cached settings data.
     *
     * @return void
     */
    public function reset(): void
    {
        Cache::forget($this->cacheKey);
        $this->data = $this->getData();
    }

    /**
     * Get the settings data from the cache or from the database if it's not in the cache.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getData()
    {
        return Cache::rememberForever($this->cacheKey, function() {
            return Setting::get()->keyBy('name');
        });
    }

    /**
     * Get the value of a specific setting or all settings.
     *
     * @param string $name The name of the setting to retrieve.
     * @param mixed $default The default value to return if the setting is not found.
     *
     * @return mixed
     */
    public function get(string $name = '', $default = null)
    {
        $firstPartName = explode('.', $name)[0];

        if ($firstPartName) {
            $this->value = $this->getSettingValue($firstPartName, $name);
        } else {
            $this->value = $this->data->pluck('value', 'name');
        }

        return $this->value ?? $default;
    }

    /**
     * Persist a setting with a given name and value.
     *
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function persist(string $name, $value)
    {
        $result = Setting::persist($name, $value);
        $this->reset();

        return $result->value;
    }

    /**
     * Bulk persist operation
     *
     * @param array $settings
     * @return bool
     */
    public function bulkPersist(array $settings): bool
    {
        foreach ($settings as $key => $value) {
            Setting::persist($key, $value);
        }
        $this->reset();
        return true;
    }

    /**
     * Delete setting by key name
     *
     * @param string $name
     * @return boolean
     */
    public function delete(string $name): bool
    {
        $result = Setting::destroy($name);
        $this->reset();

        return $result;
    }

    /**
     * Get the value of a specific setting
     *
     * @param string $key The name of the setting to retrieve
     *
     * @return mixed|null
     */
    protected function getSettingValue(string $key, string $name = '')
    {
        return isset($this->data[$key]) ? Arr::get($this->data->pluck('value', 'name')->toArray(), $name) : null;
    }
}
