<?php

declare(strict_types=1);

return [
    'default' => 's3',
    'resolvers' => [
        's3' => [
            'type' => 's3',
            'version' => 'latest',
            'region' => env('AWS_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'key' => env('AWS_KEY'),
            'secret' => env('AWS_SECRET'),
            'endpoint' => env('AWS_PUBLIC_URL'),
            'prefix' => env('AWS_PREFIX', null),
            'options' => [
                'use_path_style_endpoint' => true,
            ],
        ],
    ],
];
