<?php

declare(strict_types=1);

use BaseCodeOy\Mailbox\Driver\DriverInterface;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(
    Tests\TestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
)->in('Feature');

uses(
    Tests\TestCase::class,
)->in('Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function createRequest(string $formRequest, array $data): DriverInterface
{
    return new $formRequest(
        [],
        [],
        [],
        [],
        [],
        ['CONTENT_TYPE' => 'application/json'],
        \json_encode($data),
    );
}

function fixtureText(string $name): string
{
    return \file_get_contents(__DIR__."/Fixtures/Driver/{$name}.txt");
}

function fixtureJson(string $name): array
{
    return \json_decode(\file_get_contents(__DIR__."/Fixtures/Driver/{$name}.json"), true);
}
