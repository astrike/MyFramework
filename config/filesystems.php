<?php

return [
    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => ROOT . 'storage/app'
        ],

        'public' => [
            'driver' => 'local',
            'root' => ROOT . 'storage/app/public',
            'url' => '192.168.10.10/storage',
            'visibility' => 'public'
        ]
    ],
];
