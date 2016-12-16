<?php
return [
    'settings' => [

        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,

        'view' => [
            'template_path' => __DIR__ . '/../src/App/Resources/views',
            'twig' => [
                'cache' => __DIR__ . '/../cache',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],

        'mongo' => [
            'uri' => 'mongodb://localhost:27017',
            'database' => 'map'
        ],

        'routes' => [
            'dir' => __DIR__ . '/../src/App/Resources/routes',
            'files' => [
                'app'
            ]
        ],

    ],
];