<?php

namespace AvoRed\Framework\Image;

use Illuminate\Support\Facades\File;
use AvoRed\Framework\Image\Driver\Gd;

class Manager
{
    /**
     * Image Driver Class
     * @var \AvoRed\Framework\Image\Driver\Gd
     */
    protected $driver;

    /**
     * DB Path for the Image or relative path
     *
     * @var string $dbPath
     */
    protected $dbPath;

    public function __construct()
    {
        $this->driver = new Gd();
    }

    /**
     * Upload Image and resize it.
     *
     * @var \Illuminate\Http\UploadedFile $image
     * @var string $path
     *
     * @return self $this
     */
    public function upload($image, $path)
    {
        $this->dbPath = $image->store($path, 'avored');

        return $this;
    }

    /**
     * Get the Local File Object for the uploaded image
     * @return \AvoRed\Framework\Image\LocalFile $localFile
     */
    public function get()
    {
        return new LocalFile($this->dbPath);
    }

    /**
     * Make Different Sizes of the image based on config
     * @return self $this
     */
    public function makeSizes()
    {
        $name = basename($this->dbPath);
        $path = str_replace('/' . $name, '', $this->dbPath);
        $sizes = config('avored-framework.image.sizes');

        foreach ($sizes as $sizeName => $widthHeight) {
            list($width, $height) = $widthHeight;
            $imagePath = storage_path('app/public/' . $path) . DIRECTORY_SEPARATOR . $sizeName . '-' . $name;

            $this->driver
                ->path($this->dbPath)
                ->make()
                ->resize($width, $height)
                ->saveImage($imagePath, 100);
        }

        return $this;
    }

    /**
     * Create Directories if not exists.
     *
     * @var string $path
     * @return self $this
     */
    public function directory($path)
    {
        if (!File::exists($path)) {
            File::makeDirectory($path, 0775, true, true);
        }
        return $this;
    }
}
