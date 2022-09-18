<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'discord' => [    
        'client_id' => env('DISCORD_CLIENT_ID'),  
        'client_secret' => env('DISCORD_CLIENT_SECRET'),  
        'redirect' => env('DISCORD_REDIRECT_URI'),
        // optional
        'allow_gif_avatars' => (bool)env('DISCORD_AVATAR_GIF', false),
        'avatar_default_extension' => env('DISCORD_EXTENSION_DEFAULT', 'jpg'), // only pick from jpg, png, webp

        'token' => env('DISCORD_TOKEN'),
        'server_id' => env('DISCORD_SERVER_ID'),
        'arma_recruit_role' => env('DISCORD_ARMA_RECRUIT_ROLE'),
        'arma_member_role' => env('DISCORD_ARMA_MEMBER_ROLE'),
        'tester_role' => env('DISCORD_TESTER_ROLE'),
        'staff_role' => env('DISCORD_STAFF_ROLE'),

        'archub_webhook' => env('DISCORD_ARCHUB_WEBHOOK'),
        'staff_webhook' => env('DISCORD_STAFF_WEBHOOK'),
      ],      
];
