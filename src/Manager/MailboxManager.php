<?php

declare(strict_types=1);

namespace BaseCodeOy\Mailbox\Manager;

use BaseCodeOy\Mailbox\Driver\DriverInterface;
use BaseCodeOy\Manager\AbstractManager;

final class MailboxManager extends AbstractManager
{
    protected function createConnection(array $config): DriverInterface
    {
        return new $config['driver']();
    }

    protected function getConfigName(): string
    {
        return 'mailbox';
    }
}
