<?php

declare(strict_types=1);

namespace BaseCodeOy\Mailbox\Driver;

use BaseCodeOy\Mailbox\Data\Mail;
use BaseCodeOy\Mailbox\Data\MailParser;

final class MailCare extends AbstractDriver
{
    public function rules(): array
    {
        return [
            'email' => 'required',
            'content_type' => 'required|in:message/rfc2822',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'content_type' => $this->headers->get('Content-type'),
        ]);
    }

    public function toMail(): Mail
    {
        return MailParser::fromString($this->json('email'))->parse();
    }
}
