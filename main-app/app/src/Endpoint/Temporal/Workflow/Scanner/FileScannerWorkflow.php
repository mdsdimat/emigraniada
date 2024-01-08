<?php

declare(strict_types=1);

namespace App\Endpoint\Temporal\Workflow\Scanner;

use App\Endpoint\Temporal\Activity\Prompt\PromptExecute;
use App\Endpoint\Temporal\Activity\Prompt\PromptExecuteActivityInterface;
use Spiral\TemporalBridge\Attribute\AssignWorker;
use Temporal\Activity\ActivityOptions;
use Temporal\Internal\Workflow\ActivityProxy;
use Temporal\Workflow\WorkflowMethod;
use App\Endpoint\Temporal\Activity\Scanner\FileScannerInterface;
use Temporal\Workflow;

#[AssignWorker(name: 'scanner')]
class FileScannerWorkflow implements FileScannerWorkflowInterface
{
    private ActivityProxy|FileScannerInterface $scannerActivity;
    private ActivityProxy|PromptExecute $promptActivity;

    public function __construct()
    {
        $this->scannerActivity = Workflow::newActivityStub(
            FileScannerInterface::class,
            ActivityOptions::new()->withStartToCloseTimeout(60)
        );
        $this->promptActivity = Workflow::newActivityStub(
            PromptExecuteActivityInterface::class,
            ActivityOptions::new()->withStartToCloseTimeout(60)
        );
    }

    #[WorkflowMethod]
    public function handle(string $fileName)
    {
        $text = yield $this->scannerActivity->FileToText($fileName);

        $scan = yield $this->promptActivity->execute(
            \sprintf('%s this is check`s scan, leave only products and costs', $text)
        );

        \dumprr($scan);
    }
}
