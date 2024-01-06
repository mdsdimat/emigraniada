<?php

declare(strict_types=1);

namespace App\Endpoint\Temporal\Workflow\Scanner;

use Spiral\TemporalBridge\Attribute\AssignWorker;
use Temporal\Activity\ActivityOptions;
use Temporal\Workflow\WorkflowMethod;
use App\Endpoint\Temporal\Activity\Scanner\FileScannerInterface;
use Temporal\Workflow;

#[AssignWorker('scanner')]
class FileScannerWorkflow implements FileScannerWorkflowInterface
{
    private FileScannerInterface $activity;

    public function __construct()
    {
        $this->activity = Workflow::newActivityStub(
            FileScannerInterface::class,
            ActivityOptions::new()->withStartToCloseTimeout(60)
        );
    }

    #[WorkflowMethod]
    public function handle(string $fileName)
    {
        $text = yield $this->activity->FileToText($fileName);

        \dumprr($text);
    }
}
