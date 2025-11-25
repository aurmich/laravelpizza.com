<?php

<<<<<<< HEAD
declare(strict_types=1);


=======
>>>>>>> 8b0b6ac (.)
// app/Filament/Components/TranslationEditor.php
namespace Modules\Lang\Filament\Forms\Components;

use Filament\Schemas\Components\Section;
<<<<<<< HEAD
use Filament\Forms\Components\Field;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Arr;
=======
use Illuminate\Support\Arr;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\TextInput;
>>>>>>> 8b0b6ac (.)

class TranslationEditor extends Field
{
    protected string $view = 'lang::filament.forms.components.translation-editor';

    protected function setUp(): void
    {
        parent::setUp();

        $this->afterStateHydrated(function (TranslationEditor $component, $state) {
            $component->state($state ?? []);
        });
    }

<<<<<<< HEAD
    public function getDefaultChildComponents(?string $key = null): array
    {
        $components = [];
        $state = $this->getState() ?? [];
        if (!is_iterable($state)) {
=======
    public function getChildComponents(): array
    {
        $components = [];
        $state = $this->getState() ?? [];
        if(!is_iterable($state)){
>>>>>>> 8b0b6ac (.)
            return $components;
        }

        foreach ($state as $key => $value) {
            if (is_array($value)) {
<<<<<<< HEAD
                $components[] = Section::make($key)->schema([
                    TranslationEditor::make($key)->label('')->state($value),
                ]);
            } else {
                $components[] = TextInput::make($key)->label(str_replace('_', ' ', $key))->default($value);
=======
                $components[] = Section::make($key)
                    ->schema([
                        TranslationEditor::make($key)
                            ->label('')
                            ->state($value)
                    ]);
            } else {
                $components[] = TextInput::make($key)
                    ->label(str_replace('_', ' ', $key))
                    ->default($value);
>>>>>>> 8b0b6ac (.)
            }
        }

        return $components;
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 8b0b6ac (.)
