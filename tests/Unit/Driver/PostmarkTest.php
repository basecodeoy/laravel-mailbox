<?php

declare(strict_types=1);

namespace Tests\Unit\Driver;

use BaseCodeOy\Mailbox\Data\Mail;
use BaseCodeOy\Mailbox\Driver\Postmark;
use function Spatie\Snapshots\assertMatchesSnapshot;

it('should parse the payload', function (): void {
    $mail = createRequest(
        Postmark::class,
        fixtureJson('postmark'),
    )->toMail();

    expect($mail)->toBeInstanceOf(Mail::class);

    assertMatchesSnapshot($mail);
});
