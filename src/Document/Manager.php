<?php

namespace AvoRed\Framework\Document;

use AvoRed\Framework\Database\Models\Document;
use AvoRed\Framework\Database\Repository\DocumentRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class Manager
{
    /**
     * Document Repository
     *
     * @var DocumentRepository
     */
    protected $documentRepository;

    /**
     * Public upload path constant
     * @var string PUBLIC_UPLOAD_PATH
     */
    public const PUBLIC_UPLOAD_PATH = 'upload';

    /**
     * Upload publicly file
     *
     * @param UploadedFile $file
     * @return array
     */
    public function uploadPublicly(UploadedFile $file): array
    {
        $data['id'] = Str::uuid()->toString();
        $data['mime_type'] = $file->getClientMimeType();
        $data['size'] = $file->getSize();
        $data['origional_name'] = $file->getClientOriginalName();
        $options = ['disk' => 'public'];
        $data['path'] = $this->upload($file, self::PUBLIC_UPLOAD_PATH, $options);

        return $data;
    }

    /**
     * Upload file to storage folder at given path
     *
     * @param UploadedFile $file
     * @param string $path
     * @param array $options
     * @return void
     */
    protected function upload(UploadedFile $file, $path, $options = [])
    {
        return $file->storePublicly($path, $options);
    }
}
