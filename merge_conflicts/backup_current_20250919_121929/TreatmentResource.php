<?php

declare(strict_types=1);

namespace Modules\Gdpr\Filament\Resources;

<<<<<<< HEAD
use Override;
=======
>>>>>>> 0c1819a (.)
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Modules\Gdpr\Filament\Resources\TreatmentResource\Pages\ListTreatments;
use Modules\Gdpr\Filament\Resources\TreatmentResource\Pages\CreateTreatment;
use Modules\Gdpr\Filament\Resources\TreatmentResource\Pages\EditTreatment;
use Filament\Forms;
use Filament\Tables;
use Modules\Gdpr\Filament\Resources\TreatmentResource\Pages;
use Modules\Gdpr\Models\Treatment;
use Modules\Xot\Filament\Resources\XotBaseResource;

class TreatmentResource extends XotBaseResource
{
<<<<<<< HEAD
    protected static null|string $model = Treatment::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    #[Override]
    public static function getFormSchema(): array
    {
        return [
            'active' => Toggle::make('active')->required(),
            'required' => Toggle::make('required')->required(),
            'name' => TextInput::make('name')->required()->maxLength(191),
            'description' => Textarea::make('description')->required()->columnSpanFull(),
            'documentVersion' => TextInput::make('documentVersion')->maxLength(191)->default(null),
            'documentUrl' => TextInput::make('documentUrl')->maxLength(191)->default(null),
            'weight' => TextInput::make('weight')->required()->numeric(),
=======
    protected static ?string $model = Treatment::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getFormSchema(): array
    {
        return [
            'active' => Toggle::make('active')
                ->required(),
            'required' => Toggle::make('required')
                ->required(),
            'name' => TextInput::make('name')
                ->required()
                ->maxLength(191),
            'description' => Textarea::make('description')
                ->required()
                ->columnSpanFull(),
            'documentVersion' => TextInput::make('documentVersion')
                ->maxLength(191)
                ->default(null),
            'documentUrl' => TextInput::make('documentUrl')
                ->maxLength(191)
                ->default(null),
            'weight' => TextInput::make('weight')
                ->required()
                ->numeric(),
>>>>>>> 0c1819a (.)
        ];
    }

    public function getTableColumns(): array
    {
        return [
            // Tables\Columns\TextColumn::make('id')
<<<<<<< HEAD
            
            //     ->searchable(),
            IconColumn::make('active')->boolean(),
            IconColumn::make('required')->boolean(),
            TextColumn::make('name')->searchable(),
            TextColumn::make('documentVersion')->searchable(),
            TextColumn::make('documentUrl')->searchable(),
            TextColumn::make('weight')->numeric()->sortable(),
=======
            //
            //     ->searchable(),
            IconColumn::make('active')
                ->boolean(),
            IconColumn::make('required')
                ->boolean(),
            TextColumn::make('name')
                ->searchable(),
            TextColumn::make('documentVersion')
                ->searchable(),
            TextColumn::make('documentUrl')
                ->searchable(),
            TextColumn::make('weight')
                ->numeric()
                ->sortable(),
>>>>>>> 0c1819a (.)
            TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }

<<<<<<< HEAD
    #[Override]
=======
>>>>>>> 0c1819a (.)
    public static function getPages(): array
    {
        return [
            'index' => ListTreatments::route('/'),
            'create' => CreateTreatment::route('/create'),
            'edit' => EditTreatment::route('/{record}/edit'),
        ];
    }
}
