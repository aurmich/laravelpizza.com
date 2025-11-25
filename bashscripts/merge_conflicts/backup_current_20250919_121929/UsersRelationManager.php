<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\RoleResource\RelationManagers;

<<<<<<< HEAD
use Filament\Tables\Columns\Layout\Component;
use Filament\Tables\Filters\BaseFilter;
use Override;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
=======
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\Layout\Component;
use Filament\Tables\Filters\BaseFilter;
>>>>>>> fbc8f8e (.)
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Modules\UI\Enums\TableLayoutEnum;
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;
use Modules\Xot\Filament\Traits\HasXotTable;
use Modules\Xot\Filament\Traits\TransTrait;

<<<<<<< HEAD
=======








>>>>>>> fbc8f8e (.)
/**
 * UsersRelationManager.
 *
 * Manages the relationship between users and roles, providing functionality
 * for viewing, filtering, and managing users associated with a specific role.
 */
final class UsersRelationManager extends XotBaseRelationManager
{
<<<<<<< HEAD
    protected static string $relationship = 'users';

    protected static null|string $inverseRelationship = 'roles';
=======

    protected static string $relationship = 'users';

    protected static ?string $inverseRelationship = 'roles';





>>>>>>> fbc8f8e (.)

    /**
     * Returns the form schema structure, defining the input fields for user data.
     *
     * @return array<\Filament\Schemas\Components\Component>
     */
<<<<<<< HEAD
    #[Override]
    public function getFormSchema(): array
    {
        return [
            TextInput::make('name')->required()->maxLength(255),
=======
    public function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
>>>>>>> fbc8f8e (.)
            // Additional fields can be added here as necessary
        ];
    }

    /**
     * Defines the columns displayed in the users list table.
     *
     * @return array<Tables\Columns\Column|Component>
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> fbc8f8e (.)
    public function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
<<<<<<< HEAD
                ->searchable()
                ->sortable()
                ->copyable(),
            TextColumn::make('email')
                ->searchable()
                ->sortable()
                ->copyable(),
            TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(),
            TextColumn::make('updated_at')
=======

                ->searchable()
                ->sortable()
                ->copyable(),

            TextColumn::make('email')

                ->searchable()
                ->sortable()
                ->copyable(),

            TextColumn::make('created_at')

                ->dateTime()
                ->sortable()
                ->toggleable(),

            TextColumn::make('updated_at')

>>>>>>> fbc8f8e (.)
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }

    /**
     * Configures available filters for the table, enabling users to refine their view.
     *
     * @return array<BaseFilter>
     */
<<<<<<< HEAD
    #[Override]
    public function getTableFilters(): array
    {
        return [
            Filter::make('active')->query(fn(Builder $query): Builder => $query->where('is_active', true))->toggle(),
            Filter::make('created_at')
=======
    public function getTableFilters(): array
    {
        return [
            Filter::make('active')

                ->query(fn (Builder $query): Builder => $query->where('is_active', true))
                ->toggle(),

            Filter::make('created_at')

>>>>>>> fbc8f8e (.)
                ->schema([
                    DatePicker::make('created_from'),
                    DatePicker::make('created_until'),
                ])
<<<<<<< HEAD
                ->query(fn(Builder $query, array $data): Builder => $query->when($data['created_from'], fn(
                    Builder $query,
                    $date,
                ) => $query->whereDate('created_at', '>=', $date))->when($data['created_until'], fn(
                    Builder $query,
                    $date,
                ) => $query->whereDate('created_at', '<=', $date)))
                ->columns(2),
        ];
    }
=======
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when($data['created_from'], fn (Builder $query, $date) => $query->whereDate('created_at', '>=', $date))
                        ->when($data['created_until'], fn (Builder $query, $date) => $query->whereDate('created_at', '<=', $date));
                })
                ->columns(2),
        ];
    }






>>>>>>> fbc8f8e (.)
}
