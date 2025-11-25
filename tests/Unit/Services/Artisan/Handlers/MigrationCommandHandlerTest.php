<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Modules\Xot\Services\Artisan\Handlers\MigrationCommandHandler;

use function Safe\ob_get_clean;
use function Safe\ob_start;

test('migration handler supports migrate command', function (): void {
    $handler = new MigrationCommandHandler;

    expect($handler->supports('migrate'))->toBeTrue();
});

test('migration handler does not support other commands', function (): void {
    $handler = new MigrationCommandHandler;

    expect($handler->supports('clear'))->toBeFalse();
});

test('migration handler executes migrate without module', function (): void {
    DB::shouldReceive('purge')->once()->with('mysql');
    DB::shouldReceive('reconnect')->once()->with('mysql');

    Artisan::shouldReceive('call')
        ->once()
        ->with('migrate --force', [])
        ->andReturn(0);

    Artisan::shouldReceive('output')
        ->once()
        ->andReturn('Migration completed');

    $handler = new MigrationCommandHandler;
    $result = $handler->handle('');

    expect($result)->toContain('Migration completed');
});

test('migration handler executes module migration', function (): void {
    DB::shouldReceive('purge')->once()->with('mysql');
    DB::shouldReceive('reconnect')->once()->with('mysql');

    Artisan::shouldReceive('call')
        ->once()
        ->with('module:migrate TestModule --force', [])
        ->andReturn(0);

    Artisan::shouldReceive('output')
        ->once()
        ->andReturn('Module migration completed');

    $handler = new MigrationCommandHandler;

    ob_start();
    $result = $handler->handle('TestModule');
    $output = ob_get_clean();

    expect($output)->toContain('Module TestModule');
    expect($result)->toContain('Module migration completed');
});
