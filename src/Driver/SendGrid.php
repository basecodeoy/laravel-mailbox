<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Mailbox\Driver;

use BaseCodeOy\Mailbox\Data\Mail;
use BaseCodeOy\Mailbox\Data\MailParser;

/**
 * @see https://docs.sendgrid.com/for-developers/parsing-email/setting-up-the-inbound-parse-webhook
 */
final class SendGrid extends AbstractDriver
{
    public function rules(): array
    {
        return [
            'email' => 'required',
        ];
    }

    public function toMail(): Mail
    {
        return MailParser::fromString($this->json('email'))->parse();
    }
}
