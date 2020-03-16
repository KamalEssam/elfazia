<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => "sandbox05c1f854859c48b18d687a3e3f56b358.mailgun.org",
        'secret' => "key-00acf2518447f7cd8c0e5b81bb278407",
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id' => '599573622830-sf0eo75okp3dfcaugmun46dbif9d8pe7.apps.googleusercontent.com',
        'client_secret' => 'kUginF3TSukj8XreAx53VObG',
        'redirect' => 'http://localhost/adrd/login/google/callback',
    ],
    'facebook' => [
        'client_id' => '156621244933050',
        'client_secret' => '7cb1fe4037a9bb1a9a36f04392c74c8e',
        'redirect' => 'http://localhost/adrd/login/facebook/callback',
    ],

    'twitter' => [
        'client_id' => 'QnWybuZq9d90aJIYFGxcNm8wr',
        'client_secret' => '5r5EsIclBsrhmgODjpFVuxQ5WalRNom62tUmI6niSXdCNWCSsA',
        'redirect' => 'http://localhost/adrd/login/twitter/callback',
    ],
];
