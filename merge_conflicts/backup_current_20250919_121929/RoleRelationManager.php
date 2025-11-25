<?php

/**
 * @see https://github.com/Althinect/filament-spatie-roles-permissions/blob/2.x/src/resources/PermissionResource/RelationManager/RoleRelationManager.php
 */

declare(strict_types=1);

namespace Modules\User\Filament\Resources\PermissionResource\RelationManager;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
=======
>>>>>>> fbc8f8e (.)
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;

<<<<<<< HEAD
=======








>>>>>>> fbc8f8e (.)
class RoleRelationManager extends XotBaseRelationManager
{
    protected static string $relationship = 'roles';

<<<<<<< HEAD
    protected static null|string $recordTitleAttribute = 'name';

    /**
     * @return array<string, Component>
     */
    #[Override]
=======
    protected static ?string $recordTitleAttribute = 'name';

    /**
     * @return array<string, \Filament\Schemas\Components\Component>
     */
>>>>>>> fbc8f8e (.)
    public function getFormSchema(): array
    {
        return [
            'name' => TextInput::make('name'),
            'guard_name' => TextInput::make('guard_name'),
        ];
    }

<<<<<<< HEAD
    #[Override]
    public function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->searchable(),
            TextColumn::make('guard_name')->searchable(),
        ])->filters([]);
    }

    protected static function getModelLabel(): null|string
=======
    public function table(Table $table): Table
    {
        return $table
            ->columns(
                [
                    TextColumn::make('name')
                        ->searchable(),
                    TextColumn::make('guard_name')
                        ->searchable(),
                ]
            )
            ->filters(
                [
                ]
            );
    }

    protected static function getModelLabel(): ?string
>>>>>>> fbc8f8e (.)
    {
        // return __('filament-spatie-roles-permissions::filament-spatie.section.role');
        return __('filament-spatie-roles-permissions::filament-spatie.section.role');
    }

    protected static function getPluralModelLabel(): string
    {
        return __('filament-spatie-roles-permissions::filament-spatie.section.roles');
    }
}
