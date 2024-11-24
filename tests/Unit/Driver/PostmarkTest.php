<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Driver;

use BaseCodeOy\Mailbox\Data\Mail;
use BaseCodeOy\Mailbox\Driver\Postmark;

it('should parse the payload', function (): void {
    $mail = createRequest(
        Postmark::class,
        fixtureJson('postmark'),
    )->toMail();

    expect($mail)->toBeInstanceOf(Mail::class);

    expect($mail)->toMatchSnapshot();
});
