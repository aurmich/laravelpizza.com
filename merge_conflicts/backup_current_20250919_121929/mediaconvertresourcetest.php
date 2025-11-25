<?php

declare(strict_types=1);

use Tests\TestCase;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Modules\Media\Filament\Resources\MediaConvertResource;

uses(TestCase::class);

test('get form schema returns expected components', function (): void {
    $schema = MediaConvertResource::getFormSchema();

    expect($schema)->toBeArray();
    expect($schema)->not->toBeEmpty();

<<<<<<< HEAD
    $componentClasses = array_map(get_class(...), $schema);
=======
    $componentClasses = array_map(fn ($c) => get_class($c), $schema);
>>>>>>> 0a466ed (.)

    expect($componentClasses)->toContain(Radio::class);
    expect($componentClasses)->toContain(TextInput::class);
});
