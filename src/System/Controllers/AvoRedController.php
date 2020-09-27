<?php

namespace AvoRed\Framework\System\Controllers;

class AvoRedController
{
    public function avoredJs()
    {
      
        $file = __DIR__ . '/../../../dist/js/avored.js';

        $expires = strtotime('+1 year');
        $lastModified = filemtime($file);
        $cacheControl = 'public, max-age=31536000';

        return response()->file($file, [
            'Content-Type' => 'application/javascript; charset=utf-8',
            'Expires' => $this->httpDate($expires),
            'Cache-Control' => $cacheControl,
            'Last-Modified' => $this->httpDate($lastModified),
        ]);
    }
    public function appJs()
    {
      
        $file = __DIR__ . '/../../../dist/js/app.js';

        $expires = strtotime('+1 year');
        $lastModified = filemtime($file);
        $cacheControl = 'public, max-age=31536000';

        return response()->file($file, [
            'Content-Type' => 'application/javascript; charset=utf-8',
            'Expires' => $this->httpDate($expires),
            'Cache-Control' => $cacheControl,
            'Last-Modified' => $this->httpDate($lastModified),
        ]);
    }
    public function appStyles()
    {
      
        $file = __DIR__ . '/../../../dist/css/app.css';

        $expires = strtotime('+1 year');
        $lastModified = filemtime($file);
        $cacheControl = 'public, max-age=31536000';

        return response()->file($file, [
            'Content-Type' => 'text/css; charset=utf-8',
            'Expires' => $this->httpDate($expires),
            'Cache-Control' => $cacheControl,
            'Last-Modified' => $this->httpDate($lastModified),
        ]);
    }

    protected function httpDate($timestamp)
    {
        return sprintf('%s GMT', gmdate('D, d M Y H:i:s', $timestamp));
    }
}
