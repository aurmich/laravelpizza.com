<?php

declare(strict_types=1);

namespace Modules\UI\Filament\Forms\Components;

use Exception;
use Throwable;
<<<<<<< HEAD
use Carbon\Carbon;
use Closure;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\DatePicker;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

=======
use Closure;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Filament\Forms\Components\DatePicker;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\Concerns\InteractsWithActions;
>>>>>>> 727968c (.)
use function Safe\preg_match;

/**
 * InlineDatePicker - Calendario inline minimalista e multilingua
<<<<<<< HEAD
 *
=======
 * 
>>>>>>> 727968c (.)
 * Principi:
 * - DRY: Don't Repeat Yourself - Codice senza duplicazioni
 * - KISS: Keep It Simple, Stupid - Semplicità sopra tutto
 * - Carbon First: Localizzazione automatica tramite Carbon
 * - Design One Theme: UI/UX conforme al tema standard
 */
class InlineDatePicker extends DatePicker
{
<<<<<<< HEAD
    /**
     * Date abilitate per la selezione.
     *
=======
    
    /**
     * Date abilitate per la selezione.
     * 
>>>>>>> 727968c (.)
     * @var array<string>|Closure|null
     */
    protected array|Closure|null $enabledDates = null;

    /**
     * Mese attualmente visualizzato (formato Y-m).
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> 727968c (.)
     * @var string
     */
    public string $currentViewMonth;

    /**
     * Vista Blade per il rendering.
     */
    protected string $view = 'ui::filament.forms.components.inline-date-picker';

    /**
     * Setup iniziale del componente.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Inizializzazione con localizzazione Carbon
        Carbon::setLocale(App::getLocale());
        $this->currentViewMonth = now()->format('Y-m');

        // Hydration/Dehydration del valore
        $this->afterStateHydrated(static function (self $component, $state): void {
<<<<<<< HEAD
=======
            
>>>>>>> 727968c (.)
            if ($state) {
                $date = Carbon::parse($state);
                $component->currentViewMonth = $date->format('Y-m');
            }
        });

<<<<<<< HEAD
        $this->dehydrateStateUsing(static fn(self $_component, $state) => $state
            ? Carbon::parse($state)->format('Y-m-d')
            : null);
=======
        $this->dehydrateStateUsing(static function (self $component, $state) {
            
            return $state ? Carbon::parse($state)->format('Y-m-d') : null;
        });
>>>>>>> 727968c (.)
    }

    /**
     * Naviga al mese precedente.
     */
    public function previousMonth(): void
    {
        $currentMonth = Carbon::createFromFormat('Y-m', $this->currentViewMonth);
<<<<<<< HEAD
        if (!$currentMonth) {
=======
        if(!$currentMonth){
>>>>>>> 727968c (.)
            return;
        }
        $this->currentViewMonth = $currentMonth->subMonthNoOverflow()->format('Y-m');
    }

    /**
     * Naviga al mese successivo.
     */
    public function nextMonth(): void
    {
        $currentMonth = Carbon::createFromFormat('Y-m', $this->currentViewMonth);
<<<<<<< HEAD
        if (!$currentMonth) {
=======
        if(!$currentMonth){
>>>>>>> 727968c (.)
            return;
        }
        $this->currentViewMonth = $currentMonth->addMonthNoOverflow()->format('Y-m');
    }

    /**
     * Imposta le date abilitate.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> 727968c (.)
     * @param array<string>|Closure $dates
     * @return static
     */
    public function enabledDates(array|Closure $dates): static
    {
        $this->enabledDates = $dates;
        return $this;
    }

    /**
     * Imposta il mese corrente di visualizzazione.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> 727968c (.)
     * @param string $month Formato Y-m (es. '2025-06')
     * @return static
     */
    public function currentViewMonth(string $month): static
    {
        // ✅ Validazione robusta - fallback se vuoto o invalido
        if (empty($month) || !preg_match('/^\d{4}-\d{2}$/', $month)) {
            $this->currentViewMonth = now()->format('Y-m');
        } else {
            // Verifica che sia una data valida
            try {
                Carbon::createFromFormat('Y-m', $month);
                $this->currentViewMonth = $month;
            } catch (Exception $e) {
                $this->currentViewMonth = now()->format('Y-m');
            }
        }
<<<<<<< HEAD

        return $this;
    }

    /**
     * Ottiene le date abilitate risolte.
     *
=======
        
        return $this;
    }

    

    /**
     * Ottiene le date abilitate risolte.
     * 
>>>>>>> 727968c (.)
     * @return Collection<int, string>
     */
    public function getEnabledDates(): Collection
    {
        $dates = $this->evaluate($this->enabledDates) ?? [];
        /** @phpstan-ignore return.type, argument.templateType, argument.templateType */
<<<<<<< HEAD
        return collect($dates)->map(fn($date): string => Carbon::parse($date)->format('Y-m-d'));
=======
        return collect($dates)->map(function ($date): string {
            return Carbon::parse($date)->format('Y-m-d');
        });
>>>>>>> 727968c (.)
    }

    /**
     * Verifica se una data è abilitata.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> 727968c (.)
     * @param string $date
     * @return bool
     */
    public function isDateEnabled(string $date): bool
    {
        return $this->getEnabledDates()->isEmpty() || $this->getEnabledDates()->contains($date);
    }

    /**
     * Genera i dati del calendario per il mese corrente.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> 727968c (.)
     * @return array<string, mixed>
     */
    public function generateCalendarData(): array
    {
        // ✅ Validazione di sicurezza - assicura che currentViewMonth sia valido
        if (empty($this->currentViewMonth) || !preg_match('/^\d{4}-\d{2}$/', $this->currentViewMonth)) {
            $this->currentViewMonth = now()->format('Y-m');
        }
<<<<<<< HEAD

=======
        
>>>>>>> 727968c (.)
        /** @phpstan-ignore method.nonObject */
        $targetMonth = Carbon::createFromFormat('Y-m', $this->currentViewMonth)->startOfMonth();
        /** @phpstan-ignore-next-line */
        $firstDay = $targetMonth->copy()->startOfWeek(Carbon::MONDAY);
        $lastDay = $targetMonth->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);
<<<<<<< HEAD

        $weeks = collect();
        $currentDay = $firstDay->copy();

        while ($currentDay->lte($lastDay)) {
            $week = collect();

            for ($i = 0; $i < 7; $i++) {
                $isCurrentMonth = $currentDay->month === $targetMonth->month;
                $isToday = $currentDay->isToday();

=======
        
        $weeks = collect();
        $currentDay = $firstDay->copy();
        
        while ($currentDay->lte($lastDay)) {
            $week = collect();
            
            for ($i = 0; $i < 7; $i++) {
                $isCurrentMonth = $currentDay->month === $targetMonth->month;
                $isToday = $currentDay->isToday();
                
>>>>>>> 727968c (.)
                // Gestione sicura del controllo selezione
                $isSelected = false;
                try {
                    $state = $this->getState();
                    /** @phpstan-ignore argument.type */
                    $isSelected = $state && $currentDay->isSameDay(Carbon::parse($state));
                } catch (Throwable $e) {
                    $isSelected = false;
                }
<<<<<<< HEAD

                $isEnabled = $this->isDateEnabled($currentDay->format('Y-m-d')) && $isCurrentMonth;

=======
                
                $isEnabled = $this->isDateEnabled($currentDay->format('Y-m-d')) && $isCurrentMonth;
                
>>>>>>> 727968c (.)
                $week->push([
                    'dateString' => $currentDay->format('Y-m-d'),
                    'datetime' => $currentDay->format('Y-m-d'),
                    'day' => $currentDay->day,
                    'isCurrentMonth' => $isCurrentMonth,
                    'isToday' => $isToday,
                    'isSelected' => $isSelected,
                    'isEnabled' => $isEnabled,
                ]);
<<<<<<< HEAD

                $currentDay->addDay();
            }

            $weeks->push($week->toArray());
        }

=======
                
                $currentDay->addDay();
            }
            
            $weeks->push($week->toArray());
        }
        
>>>>>>> 727968c (.)
        return [
            'weeks' => $weeks->toArray(),
            'month' => $targetMonth,
            'monthName' => $targetMonth->translatedFormat('F'),
            'year' => $targetMonth->year,
            'weekdays' => $this->getLocalizedWeekdays(),
        ];
    }

    /**
     * Ottiene i giorni della settimana localizzati da Carbon.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> 727968c (.)
     * @return array<string>
     */
    protected function getLocalizedWeekdays(): array
    {
        $weekdays = [];
        $monday = Carbon::now()->startOfWeek(Carbon::MONDAY);
<<<<<<< HEAD

=======
        
>>>>>>> 727968c (.)
        for ($i = 0; $i < 7; $i++) {
            /** @phpstan-ignore property.nonObject */
            $weekdays[] = $monday->copy()->addDays($i)->locale(App::getLocale())->shortLocaleDayOfWeek[0];
        }
<<<<<<< HEAD

=======
        
>>>>>>> 727968c (.)
        return $weekdays;
    }

    /**
     * Ottiene i dati per la vista.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> 727968c (.)
     * @return array<string, mixed>
     */
    public function getViewData(): array
    {
        $calendarData = $this->generateCalendarData();
<<<<<<< HEAD

=======
        
>>>>>>> 727968c (.)
        return array_merge(parent::getViewData(), [
            'calendarData' => $calendarData,
            'currentViewMonth' => $this->currentViewMonth,
            'currentValue' => $this->getState(),
            'enabledDates' => $this->getEnabledDates(),
            'statePath' => $this->getStatePath(),
            'monthName' => $calendarData['monthName'],
            'year' => $calendarData['year'],
            'weekdays' => $calendarData['weekdays'],
        ]);
    }
<<<<<<< HEAD
}
=======
} 
>>>>>>> 727968c (.)
