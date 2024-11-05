<?php

declare(strict_types=1);

namespace BaseCodeOy\Mailbox\Event;

use BaseCodeOy\Mailbox\Data\Mail;
use Illuminate\Foundation\Events\Dispatchable;

final class MailReceived
{
    use Dispatchable;

    public function __construct(public readonly Mail $mail) {}
}
