<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Resources\XotBaseResource\Pages;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
use Filament\Actions\CreateAction;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Resources\Pages\ManageRelatedRecords as FilamentManageRelatedRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Xot\Filament\Traits\HasXotTable;
use Modules\Xot\Filament\Traits\NavigationLabelTrait;
use Webmozart\Assert\Assert;
=======
use Filament\Actions\AttachAction;
use Filament\Actions\Action;
use Filament\Actions\DetachAction;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Webmozart\Assert\Assert;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\CreateAction;
use Illuminate\Database\Eloquent\Builder;
use Modules\Xot\Filament\Traits\HasXotTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Modules\Xot\Filament\Traits\NavigationLabelTrait;
use Filament\Resources\Pages\ManageRelatedRecords as FilamentManageRelatedRecords;
>>>>>>> f1d4085 (.)

/**
 * Classe base per la gestione delle relazioni nelle risorse Filament.
 * Estende la classe ManageRelatedRecords di Filament e fornisce funzionalità aggiuntive
 * specifiche per il framework Laraxot.
 *
 * @template TModel of Model
 */
abstract class XotBaseManageRelatedRecords extends FilamentManageRelatedRecords
{
    use HasXotTable;
    use InteractsWithForms;
    use NavigationLabelTrait;

    // protected static string $resource;

    /**
     * Restituisce il gruppo di navigazione (override opzionale).
     */
    public static function getNavigationGroup(): string
    {
        return '';
    }

    /*
     * @return array<\Filament\Forms\Components\Component>
     */
    // abstract public static function getFormSchema(): array;

    /**
     * Definisce le colonne della tabella per la visualizzazione dei record correlati.
     * Questo metodo può essere sovrascritto nelle classi figlie.
     *
     * @return array<string, TextColumn>
     */
<<<<<<< HEAD
    #[Override]
    public function getTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')->label('ID')->sortable(),
=======
    public function getTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')
                ->label('ID')
                ->sortable(),

>>>>>>> f1d4085 (.)
            'name' => TextColumn::make('name')
                ->label('Nome')
                ->searchable()
                ->sortable(),
<<<<<<< HEAD
=======

>>>>>>> f1d4085 (.)
            'created_at' => TextColumn::make('created_at')
                ->label('Data Creazione')
                ->dateTime('d/m/Y H:i')
                ->sortable(),
        ];
    }

    /**
     * Definisce le azioni dell'intestazione della tabella.
     * Questo metodo può essere sovrascritto nelle classi figlie.
     *
     * @return array<string, Action>
     */
    public function getTableHeaderActions(): array
    {
<<<<<<< HEAD
        return [
            'create' => CreateAction::make()->label('Crea Nuovo')->disableCreateAnother(),
        ];
=======
        $actions = [];
        $resource = static::class;
        // if (method_exists($resource, 'canCreate')) {
        //     $actions['create'] = Tables\Actions\CreateAction::make()
        //         ->iconButton()
        //         ->tooltip(__('user::actions.create'))
        //         ->visible(fn (?Model $record): bool => $resource::canCreate());
        // }

        // if (method_exists($resource, 'canAssociate')) {
        //     $actions['associate'] = Tables\Actions\AssociateAction::make()
        //         ->label('')
        //         ->icon('heroicon-o-paper-clip')
        //         ->tooltip(__('user::actions.associate_user'))
        //         ->visible(fn (?Model $record): bool => $resource::canAssociate());

        // }

        if (method_exists($resource, 'canAttach')) {
            $actions['attach'] = AttachAction::make()
                ->label('')
                ->icon('heroicon-o-link')
                ->tooltip(__('user::actions.attach_user'))
                ->visible(fn (?Model $record): bool => $resource::canAttach())
                // ->recordSelectOptionsQuery(fn (Builder $query) => 
                //     $query->addSelect(DB::raw("CONCAT(nome, ' ', cognome, ' (ID: ', matricola, ')') as display_name"))
                // )
            // ->recordTitleAttribute('display_name')
            ->preloadRecordSelect();
        }
        return $actions;
>>>>>>> f1d4085 (.)
    }

    /**
     * Definisce le azioni per ogni riga della tabella.
     * Questo metodo può essere sovrascritto nelle classi figlie.
     *
     * @return array<string, Action>
     */
    public function getTableActions(): array
    {
        return [
            'edit' => Action::make('edit')
                ->label('Modifica')
                ->icon('heroicon-o-pencil')
<<<<<<< HEAD
                ->url(fn(Model $record): string => static::getResource()::getUrl('edit', ['record' => $record])),
=======
                ->url(fn (Model $record): string => static::getResource()::getUrl('edit', ['record' => $record])),
                
            'detach' => DetachAction::make(),
            

>>>>>>> f1d4085 (.)
            // 'view' => Action::make('view')
            //     ->label('Visualizza')
            //     ->icon('heroicon-o-eye')
            //     ->url(fn (Model $record): string => static::getResource()::getUrl('view', ['record' => $record])),
        ];
    }

    /*
     * Configura la tabella per la visualizzazione dei record correlati.
     * public function table(Table $table): Table
     * {
     * return $table
     * ->columns($this->getTableColumns())
     * ->headerActions($this->getTableHeaderActions())
     * ->actions($this->getTableActions())
     * ->bulkActions([])
     * ->emptyStateActions([
     * 'create' => CreateAction::make()
     * ->label('Crea Nuovo')
     * ->disableCreateAnother(),
     * ]);
     * }.
<<<<<<< HEAD
     *
     * public function table(Table $table): Table
     * {
     * return $table
     * ->columns($this->getTableColumns())
     * ->headerActions($this->getTableHeaderActions())
     * ->actions($this->getTableActions())
     * ->bulkActions([])
     * ->emptyStateActions([
     * 'create' => CreateAction::make()
     * ->label('Crea Nuovo')
     * ->disableCreateAnother(),
     * ]);
     * }
     */
=======
     
    public function table(Table $table): Table
    {
        return $table
            ->columns($this->getTableColumns())
            ->headerActions($this->getTableHeaderActions())
            ->actions($this->getTableActions())
            ->bulkActions([])
            ->emptyStateActions([
                'create' => CreateAction::make()
                    ->label('Crea Nuovo')
                    ->disableCreateAnother(),
            ]);
    }
    */
>>>>>>> f1d4085 (.)
    /**
     * Configura il form per la creazione/modifica dei record correlati.
     */
    public function form(Schema $form): Schema
    {
<<<<<<< HEAD
        /** @var array<Component> $schema */
=======
        /** @var array<\Filament\Schemas\Components\Component> $schema */
>>>>>>> f1d4085 (.)
        $schema = $this->getFormSchema();
        return $form->components($schema);
    }

    /**
     * Restituisce il titolo della pagina.
     */
    public function getTitle(): string
    {
        $resource = static::getResource();
        $recordTitle = $this->getRecordTitle();
        $relationship = static::getRelationshipName();

        $titleString = '';
        if ($recordTitle instanceof Htmlable) {
            $titleString = $recordTitle->toHtml();
        } else {
            $titleString = (string) $recordTitle;
        }

        return Str::of($relationship)
            ->title()
<<<<<<< HEAD
            ->prepend($titleString . ' - ')
=======
            ->prepend($titleString.' - ')
>>>>>>> f1d4085 (.)
            ->toString();
    }
}
