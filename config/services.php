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

    'facebook' => [
        'client_id' => "405053704529478",
        'client_secret' => "f889db38780635959e1b61105fec95e6",
        'redirect' => 'http://localhost:8000/feceRes',
    ],

    'linkedin' => [
        'client_id' => "78alzj540njwd7",
        'client_secret' => "B85wWUOIAV0HFr6Y",
        'redirect' => 'http://localhost:8000/linkRes',
    ],
    'google' => [
        'client_id' => "10336446291-48tnv18k67v7upcaigiq7vq4gou5bnqf.apps.googleusercontent.com",
        'client_secret' => "wnXvB7cGh2Hd1vBzZNprIq24",
        'redirect' => 'http://localhost:8000/googleRes',
    ],

];
