<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Mailbox\Event;

use BaseCodeOy\Mailbox\Data\Mail;
use Illuminate\Foundation\Events\Dispatchable;

final class MailReceived
{
    use Dispatchable;

    public function __construct(
        public readonly Mail $mail,
    ) {}
}
