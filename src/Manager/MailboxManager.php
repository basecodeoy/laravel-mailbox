<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
