<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Widgets;

<<<<<<< HEAD
use Override;
use Carbon\Carbon;
use Exception;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Modules\SaluteOra\Models\Appointment;
use Modules\Xot\Filament\Widgets\XotBaseChartWidget;

class ModelTrendChartWidget extends XotBaseChartWidget
{
    protected null|string $heading = null;
    protected static null|int $sort = 5;
    protected static bool $isLazy = true;
    protected null|string $pollingInterval = '300s'; // 5 minuti

    public string $model;

    #[Override]
    public function getHeading(): null|string
=======
use Carbon\Carbon;
use Exception;
use Modules\Xot\Filament\Widgets\XotBaseChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Modules\SaluteOra\Models\Appointment;

class ModelTrendChartWidget extends XotBaseChartWidget
{
    protected ?string $heading = null;
    protected static ?int $sort = 5;
    protected static bool $isLazy = true;
    protected ?string $pollingInterval = '300s'; // 5 minuti

    public string $model;

    public function getHeading(): ?string
>>>>>>> f1d4085 (.)
    {
        return static::transClass($this->model, 'widgets.model_trend_chart.heading');
    }

<<<<<<< HEAD
    #[Override]
=======
>>>>>>> f1d4085 (.)
    protected function getData(): array
    {
        try {
            $data = Trend::model($this->model)
                ->between(
                    start: now()->subDays(30),
                    end: now(),
                )
                ->perDay()
                ->count();

            return [
                'datasets' => [
                    [
                        'label' => __('salutemo::widgets.appointment_creation_chart.label'),
<<<<<<< HEAD
                        'data' => $data->map(fn(mixed $value) => ($value instanceof TrendValue)
                            ? $value->aggregate
                            : 0),
=======
                        'data' => $data->map(fn (mixed $value) => $value instanceof TrendValue ? $value->aggregate : 0),
>>>>>>> f1d4085 (.)
                        'backgroundColor' => 'rgba(139, 92, 246, 0.5)',
                        'borderColor' => 'rgb(139, 92, 246)',
                        'borderWidth' => 2,
                        'tension' => 0.4,
                    ],
                ],
<<<<<<< HEAD
                'labels' => $data->map(fn(mixed $value) => ($value instanceof TrendValue)
                    ? Carbon::parse($value->date)->format('d/m')
                    : ''),
=======
                'labels' => $data->map(fn (mixed $value) => $value instanceof TrendValue ? Carbon::parse($value->date)->format('d/m') : ''),
>>>>>>> f1d4085 (.)
            ];
        } catch (Exception $e) {
            // Fallback appropriato senza logging inutile
            return [
                'datasets' => [
                    [
                        'label' => __('salutemo::widgets.appointment_creation_chart.label'),
                        'data' => [],
                        'backgroundColor' => 'rgba(139, 92, 246, 0.5)',
                        'borderColor' => 'rgb(139, 92, 246)',
                        'borderWidth' => 2,
                        'tension' => 0.4,
                    ],
                ],
                'labels' => [],
            ];
        }
    }

<<<<<<< HEAD
    #[Override]
=======
>>>>>>> f1d4085 (.)
    protected function getType(): string
    {
        return 'line';
    }
<<<<<<< HEAD
}
=======
} 
>>>>>>> f1d4085 (.)
