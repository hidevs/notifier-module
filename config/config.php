<?php

/**
 * This config file just use when ProviderSeeder call.
 * Don't use this in code.
 * Read from provider config column
 */
return [
    'name' => 'Notifier',

    'defaults' => [
        'MAIL' => '',
        'SMS' => '',
        'STORAGE' => '',
        'PUSH' => '',
    ],

    'providers' => [],
];
