<?php

namespace AvoRed\Framework\Document;

use AvoRed\Framework\Database\Contracts\DocumentModelInterface;
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
    const PUBLIC_UPLOAD_PATH = 'public/upload';

    /** Private upload path constant (ideally we should use this path for private path where file can be downloaded via url)
     * @var string UPLOAD_PATH
     */
    const UPLOAD_PATH = 'upload';

    /**
     * Document manager construct
     * @param DocumentRepository $documentRepository
     */
    public function __construct(
        DocumentModelInterface $documentRepository
    ) {
        $this->documentRepository = $documentRepository;
    }

    /**
     * Upload publicly file
     *
     * @param UploadedFile $file
     * @param mixed $document
     * @return Document
     */
    public function uploadPublicly(UploadedFile $file, $document): Document
    {
        $data['id'] = Str::uuid();
        $data['mime_type'] = $file->getClientMimeType();
        $data['size'] = $file->getSize();
        $data['origional_name'] = $file->getClientOriginalName();
        $data['path'] = $this->upload($file, self::PUBLIC_UPLOAD_PATH);
        if ($document) {
            $document->update($data);
            return $document;
        }
        return $this->documentRepository->create($data);
    }

    /**
     * Upload file to storage folder at given path
     *
     * @param UploadedFile $file
     * @param string $path
     * @return void
     */
    protected function upload(UploadedFile $file, $path)
    {
        return $file->storePublicly($path);
    }
}
