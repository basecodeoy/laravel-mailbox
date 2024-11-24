<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Mailbox\Http\Controller;

use BaseCodeOy\Mailbox\Driver\DriverInterface;
use BaseCodeOy\Mailbox\Event\MailReceived;
use BaseCodeOy\Mailbox\Facades\MailboxManager;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;

final class WebhookController extends Controller
{
    public function __invoke(string $connection)
    {
        /** @var DriverInterface $connection */
        $connection = App::make(MailboxManager::connection($connection));

        MailReceived::dispatch($connection->toMail());

        return Response::noContent();
    }
}
