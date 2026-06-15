<?php
// config/logging.php — add this 'activity' channel to your channels array
// Laravel already ships with Monolog under the hood.
// This is a ready-to-use daily log channel for the activity.
//
// In your .env set: LOG_CHANNEL=activity
// Then in controllers use: Log::info('...') / Log::error('...')

return [
    'default' => env('LOG_CHANNEL', 'activity'),

    'channels' => [

        'activity' => [
            'driver'    => 'daily',
            'path'      => storage_path('logs/activity.log'),
            'level'     => 'debug',
            'days'      => 14,
            'formatter' => Monolog\Formatter\LineFormatter::class,
            'formatter_with' => [
                'format'                => "[%datetime%] %channel%.%level_name%: %message% %context%\n",
                'allowInlineLineBreaks' => true,
            ],
        ],

        'stack' => [
            'driver'   => 'stack',
            'channels' => ['activity'],
            'ignore_exceptions' => false,
        ],

    ],
];
