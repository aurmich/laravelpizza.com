<?php

/**
 * @see https://github.com/Althinect/filament-spatie-roles-permissions/tree/2.x
 * @see https://github.com/phpsa/filament-authentication/blob/main/src/resources/PermissionResource.php
 */

declare(strict_types=1);

namespace Modules\User\Filament\Resources;

<<<<<<< HEAD
use Override;
=======
>>>>>>> fbc8f8e (.)
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Modules\User\Filament\Resources\PermissionResource\Pages\CreatePermission;
use Modules\User\Filament\Resources\PermissionResource\Pages\EditPermission;
use Modules\User\Filament\Resources\PermissionResource\Pages\ListPermissions;
use Modules\User\Models\Permission;
<<<<<<< HEAD
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;
use Modules\Xot\Filament\Resources\XotBaseResource;
=======
use Modules\Xot\Filament\Resources\XotBaseResource;
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;
>>>>>>> fbc8f8e (.)

class PermissionResource extends XotBaseResource
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-lock-closed';

<<<<<<< HEAD
    protected static null|string $model = Permission::class;

    #[Override]
    public static function getFormSchema(): array
    {
        return [
            'name' => TextInput::make('name')->required()->maxLength(255),
            'guard_name' => TextInput::make('guard_name')->required()->maxLength(255),
            'active' => Toggle::make('active')->required(),
        ];
    }

    #[Override]
=======
    protected static ?string $model = Permission::class;

    public static function getFormSchema(): array
    {
        return [
            'name' => TextInput::make('name')
                ->required()
                ->maxLength(255),
            'guard_name' => TextInput::make('guard_name')
                ->required()
                ->maxLength(255),
            'active' => Toggle::make('active')
                ->required(),
        ];
    }

>>>>>>> fbc8f8e (.)
    public static function getRelations(): array
    {
        return [];
    }

<<<<<<< HEAD
    #[Override]
=======
>>>>>>> fbc8f8e (.)
    public static function getPages(): array
    {
        return [
            'index' => ListPermissions::route('/'),
            'create' => CreatePermission::route('/create'),
            'edit' => EditPermission::route('/{record}/edit'),
        ];
    }
}
