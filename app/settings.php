<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
            'template_cache' => __DIR__ . '/../framework/cache',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../framework/logs/app.log',
        ],

        // Connection Profile
        'connectionProfile' => [
            'profile_path' => __DIR__ . '/../data/profiles/',
        ],
    ],
];
