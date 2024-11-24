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
use Carbon\Carbon;
use Illuminate\Validation\Validator;

/**
 * @see https://www.mailgun.com/products/send/inbound-routing/
 */
final class Mailgun extends AbstractDriver
{
    public function rules(): array
    {
        return [
            'body-mime' => 'required',
            'timestamp' => 'required',
            'token' => 'required',
            'signature' => 'required',
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $hasValidSignature = \hash_equals(
                    $this->signature,
                    \hash_hmac(
                        'sha256',
                        $this->json('timestamp').$this->json('token'),
                        config('mailbox.services.mailgun.key'),
                    ),
                );

                if (!$hasValidSignature) {
                    $validator->errors()->add('signature', 'Invalid signature.');
                }

                $hasValidTimestamp = Carbon::now()->subMinutes(2)->lte(Carbon::createFromTimestamp($this->json('timestamp')));

                if (!$hasValidTimestamp) {
                    $validator->errors()->add('timestamp', 'Invalid timestamp.');
                }
            },
        ];
    }

    public function toMail(): Mail
    {
        return MailParser::fromString($this->json('body-mime'))->parse();
    }
}
