<?php

/**
 * This config file just use when ProviderSeeder call.
 * Don't use this in code.
 * Read from provider config column
 */
return [
    'name' => 'Notifier',

    'defaults' => [
        'MAIL' => 'smtp',
        'STORAGE' => 'database',
//        'SMS' => 'kavenegar',
//        'PUSH' => 'fcm',
    ],

    'providers' => [
        [
            'slug' => 'smtp',
            'type' => \Modules\Notifier\Enums\EnumProviderType::MAIL,
            'queue' => 'notification',
            'title' => 'SMTP',
            'drivers' => [
                'send' => \Modules\Notifier\Jobs\Drivers\Mail\Smtp\SmtpSendDriver::class,
            ],
            'config' => [
                'transport' => 'smtp',
                'from' => [
                    'name' => config('mail.from.name'),
                    'address' => config('mail.from.address'),
                ],
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
                'encryption' => 'tls',
                'username' => config('mail.mailers.smtp.username'),
                'password' => config('mail.mailers.smtp.password'),
            ],
        ],
        [
            'slug' => 'database',
            'type' => \Modules\Notifier\Enums\EnumProviderType::STORAGE,
            'queue' => 'notification',
            'title' => 'Database storage',
            'drivers' => [
                'save' => \Modules\Notifier\Jobs\Drivers\Storage\Database\DatabaseSaveDriver::class,
            ],
            'config' => [],
        ],

//        [
//            'slug' => 'kavenegar',
//            'type' => \Modules\Notifier\Enums\EnumProviderType::SMS,
//            'queue' => 'notification',
//            'title' => 'Kavenegar Sms Provider',
//            'drivers' => [
//                'send' => \Modules\Notifier\Jobs\Drivers\Sms\Kavenegar\KavenegarSendDriver::class,
//                'sendPattern' => \Modules\Notifier\Jobs\Drivers\Sms\Kavenegar\KavenegarSendPatternDriver::class,
//            ],
//            'config' => [
//                'sender' => '',
//                'api_key' => '',
//            ],
//        ],
//        [
//            'slug' => 'fcm',
//            'type' => \Modules\Notifier\Enums\EnumProviderType::PUSH,
//            'queue' => 'notification',
//            'title' => 'Firebase Cloud Messaging',
//            'drivers' => [
//                'send' => \Modules\Notifier\Jobs\Drivers\Push\Fcm\FcmSendDriver::class,
//                'sendMulticast' => \Modules\Notifier\Jobs\Drivers\Push\Fcm\FcmSendMulticastDriver::class,
//            ],
//            'config' => [
//                'auth' => [
//                    'type' => '',
//                    'project_id' => '',
//                    'private_key_id' => '',
//                    'private_key' => "",
//                    'client_email' => '',
//                    'client_id' => '',
//                    'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',
//                    'token_uri' => 'https://oauth2.googleapis.com/token',
//                    'auth_provider_x509_cert_url' => 'https://www.googleapis.com/oauth2/v1/certs',
//                    'client_x509_cert_url' => '',
//                    'universe_domain' => 'googleapis.com',
//                ],
//            ],
//        ],
    ],
];
