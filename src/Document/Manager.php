<?php

namespace AvoRed\Framework\Document;

use AvoRed\Framework\Database\Contracts\DocumentModelInterface;
use AvoRed\Framework\Database\Models\Document;
use Illuminate\Http\UploadedFile;

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
     * @return Document
     */
    public function uploadPublicly(UploadedFile $file): Document
    {
        $data['mime_type'] = $file->getClientMimeType();
        $data['size'] = $file->getSize();
        $data['origional_name'] = $file->getClientOriginalName();
        $data['path'] = $this->upload($file, self::PUBLIC_UPLOAD_PATH);

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
