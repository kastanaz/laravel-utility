<?php

namespace Kastanaz\LaravelUtility\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'name';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'array'
    ];

    /**
     * Persist Setting
     *
     * @param string $name
     * @param mixed $value
     * @return self
     */
    public static function persist(string $name, $value): self
    {
        $firstPartName = explode('.', $name)[0];
        $settingKey = str_replace($firstPartName . '.', '', $name);

        $setting = self::firstOrNew(['name' => $firstPartName]);
        $dataValue = $setting->value;
        $setting->value = is_array($dataValue) ? Arr::set($dataValue, $settingKey, $value) : $value;
        $setting->save();

        return $setting;
    }
}
