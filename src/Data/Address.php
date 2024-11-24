<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Mailbox\Data;

use Illuminate\Contracts\Support\Arrayable;

final readonly class Address implements Arrayable, \JsonSerializable
{
    public function __construct(
        private readonly ?string $name,
        private readonly ?string $mail,
    ) {}

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'mail' => $this->mail,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
