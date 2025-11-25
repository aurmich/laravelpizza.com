<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\RoleResource\RelationManagers;

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
use Filament\Actions\DeleteBulkAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;

<<<<<<< HEAD
=======








>>>>>>> fbc8f8e (.)
class PermissionsRelationManager extends XotBaseRelationManager
{
    protected static string $relationship = 'permissions';

    /**
     * Configura lo schema del form per la gestione dei permessi.
     *
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
            'name' => TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->placeholder(__('Inserisci il nome del permesso')),
        ];
    }

    /**
     * Configura la tabella per la visualizzazione e la gestione dei permessi.
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> fbc8f8e (.)
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
<<<<<<< HEAD
                TextColumn::make('name')->sortable()->searchable(),
            ])
            ->filters([]) // Aggiungi eventuali filtri qui se necessario
            ->headerActions([
                CreateAction::make()->tooltip(__('Crea un nuovo permesso')),
            ])
            ->recordActions([
                EditAction::make()->tooltip(__('Modifica permesso')),
                DeleteAction::make()->tooltip(__('Elimina permesso')),
            ])
            ->toolbarActions([
                DeleteBulkAction::make()->tooltip(__('Elimina i permessi selezionati')),
=======
                TextColumn::make('name')

                    ->sortable()
                    ->searchable(),
            ])
            ->filters([]) // Aggiungi eventuali filtri qui se necessario
            ->headerActions([
                CreateAction::make()

                    ->tooltip(__('Crea un nuovo permesso')),
            ])
            ->recordActions([
                EditAction::make()

                    ->tooltip(__('Modifica permesso')),
                DeleteAction::make()

                    ->tooltip(__('Elimina permesso')),
            ])
            ->toolbarActions([
                DeleteBulkAction::make()

                    ->tooltip(__('Elimina i permessi selezionati')),
>>>>>>> fbc8f8e (.)
            ]);
    }
}
