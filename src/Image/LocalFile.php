<?php

namespace AvoRed\Framework\Image;

use Illuminate\Support\Facades\File;

class LocalFile
{
    /**
     * relative path for the image.
     *
     * @var null
     */
    public $relativePath = null;

    /**
     * url for the image.
     *
     * @var null
     */
    public $url = null;

    /**
     * Pass Relative path for the file.
     *
     * @param null|string $relativePath
     */
    public function __construct($relativePath = null)
    {
        $this->relativePath = $relativePath;
        $this->url = asset($relativePath);

        $sizes = config('image.sizes');

        foreach ($sizes as $sizeName => $widthHeight) {
            $objectVarName = $sizeName.'Url';

            $baseName = basename($relativePath);
            $sizeNamePath = str_replace($baseName, $sizeName.'-'.$baseName, $relativePath);

            $this->$objectVarName = asset($sizeNamePath);
        }
    }

    /**
     * return Relative path for the image.
     *
     * @var void
     * @return \AvoRed\Framework\Image\LocalFile
     */
    public function destroy()
    {
        $sizes = config('image.sizes');

        foreach ($sizes as $sizeName => $widthHeight) {
            $baseName = basename($this->relativePath);
            $sizeNamePath = str_replace($baseName, $sizeName.'-'.$baseName, $this->relativePath);

            $path = public_path($sizeNamePath);
            File::delete($path);
        }

        $path = public_path($this->relativePath);
        File::delete($path);

        return $this;
    }

    public function name()
    {
        return basename($this->relativePath);
    }

    /**
     * return Relative path for the image.
     *
     * @return string $relativePath
     */
    public function relativePath($path = null)
    {
        if (null === $path) {
            return str_replace(asset('/'), '', $this->relativePath);
        }

        $this->relativePath = $path;

        return $this;
    }
}
