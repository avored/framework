<?php

namespace AvoRed\Framework\Image;

use Illuminate\Support\Facades\File;

class LocalFile
{
    /**
     * Relative path for the image.
     *
     * @var string
     */
    public $relativePath;

    /**
     * DB path for the image.
     *
     * @var string $dbPath
     */
    public $dbPath;

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
    public function __construct($dbPath = null)
    {
        $this->dbPath = $dbPath;
        $this->relativePath = str_replace('storage/', '', $dbPath);
        $this->url = asset('storage/' . $dbPath);

        $sizes = config('avored-framework.image.sizes');

        foreach ($sizes as $sizeName => $widthHeight) {
            $objectVarName = $sizeName . 'Url';

            $baseName = basename($dbPath);
            $sizeNamePath = str_replace($baseName, $sizeName . '-' . $baseName, $dbPath);

            $this->$objectVarName = asset('storage/' . $sizeNamePath);
            $objectOriginal = $sizeName . 'Original';
            $this->$objectOriginal = 'storage/' . $sizeNamePath;
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
        $sizes = config('avored-framework.image.sizes');

        foreach ($sizes as $sizeName => $widthHeight) {
            $baseName = basename($this->dbPath);
            $sizeNamePath = str_replace($baseName, $sizeName . '-' . $baseName, $this->dbPath);

            $path = public_path($sizeNamePath);
            File::delete($path);
        }

        $path = public_path($this->dbPath);
        File::delete($path);

        return $this;
    }

    public function name()
    {
        return basename($this->dbPath);
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

    /**
     * return Relative path for the image.
     *
     * @return string $relativePath
     */
    public function dbPath($path = null)
    {
        if (null === $path) {
            return $this->dbPath;
        }
        $this->dbPath = $path;

        return $this;
    }
}
