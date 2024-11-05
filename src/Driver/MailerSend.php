<?php

declare(strict_types=1);

namespace BaseCodeOy\Mailbox\Driver;

use BaseCodeOy\Mailbox\Data\Mail;

/**
 * @see https://www.mailersend.com/features/inbound-emails
 * @see https://www.mailersend.com/help/inbound-route
 */
final class MailerSend extends AbstractDriver
{
    public function rules(): array
    {
        return [];
    }

    public function toMail(): Mail
    {
        return Mail::fromString($this->json(''));
    }
}
