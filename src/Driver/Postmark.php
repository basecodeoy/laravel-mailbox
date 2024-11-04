<?php

declare(strict_types=1);

namespace BaseCodeOy\Mailbox\Driver;

use BaseCodeOy\Mailbox\Data\Address;
use BaseCodeOy\Mailbox\Data\Attachment;
use BaseCodeOy\Mailbox\Data\Header;
use BaseCodeOy\Mailbox\Data\Mail;
use BaseCodeOy\Mailbox\Data\MailParser;
use Carbon\Carbon;
use EmailReplyParser\EmailReplyParser;
use Illuminate\Support\Arr;

/**
 * @see https://postmarkapp.com/developer/webhooks/inbound-webhook
 */
final class Postmark extends AbstractDriver
{
    public function rules(): array
    {
        return [
            'RawEmail' => 'required',
        ];
    }

    public function toMail(): Mail
    {
        if ($this->json('RawEmail')) {
            return MailParser::fromString($this->json('RawEmail'))->parse();
        }

        return new Mail(
            headers: $this->mapHeaders($this->json('Headers')),
            id: $this->json('MessageID'),
            date: Carbon::make($this->json('Date')),
            text: $this->json('TextBody'),
            textVisible: EmailReplyParser::parseReply($this->json('TextBody')),
            html: $this->json('HtmlBody'),
            subject: $this->json('Subject'),
            from: new Address(
                name: $this->json('FromFull.Name'),
                mail: $this->json('FromFull.Email'),
            ),
            to: $this->mapAddresses($this->json('ToFull')),
            cc: $this->mapAddresses($this->json('CcFull')),
            bcc: $this->mapAddresses($this->json('BccFull')),
            attachments: $this->mapAttachments($this->json('Attachments')),
        );
    }

    /**
     * @return Header[]
     */
    private function mapHeaders(array $items): array
    {
        $headers = [];

        foreach ($items as $item) {
            $headers[] = new Header($item['Name'], $item['Value']);
        }

        return $headers;
    }

    /**
     * @return Address[]
     */
    private function mapAddresses(array $items): array
    {
        $addresses = [];

        foreach ($items as $item) {
            $addresses[] = new Address(
                name: Arr::get($item, 'Name') ?: null,
                mail: Arr::get($item, 'Email') ?: null,
            );
        }

        return $addresses;
    }

    /**
     * @return Attachment[]
     */
    private function mapAttachments(array $attachments): array
    {
        $files = [];

        foreach ($attachments as $attachment) {
            $files[] = new Attachment(
                type: $attachment['ContentType'],
                name: $attachment['Name'],
                content: $attachment['Content'],
            );
        }

        return $files;
    }
}
