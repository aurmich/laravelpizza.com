<?php

/**
 * --.
 */
declare(strict_types=1);

namespace Modules\User\Filament\Resources\TenantResource\RelationManagers;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
=======
>>>>>>> fbc8f8e (.)
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;

<<<<<<< HEAD
=======








>>>>>>> fbc8f8e (.)
class DomainsRelationManager extends XotBaseRelationManager
{
    protected static string $relationship = 'domains';

    /**
<<<<<<< HEAD
     * @return array<string, Component>
     */
    #[Override]
=======
     * @return array<string, \Filament\Schemas\Components\Component>
     */
>>>>>>> fbc8f8e (.)
    public function getFormSchema(): array
    {
        return [
            'domain' => TextInput::make('domain')
                ->required()
                ->prefix('http(s)://')
<<<<<<< HEAD
                ->suffix('.' . request()->getHost())
=======
                ->suffix('.'.request()->getHost())
>>>>>>> fbc8f8e (.)
                ->maxLength(255),
        ];
    }

<<<<<<< HEAD
    #[Override]
=======
>>>>>>> fbc8f8e (.)
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('domain')
<<<<<<< HEAD
            ->columns([
                TextColumn::make('domain'),
                TextColumn::make('full-domain')->getStateUsing(
                    static fn($record) => Str::of($record->domain)->append('.')->append(request()->getHost()),
                ),
            ])
            ->filters([])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
=======
            ->columns(
                [
                    TextColumn::make('domain'),
                    TextColumn::make('full-domain')->getStateUsing(static fn ($record) => Str::of($record->domain)->append('.')->append(request()->getHost())),
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
                    EditAction::make(),
                    DeleteAction::make(),
                ]
            )
            ->toolbarActions(
                [
                    BulkActionGroup::make(
                        [
                            DeleteBulkAction::make(),
                        ]
                    ),
                ]
            );
>>>>>>> fbc8f8e (.)
    }
}
