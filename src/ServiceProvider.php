<?php

declare(strict_types=1);

namespace BaseCodeOy\Mailbox;

use BaseCodeOy\Mailbox\Http\Controller\WebhookController;
use BaseCodeOy\Mailbox\Manager\MailboxManager;
use BaseCodeOy\PackagePowerPack\Package\AbstractServiceProvider;
use Illuminate\Support\Facades\Route;

final class ServiceProvider extends AbstractServiceProvider
{
    public function packageRegistered(): void
    {
        $this->app->singleton(MailboxManager::class);

        Route::post('/mailbox/webhook/{connection}', WebhookController::class)->name('mailbox.webhook');
    }
}
