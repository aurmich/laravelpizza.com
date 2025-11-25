<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Widgets;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
use Error;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Modules\SaluteOra\Models\Appointment;
use Modules\Xot\Contracts\StateContract;
use Modules\Xot\Filament\Widgets\XotBaseWidget;
use Webmozart\Assert\Assert;

=======
use Error;
use Illuminate\Support\Str;
use Webmozart\Assert\Assert;

use Illuminate\Support\Facades\Cache;
use Modules\Xot\Contracts\StateContract;
use Modules\SaluteOra\Models\Appointment;
use Modules\Xot\Filament\Widgets\XotBaseWidget;

>>>>>>> f1d4085 (.)
/**
 * Widget per la panoramica degli appuntamenti per stato.
 * Mostra statistiche compatte degli appuntamenti raggruppati per stato.
 */
class StateOverviewWidget extends XotBaseWidget
{
    /**
     * Vista del widget.
     */
    protected string $view = 'xot::filament.widgets.state-overview';
<<<<<<< HEAD

=======
    
>>>>>>> f1d4085 (.)
    /**
     * Titolo del widget.
     */
    public string $title = '';
<<<<<<< HEAD

=======
    
>>>>>>> f1d4085 (.)
    /**
     * Occupa tutta la larghezza disponibile.
     */
    protected int|string|array $columnSpan = 'full';
<<<<<<< HEAD

    /**
     * Intervallo di polling disabilitato per performance.
     */
    protected static null|string $pollingInterval = null;
=======
    
    /**
     * Intervallo di polling disabilitato per performance.
     */
    protected static ?string $pollingInterval = null;


>>>>>>> f1d4085 (.)

    public string $stateClass;
    public string $model;

<<<<<<< HEAD
    public string $cacheKey = '';

    /**
     * Schema del form (vuoto per questo widget).
     *
     * @return array<int|string, Component>
     */
    #[Override]
=======
    public string $cacheKey='';
    /**
     * Schema del form (vuoto per questo widget).
     *
     * @return array<int|string, \Filament\Schemas\Components\Component>
     */
>>>>>>> f1d4085 (.)
    public function getFormSchema(): array
    {
        return [];
    }
<<<<<<< HEAD

=======
    
>>>>>>> f1d4085 (.)
    /**
     * Dati da passare alla vista.
     *
     * @return array<string, mixed>
     */
    protected function getViewData(): array
    {
<<<<<<< HEAD
=======
        
>>>>>>> f1d4085 (.)
        return [
            'states' => $this->getStates(),
            //'title' => $this->getWidgetTitle(),
        ];
    }
<<<<<<< HEAD

    protected function getCacheKey(): string
    {
        try {
            $cacheKey = 'states-' . class_basename($this->model) . '-' . class_basename($this->stateClass);
            $cacheKey = Str::slug($cacheKey);
            $this->cacheKey = $cacheKey;
            return $cacheKey;
        } catch (Error $e) {
            if ($this->cacheKey === '') {
=======
    
    


    protected function getCacheKey(): string
    {
        try{
            $cacheKey = 'states-' . class_basename($this->model).'-'.class_basename($this->stateClass);
            $cacheKey = Str::slug($cacheKey);
            $this->cacheKey = $cacheKey;
            return $cacheKey;
        }catch(Error $e){
            if($this->cacheKey==''){
>>>>>>> f1d4085 (.)
                $this->cacheKey = Str::uuid()->toString();
            }
            return $this->cacheKey;
        }
    }
<<<<<<< HEAD

=======
    
>>>>>>> f1d4085 (.)
    /**
     * Ottiene gli stati degli appuntamenti con statistiche.
     *
     * @return array<int, array<string, mixed>>
     */
    protected function getStates(): array
    {
<<<<<<< HEAD
        $res = Cache::remember($this->getCacheKey(), now()->addMinutes(5), $this->calculateStates(...));

        Assert::isArray($res);
        return $res;
    }

=======
       
        
        $res= Cache::remember(
            $this->getCacheKey(),
            now()->addMinutes(5),
            fn () => $this->calculateStates()
        );

        Assert::isArray($res);
        return $res;
        
    }
    
>>>>>>> f1d4085 (.)
    /**
     * Calcola le statistiche degli stati degli appuntamenti.
     *
     * @return array<int, array<string, mixed>>
     */
    protected function calculateStates(): array
    {
        $states = [];
<<<<<<< HEAD

        $modelInstance = app($this->model);

        $stateMapping = $this->stateClass::getStateMapping()->toArray();

        foreach ($stateMapping as $name => $stateClass) {
            $state = new $stateClass($modelInstance);
            Assert::isInstanceOf($state, StateContract::class);
            $states[] = [
                'name' => $name,
                'label' => $state->label(),
                'icon' => $this->cleanIconName($state->icon()),
                'color' => $state->bgColor(),
                'count' => $this->getCountForState($name),
            ];
        }

        return $states;
    }

=======
        
        
        $modelInstance = app($this->model);
        
        $stateMapping = $this->stateClass::getStateMapping()->toArray();
        
        foreach ($stateMapping as $name => $stateClass) {
           
                
                $state = new $stateClass($modelInstance);
                Assert::isInstanceOf($state, StateContract::class);                
                $states[] = [
                    'name' => $name,
                    'label' => $state->label(),
                    'icon' => $this->cleanIconName($state->icon()),
                    'color' => $state->bgColor(),
                    'count' => $this->getCountForState($name),
                ];
           
        }
        
        return $states;
    }
    
>>>>>>> f1d4085 (.)
    /**
     * Ottiene il conteggio degli appuntamenti per uno stato specifico.
     * IMPORTANTE: Mostra TUTTI gli appuntamenti, non filtrati per utente.
     * Questo è un widget di panoramica generale per dashboard amministrativa.
     */
    protected function getCountForState(string $stateName): int
    {
        return $this->model::where('state', $stateName)->count();
    }
<<<<<<< HEAD

=======
    
>>>>>>> f1d4085 (.)
    /**
     * Pulisce il nome dell'icona rimuovendo prefissi non necessari.
     */
    protected function cleanIconName(string $iconName): string
    {
        // Rimuove prefissi comuni come 'heroicon-o-' se presenti
        return str_replace(['heroicon-o-', 'heroicon-s-'], '', $iconName);
<<<<<<< HEAD
=======
        
>>>>>>> f1d4085 (.)
    }
}
