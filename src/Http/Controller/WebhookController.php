<?php

declare(strict_types=1);

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
