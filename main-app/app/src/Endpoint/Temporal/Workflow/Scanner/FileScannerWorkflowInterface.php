<?php

namespace App\Endpoint\Temporal\Workflow\Scanner;

use Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[WorkflowInterface]
interface FileScannerWorkflowInterface
{
    #[WorkflowMethod]
    public function handle(string $fileName);
}
