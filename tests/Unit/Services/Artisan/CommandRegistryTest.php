<?php

declare(strict_types=1);

use Modules\Xot\Services\Artisan\CommandRegistry;
use Modules\Xot\Services\Artisan\Contracts\CommandHandlerInterface;
use Modules\Xot\Services\Artisan\Handlers\CacheCommandHandler;
use Modules\Xot\Services\Artisan\Handlers\MigrationCommandHandler;

test('command registry can register handlers', function (): void {
    $registry = new CommandRegistry;
    $handler = new MigrationCommandHandler;

    $registry->register($handler);

    expect($registry->findHandler('migrate'))->toBeInstanceOf(CommandHandlerInterface::class);
});

test('command registry returns null for unknown commands', function (): void {
    $registry = new CommandRegistry;

    expect($registry->findHandler('unknown-command'))->toBeNull();
});

test('command registry finds correct handler for migrate command', function (): void {
    $registry = new CommandRegistry;

    $handler = $registry->findHandler('migrate');

    expect($handler)->toBeInstanceOf(MigrationCommandHandler::class);
});

test('command registry finds correct handler for cache commands', function (): void {
    $registry = new CommandRegistry;

    $handler = $registry->findHandler('clear');

    expect($handler)->toBeInstanceOf(CacheCommandHandler::class);
});

/* @phpstan-ignore-next-line method.notFound */
test('command registry supports multiple cache commands', function (string $command): void {
    $registry = new CommandRegistry;

    $handler = $registry->findHandler($command);

    expect($handler)->toBeInstanceOf(CacheCommandHandler::class);
})->with([
    ['clear'],
    ['clearcache'],
    ['configcache'],
]);
