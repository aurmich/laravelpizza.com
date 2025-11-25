<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Resources;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
=======
>>>>>>> f1d4085 (.)
use Modules\Xot\Filament\Resources\ExtraResource\Pages\ListExtras;
use Modules\Xot\Filament\Resources\ExtraResource\Pages\CreateExtra;
use Modules\Xot\Filament\Resources\ExtraResource\Pages\EditExtra;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Modules\Xot\Filament\Resources\ExtraResource\Pages;
<<<<<<< HEAD
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;
use Modules\Xot\Models\Extra;

class ExtraResource extends XotBaseResource
{
    protected static null|string $model = Extra::class;
=======
use Modules\Xot\Models\Extra;




use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;





class ExtraResource extends XotBaseResource
{
    protected static ?string $model = Extra::class;
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
            'id' => TextInput::make('id')->required()->maxLength(36),
            'post_type' => TextInput::make('post_type')->required()->maxLength(255),
            'post_id' => TextInput::make('post_id')->required()->numeric(),
=======
     * @return array<string, \Filament\Schemas\Components\Component>
     */
    public static function getFormSchema(): array
    {
        return [
            'id' => TextInput::make('id')
                ->required()
                ->maxLength(36),

            'post_type' => TextInput::make('post_type')
                ->required()
                ->maxLength(255),

            'post_id' => TextInput::make('post_id')
                ->required()
                ->numeric(),

>>>>>>> f1d4085 (.)
            'value' => KeyValue::make('value')
                ->keyLabel('Chiave')
                ->valueLabel('Valore')
                ->reorderable()
                ->columnSpanFull(),
        ];
    }

<<<<<<< HEAD
    #[Override]
    public static function getRelations(): array
    {
        return [];
    }

    #[Override]
=======
    public static function getRelations(): array
    {
        return [
        ];
    }

>>>>>>> f1d4085 (.)
    public static function getPages(): array
    {
        return [
            'index' => ListExtras::route('/'),
            'create' => CreateExtra::route('/create'),
            'edit' => EditExtra::route('/{record}/edit'),
        ];
    }
}
