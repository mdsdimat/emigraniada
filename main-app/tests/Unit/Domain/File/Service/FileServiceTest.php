<?php

declare(strict_types=1);

namespace tests\Unit\Domain\File\Service;

use App\Domain\File\Entity\File;
use App\Domain\File\Service\FileService;
use GuzzleHttp\Psr7\UploadedFile;
use Psr\Http\Message\StreamInterface;
use Spiral\Storage\BucketInterface;
use Spiral\Storage\Exception\FileOperationException;
use Spiral\Storage\StorageInterface;
use Tests\TestCase;

class FileServiceTest extends TestCase
{
    public function testUploadFile()
    {
        $storageMock = $this->createMock(StorageInterface::class);
        $service = new FileService($storageMock);

        $streamMock = $this->createMock(StreamInterface::class);
        $streamMock->method('getContents')->willReturn('file-content');

        $uploadedFile = $this->createMock(UploadedFile::class);
        $uploadedFile->method('getClientFilename')->willReturn('test.jpg');
        $uploadedFile->method('getStream')->willReturn($streamMock);

        $file = $service->uploadFile($uploadedFile);

        $this->assertInstanceOf(File::class, $file);
//        $this->assertEquals('test.jpg', $file->getFileName());
    }

    public function testUploadExistingFile()
    {
        $this->expectException(FileOperationException::class);

        $storageMock = $this->createMock(StorageInterface::class);

        $bucketMock = $this->createMock(BucketInterface::class);
        $storageMock->method('bucket')->willReturn($bucketMock);

        $service = new FileService($storageMock);

        $uploadedFile = $this->createMock(UploadedFile::class);
        $uploadedFile->method('getClientFilename')->willReturn('existing.jpg');

        $bucketMock->method('write')->willThrowException(new FileOperationException('File already exists'));

        $service->uploadFile($uploadedFile);
    }

    public function testRemoveAwsPrefix()
    {
        $result = FileService::removeAwsPrefix('aws://my-bucket/my-file.jpg');

        $this->assertEquals('my-bucket/my-file.jpg', $result);
    }
}
