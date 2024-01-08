<?php

declare(strict_types=1);

namespace App\Domain\Check\Service;

use App\Domain\File\Service\FileService;
use App\Endpoint\Temporal\Workflow\Scanner\FileScannerWorkflowInterface;
use App\Endpoint\Web\Request\LoadCheckRequest;
use App\Domain\Check\Entity\Check;
use Cycle\ORM\EntityManagerInterface;
use Temporal\Client\WorkflowClientInterface;
use App\Endpoint\Temporal\Workflow\Scanner\FileScannerWorkflow;
use Temporal\Client\WorkflowOptions;

class CheckService
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly FileService $fileService,
        private readonly WorkflowClientInterface $workflowClient,
    ) {
    }
    public function createByRequest(LoadCheckRequest $request): Check
    {
        $check = new Check();
        $check->file = $this->fileService->uploadFile($request->check);
        $this->em->persist($check)->run();

        $scanner = $this->workflowClient->newWorkflowStub(
            FileScannerWorkflowInterface::class,
            WorkflowOptions::new()->withTaskQueue('scanner')
        );

        $this->workflowClient->start(
            $scanner,
            FileService::removeAwsPrefix($check->file->filePath)
        );

        return $check;
    }
}
