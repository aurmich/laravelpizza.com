<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Widgets;

<<<<<<< HEAD
use Filament\Widgets\ChartWidget as FilamentChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Xot\Filament\Traits\TransTrait;
=======
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\Xot\Filament\Traits\TransTrait;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\ChartWidget as FilamentChartWidget;
>>>>>>> f1d4085 (.)

/**
 * Widget per visualizzare il trend delle registrazioni pazienti.
 *
 * Mostra un grafico a linee con il numero di pazienti registrati nel tempo.
 * I dati sono cacheati per 5 minuti per ottimizzare le performance.
 */
abstract class XotBaseChartWidget extends FilamentChartWidget
{
    use TransTrait;
    use InteractsWithPageFilters;
<<<<<<< HEAD

    protected null|string $heading = null;
    protected static null|int $sort = 1;
    protected static bool $isLazy = true;
    protected null|string $pollingInterval = null;

    /**
     * Restituisce il titolo del widget.
     *
     * CRITICO: Deve essere public per rispettare il contratto ChartWidget
     */
    public function getHeading(): null|string
    {
        return static::trans('navigation.heading');
=======
    protected ?string $heading = null;
    protected static ?int $sort = 1;
    protected static bool $isLazy = true;
    protected ?string $pollingInterval = null;

    /**
     * Restituisce il titolo del widget.
     * 
     * CRITICO: Deve essere public per rispettare il contratto ChartWidget
     */
    public function getHeading(): ?string
    {
        return static::trans('navigation.heading');
        
>>>>>>> f1d4085 (.)
    }

    /**
     * Restituisce i dati per il grafico.
     *
     * @return array<string, mixed>
     */
    protected function getData(): array
    {
        return [];
    }

    /**
     * Restituisce il tipo di grafico.
     */
    protected function getType(): string
    {
        return 'line';
    }

    /**
     * Restituisce le opzioni del grafico.
     *
     * @return array<string, mixed>
     */
    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
                'tooltip' => [
                    'mode' => 'index',
                    'intersect' => false,
                    'callbacks' => [
<<<<<<< HEAD
                        'label' =>

                                'function(context) {
                            return "' .
                                __('salutemo::widgets.patient_registration_trend.total_registrations') .
                                '".replace(":count", context.parsed.y);
                        }'
                            ,
=======
                        'label' => 'function(context) {
                            return "' . __('salutemo::widgets.patient_registration_trend.total_registrations') . '".replace(":count", context.parsed.y);
                        }',
>>>>>>> f1d4085 (.)
                    ],
                ],
            ],
            'scales' => [
                'x' => [
                    'display' => true,
                    'title' => [
                        'display' => true,
                        'text' => __('salutemo::widgets.patient_registration_trend.period.label'),
                    ],
                    'grid' => [
                        'display' => false,
                    ],
                ],
                'y' => [
                    'display' => true,
                    'title' => [
                        'display' => true,
                        'text' => __('salutemo::widgets.patient_registration_trend.total_registrations'),
                    ],
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
            'interaction' => [
                'mode' => 'nearest',
                'axis' => 'x',
                'intersect' => false,
            ],
        ];
    }

    /**
     * Restituisce l'altezza del widget.
     */
<<<<<<< HEAD
    protected function getHeight(): null|string
    {
        return '300px';
    }
}
=======
    protected function getHeight(): ?string
    {
        return '300px';
    }


} 
>>>>>>> f1d4085 (.)
