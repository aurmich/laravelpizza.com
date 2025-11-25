<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\UserResource\RelationManagers;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
=======
>>>>>>> fbc8f8e (.)
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\Column;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Modules\User\Filament\Resources\TenantResource\Pages\ListTenants;
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;
use Modules\Xot\Filament\Traits\HasXotTable;

/**
 * Manages the relationship between users and tenants.
 *
 * This class provides the form schema and table configuration for the "tenants" relationship
 * with strong typing and enhanced structure for stability and professionalism.
 */
class TenantsRelationManager extends XotBaseRelationManager
{
<<<<<<< HEAD
    protected static string $relationship = 'tenants';

    protected static null|string $recordTitleAttribute = 'name';
=======


    protected static string $relationship = 'tenants';

    protected static ?string $recordTitleAttribute = 'name';
>>>>>>> fbc8f8e (.)

    /**
     * Set up the form schema for tenant relations.
     *
<<<<<<< HEAD
     * @return array<Component>
     */
    #[Override]
    public function getFormSchema(): array
    {
        return [
            TextInput::make('name')->required()->maxLength(255),
=======
     * @return array<\Filament\Schemas\Components\Component>
     */
    public function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
>>>>>>> fbc8f8e (.)
        ];
    }

    /**
     * Define table columns for displaying tenant information.
     *
     * @return array<string, Column>
     */
<<<<<<< HEAD
    #[Override]
    public function getTableColumns(): array
    {
        $columns = app(ListTenants::class)->getTableColumns();

        // Ensure we only return Column instances, filter out any Layout\Component instances
        return array_filter($columns, fn($column): bool => $column instanceof Column);
=======
    public function getTableColumns(): array
    {
        $columns = app(ListTenants::class)->getTableColumns();
        
        // Ensure we only return Column instances, filter out any Layout\Component instances
        return array_filter($columns, function ($column): bool {
            return $column instanceof Column;
        });
>>>>>>> fbc8f8e (.)
    }
}
