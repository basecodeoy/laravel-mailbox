<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Mailbox\Data;

use Illuminate\Contracts\Support\Arrayable;

final readonly class Attachment implements Arrayable, \JsonSerializable
{
    public function __construct(
        private readonly ?string $type,
        private readonly ?string $name,
        private readonly ?string $content,
    ) {}

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'name' => $this->name,
            'content' => $this->content,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
