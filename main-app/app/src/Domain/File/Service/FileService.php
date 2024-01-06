<?php

declare(strict_types=1);

namespace App\Domain\File\Service;

use App\Application\Enum\AwsDirectory;
use App\Application\Enum\Bucket;
use App\Application\Enum\HttpStatus;
use Psr\Http\Message\UploadedFileInterface;
use Spiral\Storage\StorageInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Domain\File\Entity\File;

class FileService
{
    public function __construct(
        private readonly StorageInterface $storage,
    ) {
    }

    public function uploadFile(
        UploadedFileInterface $uploadedFile,
        ?string $fileName = null,
        ?string $dirName = null
    ): File {
        $filePath = $this->buildStandardFilePath(
            $uploadedFile->getClientFilename(),
            $dirName ?? AwsDirectory::Files->value
        );

//        if ($this->fileRepository->findOne(['filePath' => $filePath])) {
//            throw new FileException('File already exists', HttpStatus::BadRequest->value);
//        }

        return $this->uploadFileToStorage($uploadedFile->getStream(), $filePath, $fileName);
    }

    public function uploadFileToStorage(
        mixed $content,
        string $filePath,
        ?string $fileName = null
    ): File {
        $storageFile = $this->storage->bucket(Bucket::Aws->value)
            ->write($filePath, $content);

        return new File($storageFile->getId(), $fileName ?? basename($filePath));
    }

    public function buildStandardFilePath(
        string $clientFileName,
        ?string $dirName = null
    ): string {
        return \sprintf(
            '%s/%s',
            $dirName ?? AwsDirectory::Files->value,
            $this->prepareFileNameForSave($clientFileName)
        );
    }

    public function prepareFileNameForSave(string $clientFileName): string
    {
        return \sprintf(
            '%s.%s',
            md5($clientFileName . mt_rand() . microtime(true)),
            pathinfo($clientFileName, PATHINFO_EXTENSION)
        );
    }

    public static function removeAwsPrefix(string $fileId): string
    {
        return str_replace('aws://', '', $fileId);
    }
}
