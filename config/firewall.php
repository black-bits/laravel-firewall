<?php

return [

    'enabled' => env('FIREWALL_ENABLED', false),

    'blacklist' => [

    ],

    'whitelist' => [

    ],

    'remote_url'   => env('FIREWALL_REMOTE_URL', 'https://api.laravel-firewall.io/api/check'),
    'remote_token' => env('FIREWALL_REMOTE_TOKEN', ''),

];
