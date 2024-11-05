<?php

declare(strict_types=1);

namespace BaseCodeOy\Mailbox\Driver;

use BaseCodeOy\Mailbox\Data\Mail;
use BaseCodeOy\Mailbox\Data\MailParser;

/**
 * @see https://mailchimp.com/developer/transactional/guides/set-up-inbound-email-processing/
 * @see https://mailchimp.com/developer/transactional/docs/webhooks/
 */
final class Mandrill extends AbstractDriver
{
    public function rules(): array
    {
        return [
            '0.raw_msg' => ['required', 'string'],
        ];
    }

    public function toMail(): Mail
    {
        return MailParser::fromString($this->json('0.raw_msg'))->parse();
    }
}
