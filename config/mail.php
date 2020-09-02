<?php

return [
    'driver' => env('MAIL_DRIVER', 'smtp'),
    'host' => env('MAIL_HOST', ''),
    'port' => env('MAIL_PORT', 25),
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', ''),
        'name' => env('MAIL_FROM_NAME', ''),
    ],
    'encryption' => env('MAIL_ENCRYPTION', ''),
    'username' => env('MAIL_USERNAME', ''),
    'password' => env('MAIL_PASSWORD', ''),

    'sendmail' => '/usr/sbin/sendmail -bs',

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],
];
