<?php

declare(strict_types=1);

use Spiral\Storage\Storage;

return [
    'default' => 'aws',
    'servers' => [
        'awsServer' => [
            'adapter' => 's3',
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
        'tmp'     => [
            'adapter' => 'local',
            'directory' => env('TMP_FILE_DIRECTORY', '/tmp/'),
        ],
    ],
    'buckets' => [
        'aws' => [
            'server' => 'awsServer',
            'distribution' => 's3'
        ],
        'tmp' => [
            'server' => 'tmp',
        ],
    ],
];
