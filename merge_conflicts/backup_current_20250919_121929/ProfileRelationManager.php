<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\UserResource\RelationManagers;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
=======
>>>>>>> fbc8f8e (.)
use Filament\Actions\CreateAction;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;

<<<<<<< HEAD
=======








>>>>>>> fbc8f8e (.)
class ProfileRelationManager extends XotBaseRelationManager
{
    protected static string $relationship = 'profile';

<<<<<<< HEAD
    protected static null|string $recordTitleAttribute = 'first_name';

    /**
     * @return array<string, Component>
     */
    #[Override]
=======
    protected static ?string $recordTitleAttribute = 'first_name';

    /**
     * @return array<string, \Filament\Schemas\Components\Component>
     */
>>>>>>> fbc8f8e (.)
    public function getFormSchema(): array
    {
        return [
            'ente' => TextInput::make('ente'),
            'matr' => TextInput::make('matr'),
<<<<<<< HEAD
            'first_name' => TextInput::make('first_name')->required()->maxLength(255),
=======
            'first_name' => TextInput::make('first_name')
                ->required()
                ->maxLength(255),
>>>>>>> fbc8f8e (.)
            'last_name' => TextInput::make('last_name'),
        ];
    }

<<<<<<< HEAD
    #[Override]
    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('ente'),
                TextColumn::make('matr'),
                TextColumn::make('first_name'),
                TextColumn::make('last_name'),
            ])
            ->filters([])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
=======
    public function table(Table $table): Table
    {
        return $table
            ->columns(
                [
                    TextColumn::make('id'),
                    TextColumn::make('ente'),
                    TextColumn::make('matr'),
                    TextColumn::make('first_name'),
                    TextColumn::make('last_name'),
                ]
            )
            ->filters(
                [
                ]
            )
            ->headerActions(
                [
                    CreateAction::make(),
                ]
            )
            ->recordActions(
                [
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]
            )
            ->toolbarActions(
                [
                    DeleteBulkAction::make(),
                ]
            );
>>>>>>> fbc8f8e (.)
    }
}
