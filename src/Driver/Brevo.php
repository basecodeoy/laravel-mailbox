<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Mailbox\Driver;

use BaseCodeOy\Mailbox\Data\Address;
use BaseCodeOy\Mailbox\Data\Attachment;
use BaseCodeOy\Mailbox\Data\Header;
use BaseCodeOy\Mailbox\Data\Mail;
use Carbon\Carbon;
use EmailReplyParser\EmailReplyParser;
use Illuminate\Support\Arr;

/**
 * @see https://developers.brevo.com/docs/inbound-parse-webhooks
 */
final class Brevo extends AbstractDriver
{
    public function rules(): array
    {
        return [];
    }

    public function toMail(): Mail
    {
        return new Mail(
            headers: $this->mapHeaders($this->json('items.0.Headers')),
            id: $this->json('items.0.Uuid.0'),
            date: Carbon::make($this->json('items.0.SentAtDate')),
            text: $this->json('items.0.RawTextBody'),
            textVisible: EmailReplyParser::parseReply($this->json('items.0.RawTextBody')),
            html: $this->json('items.0.RawHtmlBody'),
            subject: $this->json('items.0.Subject'),
            from: new Address(
                name: $this->json('items.0.From.Name'),
                mail: $this->json('items.0.From.Address'),
            ),
            to: $this->mapAddresses($this->json('items.0.To')),
            cc: $this->mapAddresses($this->json('items.0.Cc', [])),
            bcc: $this->mapAddresses($this->json('items.0.Bcc', [])),
            attachments: $this->mapAttachments($this->json('items.0.Attachments')),
        );
    }

    /**
     * @return array<Header>
     */
    private function mapHeaders(array $items): array
    {
        $headers = [];

        foreach ($items as $key => $value) {
            $headers[] = new Header($key, $value);
        }

        return $headers;
    }

    /**
     * @return array<Address>
     */
    private function mapAddresses(array $items): array
    {
        $addresses = [];

        foreach ($items as $item) {
            $addresses[] = new Address(
                name: Arr::get($item, 'Name') ?: null,
                mail: Arr::get($item, 'Address') ?: null,
            );
        }

        return $addresses;
    }

    /**
     * @return array<Attachment>
     */
    private function mapAttachments(array $items): array
    {
        $files = [];

        foreach ($items as $item) {
            $files[] = new Attachment(
                type: $item['ContentType'],
                name: $item['Name'],
                content: $item['ContentID'],
            );
        }

        return $files;
    }
}
