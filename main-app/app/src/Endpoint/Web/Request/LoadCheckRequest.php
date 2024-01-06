<?php

declare(strict_types=1);

namespace App\Endpoint\Web\Request;

use Psr\Http\Message\UploadedFileInterface;
use Spiral\Filters\Model\FilterDefinitionInterface;
use Spiral\Filters\Model\FilterInterface;
use Spiral\Filters\Model\HasFilterDefinition;
use Spiral\Filters\Attribute\Input\File;
use Spiral\Filters\Attribute\Input\Post;
use Spiral\Validator\FilterDefinition;

class LoadCheckRequest implements FilterInterface, HasFilterDefinition
{
    #[Post(key: 'name')]
    public string $name;

    #[File]
    public UploadedFileInterface $check;

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition(
            validationRules: [
                'name' => [
                    ['notEmpty'],
                    ['string::shorter', 50]
                ],
                'check' => [['image::valid'], ['file::size', 8192]]
            ]
        );
    }
}
