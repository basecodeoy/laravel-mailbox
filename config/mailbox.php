<?php

declare(strict_types=1);

// use BaseCodeOy\Mailbox\Driver\AmazonSES;
// use BaseCodeOy\Mailbox\Driver\Brevo;
// use BaseCodeOy\Mailbox\Driver\MailCare;
// use BaseCodeOy\Mailbox\Driver\MailerSend;
// use BaseCodeOy\Mailbox\Driver\Mailgun;
// use BaseCodeOy\Mailbox\Driver\Mailjet;
// use BaseCodeOy\Mailbox\Driver\Mandrill;
use BaseCodeOy\Mailbox\Driver\Postmark;

// use BaseCodeOy\Mailbox\Driver\SendGrid;
// use BaseCodeOy\Mailbox\Driver\SparkPost;

return [
    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => env('MAILBOX_DEFAULT_CONNECTION', 'main'),

    /*
    |--------------------------------------------------------------------------
    | DigitalOcean Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. An example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [
        // 'main' => [
        //     'driver' => AmazonSES::class,
        // ],
        // 'main' => [
        //     'driver' => Brevo::class,
        // ],
        // 'main' => [
        //     'driver' => MailCare::class,
        // ],
        // 'main' => [
        //     'driver' => MailerSend::class,
        // ],
        // 'main' => [
        //     'driver' => Mailgun::class,
        // ],
        // 'main' => [
        //     'driver' => Mailjet::class,
        // ],
        // 'main' => [
        //     'driver' => Mandrill::class,
        // ],
        'main' => [
            'driver' => Postmark::class,
        ],
        // 'main' => [
        //     'driver' => SendGrid::class,
        // ],
        // 'main' => [
        //     'driver' => SparkPost::class,
        // ],
    ],
];
