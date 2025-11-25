<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Resources;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
=======
>>>>>>> f1d4085 (.)
use Modules\Xot\Filament\Resources\CacheLockResource\Pages\ListCacheLocks;
use Modules\Xot\Filament\Resources\CacheLockResource\Pages\CreateCacheLock;
use Modules\Xot\Filament\Resources\CacheLockResource\Pages\EditCacheLock;
use Filament\Forms\Components\TextInput;
use Modules\Xot\Filament\Resources\CacheLockResource\Pages;
<<<<<<< HEAD
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;
use Modules\Xot\Models\CacheLock;

class CacheLockResource extends XotBaseResource
{
    protected static null|string $model = CacheLock::class;
=======
use Modules\Xot\Models\CacheLock;




use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;





class CacheLockResource extends XotBaseResource
{
    protected static ?string $model = CacheLock::class;
>>>>>>> f1d4085 (.)

    /**
     * Get the form schema for the resource.
     *
<<<<<<< HEAD
     * @return array<string, Component>
     */
    #[Override]
    public static function getFormSchema(): array
    {
        return [
            'key' => TextInput::make('key')->required()->maxLength(255),
            'owner' => TextInput::make('owner')->required()->maxLength(255),
            'expiration' => TextInput::make('expiration')->required()->numeric(),
        ];
    }

    #[Override]
    public static function getRelations(): array
    {
        return [];
    }

    #[Override]
=======
     * @return array<string, \Filament\Schemas\Components\Component>
     */
    public static function getFormSchema(): array
    {
        return [
            'key' => TextInput::make('key')
                ->required()
                ->maxLength(255),

            'owner' => TextInput::make('owner')
                ->required()
                ->maxLength(255),

            'expiration' => TextInput::make('expiration')
                ->required()
                ->numeric(),
        ];
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

>>>>>>> f1d4085 (.)
    public static function getPages(): array
    {
        return [
            'index' => ListCacheLocks::route('/'),
            'create' => CreateCacheLock::route('/create'),
            'edit' => EditCacheLock::route('/{record}/edit'),
        ];
    }
}
