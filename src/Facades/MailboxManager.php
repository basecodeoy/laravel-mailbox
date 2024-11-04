<?php

declare(strict_types=1);

namespace BaseCodeOy\Mailbox\Facades;

use BaseCodeOy\Mailbox\Driver\DriverInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @method static class-string<DriverInterface> connection(string|null $name = null)
 * @method static void                          disconnect(string|null $name = null)
 * @method static class-string<DriverInterface> reconnect(string|null $name = null)
 */
final class MailboxManager extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \BaseCodeOy\Mailbox\Manager\MailboxManager::class;
    }
}
