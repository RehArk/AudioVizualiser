<?php

namespace App\Service;

use Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    private $targetDirectory;
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->targetDirectory = '';
        $this->slugger = $slugger;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }

    public function setTargetDirectory(string $targetDirectory) {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(UploadedFile $file, $fileName = null)
    {
        if($fileName == null) {
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $originalFilename.'-'.uniqid();
        }

        $safeFilename = $this->slugger->slug($fileName).'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $safeFilename);
        } catch (FileException $e) {
            throw new Exception('error on file uplaoding : invalid directory');
        }

        return $fileName;
    }

    public function removeUpload(string $path, string $file)
    {
        if(file_exists($path.'/'.$file)) {
            unlink($path.'/'.$file);
        }
    }

}