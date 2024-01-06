<?php

namespace App\Endpoint\Temporal\Activity\Scanner;

use Spiral\TemporalBridge\Attribute\AssignWorker;
use Temporal\Activity\ActivityInterface;
use Temporal\Activity\ActivityMethod;

#[ActivityInterface(prefix:"scanner.")]
#[AssignWorker(name: 'scanner')]
interface FileScannerInterface
{
    #[ActivityMethod]
    public function FileToText(string $filePath): void; // phpcs:ignore
}
