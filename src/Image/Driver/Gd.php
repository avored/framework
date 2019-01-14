<?php

namespace AvoRed\Framework\Image\Driver;

use AvoRed\Framework\Image\ImageNotFoundException;

class Gd
{
    /**
     * origional image GD resource
     *
     * @var resource GD Resouce
     */
    protected $image;

    /**
     * resized image GD resource
     *
     * @var resource GD Resouce
     */
    protected $imageResized;

    /**
     * Height of the Image
     *
     * @var int $height
     */
    protected $height;

    /**
     * Width for the Image
     *
     * @var int $width
     */
    protected $width;
    /**
     * Path  for the Image
     *
     * @var string $path
     */
    protected $path;

    /**
     * Make the Image as GD Resource and return self
     * @return self $this
     */
    public function make()
    {
        $ext = strtolower(strrchr($this->path, '.'));
        $path = storage_path('app/public/') . $this->path;
        switch ($ext) {
            case '.jpg':
            case '.jpeg':
                $this->image = @imagecreatefromjpeg($path);
                break;
            case '.gif':
                $this->image = @imagecreatefromgif($path);
                break;
            case '.png':
                $this->image = @imagecreatefrompng($path);
                break;
            default:
                $this->image = false;
                break;
        }

        if (false === $this->image) {
            throw new ImageNotFoundException('Image extension not supported!');
        }
        $this->width = imagesx($this->image);
        $this->height = imagesy($this->image);

        return $this;
    }

    /**
     * GET/Set path for tha Image
     *
     * @param null|string $path
     * @return self|string $path|$this
     */
    public function path($path = null)
    {
        if (null === $path) {
            return $this->path;
        }
        $this->path = $path;

        return $this;
    }

    /**
     * Resize Image
     * @param int $newWidth
     * @param int $newHeight
     *
     * @return self $this
     */
    public function resize($newWidth, $newHeight, $crop = true)
    {
        list($width, $height) = $this->getDimensions($newWidth, $newHeight, $crop = true);
        $this->imageResized = imagecreatetruecolor($width, $height);

        imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $width, $height, $this->width, $this->height);

        if ($crop === true) {
            $this->crop($width, $height, $newWidth, $newHeight);
        }

        return $this;
    }

    /**
     * Save the Image
     * @param string $savePath
     * @param int $ImageQuality
     * @return self $this
     */
    public function saveImage($savePath, $imageQuality = '100')
    {
        $extension = strrchr($savePath, '.');
        $extension = strtolower($extension);

        switch ($extension) {
            case '.jpg':
            case '.jpeg':
                if (imagetypes() & IMG_JPG) {
                    imagejpeg($this->imageResized, $savePath, $imageQuality);
                }
                break;

            case '.gif':
                if (imagetypes() & IMG_GIF) {
                    imagegif($this->imageResized, $savePath);
                }
                break;

            case '.png':
                $scaleQuality = round(($imageQuality / 100) * 9);
                $invertScaleQuality = 9 - $scaleQuality;

                if (imagetypes() & IMG_PNG) {
                    imagepng($this->imageResized, $savePath, $invertScaleQuality);
                }
                break;

            default:
                break;
        }

        imagedestroy($this->imageResized);

        return $this;
    }

    /**
     * Get the Width & height of the Image
     * @param int $newWith
     * @param int $newHeight
     * @return array
     */
    protected function getDimensions($newWidth, $newHeight)
    {
        $usedRatio = $widthRatio = $this->width / $newWidth;
        $heightRatio = $this->height / $newHeight;

        if ($heightRatio < $widthRatio) {
            $usedRatio = $heightRatio;
        }

        $height = $this->height / $usedRatio;
        $width = $this->width / $usedRatio;

        return [$width, $height];
    }

    /**
     * Crop the Image
     *
     * @param int $with
     * @param int $height
     * @param int $newWidth
     * @param int $newHeight
     * @return self $this
     */
    protected function crop($with, $height, $newWidth, $newHeight)
    {
        $cropStartX = ($with / 2) - ($newWidth / 2);
        $cropStartY = ($height / 2) - ($newHeight / 2);
        $crop = $this->imageResized;
        $this->imageResized = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled(
            $this->imageResized,
            $crop,
            0,
            0,
            $cropStartX,
            $cropStartY,
            $newWidth,
            $newHeight,
            $newWidth,
            $newHeight
        );

        return $this;
    }
}
