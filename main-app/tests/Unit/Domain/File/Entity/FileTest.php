<?php

declare(strict_types=1);

namespace tests\Unit\Domain\File\Entity;

use App\Domain\File\Entity\File;
use Tests\TestCase;

class FileTest extends TestCase
{
    public function testConstructor()
    {
        $file = new File('path/to/file', 'file.jpg');

        $this->assertEquals('path/to/file', $file->getFilePath());
        $this->assertEquals('file.jpg', $file->getFileName());
    }

    public function testGetSetFilePath()
    {
        $file = new File('old/path/to/file', 'file.jpg');

        $file->setFilePath('new/path/to/file');

        $this->assertEquals('new/path/to/file', $file->getFilePath());
    }

    public function testGetSetFileName()
    {
        $file = new File('path/to/file', 'old_file.jpg');

        $file->setFileName('new_file.jpg');

        $this->assertEquals('new_file.jpg', $file->getFileName());
    }
}
