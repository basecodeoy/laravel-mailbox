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
use Illuminate\Support\Facades\Validator;

final class AmazonSES extends AbstractDriver
{
    public function validator()
    {
        return Validator::make(
            \json_decode($this->getContent(), true),
            ['Message' => 'required'],
        );
    }

    public function toMail(): Mail
    {
        return MailParser::fromString(
            \json_decode(\json_decode($this->getContent(), true)['Message'], true)['content'],
        )->parse();
    }
}
