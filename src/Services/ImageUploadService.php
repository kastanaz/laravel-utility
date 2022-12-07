<?php

namespace Kastanaz\LaravelUtility\Services;

use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    /**
     * The disk name where the images are stored
     *
     * @var string
     */
    protected string $disk;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->disk = config('utility.image_upload_disk');
    }

    /**
     * Return the disk name
     *
     * @return string
     */
    public function getDisk(): string
    {
        return $this->disk;
    }

    /**
     * Replace an existing image with a new one
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string|null $oldFilePath
     * @return string
     */
    public function replace(\Illuminate\Http\UploadedFile $file, ?string $oldFilePath = null): string
    {
        if ($oldFilePath) {
            Storage::disk($this->disk)->delete($oldFilePath);
        }
        return Storage::disk($this->disk)->putFile('', $file);
    }

    /**
     * Get image url
     *
     * @param string|null $url
     * @return void
     */
    public function url(?string $url = null)
    {
        return Storage::disk($this->disk)->url($url);
    }
}
