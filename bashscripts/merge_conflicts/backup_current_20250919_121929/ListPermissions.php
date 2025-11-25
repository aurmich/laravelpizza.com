<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\PermissionResource\Pages;

<<<<<<< HEAD
use Filament\Tables\Filters\BaseFilter;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Override;
=======
>>>>>>> fbc8f8e (.)
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkAction;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
=======
use Filament\Tables\Filters\BaseFilter;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
>>>>>>> fbc8f8e (.)
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Collection;
use Modules\User\Filament\Resources\PermissionResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
<<<<<<< HEAD
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;
use Webmozart\Assert\Assert;

=======
use Webmozart\Assert\Assert;

use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;

>>>>>>> fbc8f8e (.)
class ListPermissions extends XotBaseListRecords
{
    protected static string $resource = PermissionResource::class;

    /**
     * @return array<string, Tables\Columns\Column>
     */
<<<<<<< HEAD
    #[Override]
    public function getTableColumns(): array
    {
        return [
            'name' => TextColumn::make('name')->searchable()->sortable(),
            'guard_name' => TextColumn::make('guard_name')->searchable()->sortable(),
            'active' => IconColumn::make('active')->boolean(),
            'created_at' => TextColumn::make('created_at')->dateTime()->sortable(),
=======
    public function getTableColumns(): array
    {
        return [
            'name' => TextColumn::make('name')
                ->searchable()
                ->sortable(),
            'guard_name' => TextColumn::make('guard_name')
                ->searchable()
                ->sortable(),
            'active' => IconColumn::make('active')
                ->boolean(),
            'created_at' => TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
>>>>>>> fbc8f8e (.)
        ];
    }

    /**
     * @return array<string, BaseFilter>
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> fbc8f8e (.)
    public function getTableFilters(): array
    {
        return [
            'guard_name' => SelectFilter::make('guard_name')
                ->options([
                    'web' => 'Web',
                    'api' => 'API',
                    'sanctum' => 'Sanctum',
                ])
                ->multiple(),
        ];
    }

    /**
     * @return array<string, Action|ActionGroup>
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> fbc8f8e (.)
    public function getTableActions(): array
    {
        return [
            'view' => ViewAction::make(),
            'edit' => EditAction::make(),
            'delete' => DeleteAction::make(),
        ];
    }

    /**
     * @return array<string, Action>
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> fbc8f8e (.)
    protected function getHeaderActions(): array
    {
        return [
            'create' => CreateAction::make(),
        ];
    }

    /**
<<<<<<< HEAD
     * @return array<string, BulkAction>
     */
    #[Override]
=======
     * @return array<string, \Filament\Actions\BulkAction>
     */
>>>>>>> fbc8f8e (.)
    public function getTableBulkActions(): array
    {
        Assert::classExists($roleModel = config('permission.models.role'));

        return [
            'delete' => DeleteBulkAction::make(),
            'attach_role' => BulkAction::make('Attach Role')
<<<<<<< HEAD
                ->action(static function (Collection $collection, array $data): void {
                    foreach ($collection as $record) {
                        // Verifichiamo che $record sia un'istanza di Model prima di procedere
                        Assert::isInstanceOf(
                            $record,
                            Model::class,
                            '[' . __LINE__ . '][' . __CLASS__ . ']',
                        );

                        // Poi verifichiamo che il modello abbia il metodo roles() prima di chiamarlo
                        if (method_exists($record, 'roles')) {
                            $record->roles()->sync($data['role']);
                            $record->save();
                        }
                    }
                })
                ->schema([
                    Select::make('role')->options($roleModel::query()->pluck('name', 'id'))->required(),
=======
                ->action(
                    static function (Collection $collection, array $data): void {
                        foreach ($collection as $record) {
                            // Verifichiamo che $record sia un'istanza di Model prima di procedere
                            Assert::isInstanceOf($record, Model::class, '['.__LINE__.']['.__CLASS__.']');

                            // Poi verifichiamo che il modello abbia il metodo roles() prima di chiamarlo
                            if (method_exists($record, 'roles')) {
                                $record->roles()->sync($data['role']);
                                $record->save();
                            }
                        }
                    }
                )
                ->form([
                    Select::make('role')
                        ->options($roleModel::query()->pluck('name', 'id'))
                        ->required(),
>>>>>>> fbc8f8e (.)
                ])
                ->deselectRecordsAfterCompletion(),
        ];
    }
}
