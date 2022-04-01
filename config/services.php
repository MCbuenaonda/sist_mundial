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
    'firebase' => [
        'api_key' => 'AIzaSyCgyKjTlL3yFyrqAuyTM5oZBrAEZzGQnjY',
        'auth_domain' => 'myapp-7ca51.firebaseapp.com',
        'database_url' => 'https://myapp-7ca51.firebaseio.com',
        'project_id' => 'myapp-7ca51',
        'storage_bucket' => 'myapp-7ca51.appspot.com',
        'messaging_sender_id' => '747344295568',
        'app_id' => '1:747344295568:web:3c6f68e803c92c98654a15',
    ],

];
