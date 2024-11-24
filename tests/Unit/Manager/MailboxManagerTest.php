<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Driver;

use BaseCodeOy\Mailbox\Facades\MailboxManager;
use Illuminate\Foundation\Http\FormRequest;

it('should create a connection by default (main)', function (): void {
    $connection = MailboxManager::connection();

    expect($connection)->toBeInstanceOf(FormRequest::class);
});

it('should create a connection by name', function (): void {
    $connection = MailboxManager::connection('main');

    expect($connection)->toBeInstanceOf(FormRequest::class);
});
