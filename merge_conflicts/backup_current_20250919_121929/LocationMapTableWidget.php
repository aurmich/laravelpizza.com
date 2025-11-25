<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Widgets;

<<<<<<< HEAD
use Filament\Tables;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Modules\Geo\Models\Location;

/**
 * Widget tabella location migrato per Filament v4.
 * Funzionalità mappa temporaneamente rimosse in attesa di pacchetti compatibili.
 */
class LocationMapTableWidget extends BaseWidget
=======
use Filament\Schemas\Components\Section;
use Filament\Actions\CreateAction;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Cheesegrits\FilamentGoogleMaps\Actions\GoToAction;
use Cheesegrits\FilamentGoogleMaps\Actions\RadiusAction;
use Cheesegrits\FilamentGoogleMaps\Filters\MapIsFilter;
use Cheesegrits\FilamentGoogleMaps\Filters\RadiusFilter;
use Cheesegrits\FilamentGoogleMaps\Widgets\MapTableWidget;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Modules\Geo\Models\Location;
use Modules\Geo\Models\Place;

class LocationMapTableWidget extends MapTableWidget
>>>>>>> bc26394 (.)
{
    protected static ?string $heading = 'Location Map';

    protected static ?int $sort = 1;

    protected static ?string $pollingInterval = null;

<<<<<<< HEAD
    protected static bool $collapsible = true;

    /**
     * @return Builder<Location>
     */
=======
    protected static ?bool $clustering = true;

    protected static ?bool $fitToBounds = true;

    protected static ?string $mapId = 'incidents';

    protected static ?bool $filtered = true;

    protected static bool $collapsible = true;

    public ?bool $mapIsFilter = false;

    protected static ?string $markerAction = 'markerAction';

    public function getConfig(): array
    {
        $config = parent::getConfig();

        // Disable points of interest
        //        $config['mapConfig']['styles'] = [
        //            [
        //                'featureType' => 'poi',
        //                'elementType' => 'labels',
        //                'stylers' => [
        //                    ['visibility' => 'off'],
        //                ],
        //            ],
        //        ];

        //        $config['zoom'] = 5;
        $config['center'] = [
            'lat' => 34.730369,
            'lng' => -86.586104,
        ];

        return $config;
    }

    public function getFormSchema(): array
    {
        return [
            Section::make()->schema([
                TextInput::make('name')
                    ->maxLength(256),
                TextInput::make('lat')
                    ->maxLength(32),
                TextInput::make('lng')
                    ->maxLength(32),
                TextInput::make('street')
                    ->maxLength(255),
                TextInput::make('city')
                    ->maxLength(255),
                TextInput::make('state')
                    ->maxLength(255),
                TextInput::make('zip')
                    ->maxLength(255),
                TextInput::make('formatted_address')
                    ->maxLength(1024),
            ]),
        ];
    }

>>>>>>> bc26394 (.)
    protected function getTableQuery(): Builder
    {
        return Location::query()->latest();
    }

<<<<<<< HEAD
    /**
     * @return array<Tables\Columns\Column>
     */
=======
>>>>>>> bc26394 (.)
    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
<<<<<<< HEAD
                ->searchable()
                ->sortable(),
            TextColumn::make('street')
                ->searchable()
                ->sortable(),
=======
                ->searchable(),
            TextColumn::make('street')
                ->searchable(),
>>>>>>> bc26394 (.)
            TextColumn::make('city')
                ->searchable()
                ->sortable(),
            TextColumn::make('state')
                ->searchable()
                ->sortable(),
<<<<<<< HEAD
            TextColumn::make('zip')
                ->sortable(),
            TextColumn::make('latitude')
                ->numeric(decimalPlaces: 6)
                ->sortable(),
            TextColumn::make('longitude')
                ->numeric(decimalPlaces: 6)
                ->sortable(),
        ];
    }

    /**
     * Configurazione della tabella.
     */
    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns($this->getTableColumns());
=======
            TextColumn::make('zip'),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            RadiusFilter::make('location')
                ->section('Radius Filter')
                ->selectUnit(),
            MapIsFilter::make('map'),
        ];
    }

    protected function getTableRecordAction(): ?string
    {
        return 'edit';
    }

    protected function getTableHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->schema($this->getFormSchema()),
        ];
    }

    public function getTableActions(): array
    {
        return [
            ViewAction::make()
                ->schema($this->getFormSchema()),
            EditAction::make()
                ->schema($this->getFormSchema()),
            GoToAction::make()
                ->zoom(fn () => 14),
            RadiusAction::make('location'),
        ];
    }

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [10, 25, 50, 100];
    }

    /**
     * @return array<int, array{location: array{lat: float, lng: float}, label: string, id: int, icon: array{url: string, type: string, scale: array<int, int>}}>
     */
    public function getData(): array
    {
        $locations = $this->getRecords();
        $data = [];

        foreach ($locations as $location) {
            if ($location->latitude && $location->longitude) {
                $iconUrl = $this->getMarkerIcon($location);
                
                $data[] = [
                    'location' => [
                        'lat' => (float) $location->latitude,
                        'lng' => (float) $location->longitude,
                    ],
                    'label' => (string) $location->name,
                    'id' => (int) $location->id,
                    'icon' => [
                        'url' => is_string($iconUrl) ? $iconUrl : '',
                        'type' => 'url',
                        'scale' => [32, 32],
                    ],
                ];
            }
        }

        return $data;
    }

    public function markerAction(): Action
    {
        return Action::make('markerAction')
            ->label('Details')
            ->schema([
                Section::make([
                    TextEntry::make('name'),
                    TextEntry::make('street'),
                    TextEntry::make('city'),
                    TextEntry::make('state'),
                    TextEntry::make('zip'),
                    TextEntry::make('formatted_address'),
                ])
                    ->columns(3),
            ])
            ->record(function (array $arguments) {
                return array_key_exists('model_id', $arguments) ? Location::find($arguments['model_id']) : null;
            })
            ->modalSubmitAction(false);
    }

    /**
     * @return string|null
     */
    public function getMarkerIcon(Place $place): ?string
    {
        $type = $place->placeType->slug ?? 'default';
        /** @var array<string, mixed>|null $markerConfig */
        $markerConfig = config("geo.markers.types.{$type}");

        if (!is_array($markerConfig)) {
            /** @var array<string, mixed>|null $defaultConfig */
            $defaultConfig = config('geo.markers.types.default');
            $markerConfig = $defaultConfig;
        }

        if (!is_array($markerConfig)) {
            return null;
        }

        // Validazione sicura per accesso nested all'icona
        /** @var mixed $iconConfig */
        $iconConfig = $markerConfig['icon'] ?? null;
        
        if (!is_array($iconConfig)) {
            return null;
        }

        /** @var string|null $iconUrl */
        $iconUrl = $iconConfig['url'] ?? null;
        
        return is_string($iconUrl) ? $iconUrl : null;
>>>>>>> bc26394 (.)
    }
}
