<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Mailbox\Driver;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;

abstract class AbstractDriver extends FormRequest implements DriverInterface
{
    public function authorize(): bool
    {
        $configuration = Config::get('mailbox.connections.'.$this->route('connection'));

        if (\array_key_exists('basic_auth', $configuration)) {
            return $this->authorizeWithBasicAuth($configuration['basic_auth']);
        }

        return true;
    }

    public function authorizeWithBasicAuth(array $credentials): bool
    {
        $hasValidUsername = $this->getUser() === $credentials['username'];
        $hasValidPassword = $this->getPassword() === $credentials['password'];

        return $hasValidUsername && $hasValidPassword;
    }
}
