<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Driver;

use BaseCodeOy\Mailbox\Data\Mail;
use BaseCodeOy\Mailbox\Driver\Brevo;

it('should parse the payload', function (): void {
    $mail = createRequest(
        Brevo::class,
        fixtureJson('brevo'),
    )->toMail();

    expect($mail)->toBeInstanceOf(Mail::class);

    expect($mail)->toMatchSnapshot();
});
