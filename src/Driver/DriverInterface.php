<?php

declare(strict_types=1);

namespace BaseCodeOy\Mailbox\Driver;

use BaseCodeOy\Mailbox\Data\Mail;

interface DriverInterface
{
    public function toMail(): Mail;
}
