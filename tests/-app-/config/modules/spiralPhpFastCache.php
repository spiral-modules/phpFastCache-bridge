<?php

return [
    'adapter'  => 'files',
    'adapters' => [
        'files'     => [
            'path' => directory('runtime') . 'phpfastcache/'
        ],
        'memcache'  => [
            'memcache' => [
                [
                    'host'   => 'localhost',
                    'port'   => 11211,
                    'weight' => 1
                ]
            ]
        ],
        'memcached' => [
            'memcache' => [
                [
                    'host'   => 'localhost',
                    'port'   => 11211,
                    'weight' => 1
                ]
            ]
        ],
        'mongodb'   => [
            'host'     => 'localhost',
            'port'     => '27017',
            'timeout'  => 3,
            'username' => '',
            'password' => '',
        ],
        'redis'     => [
            'host'     => 'localhost',
            'port'     => '6379',
            'timeout'  => '',
            'username' => '',
            'password' => '',
        ],
        'sqlite'    => [
            'path' => directory('runtime') . 'phpfastcache/'
        ]
    ]
];