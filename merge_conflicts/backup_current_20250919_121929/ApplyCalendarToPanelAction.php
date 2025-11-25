<?php

declare(strict_types=1);

namespace Modules\UI\Actions\Panel;

use Filament\Panel;
use Modules\Xot\Datas\XotData;
use Modules\Xot\Datas\MetatagData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Config;
<<<<<<< HEAD
use Illuminate\Support\Facades\Log;
use Spatie\QueueableAction\QueueableAction;
use Modules\User\Filament\Pages\Tenancy\RegisterTenant;
use Modules\User\Filament\Pages\Tenancy\EditTenantProfile;

/**
 * Action per applicare il calendario al panel Filament.
 * NOTA: Temporaneamente disabilitato per migrazione a Filament v4.
 * Il pacchetto Saade\FilamentFullCalendar non è ancora compatibile con Filament v4.
 */
=======
use Spatie\QueueableAction\QueueableAction;
use Modules\User\Filament\Pages\Tenancy\RegisterTenant;
use Modules\User\Filament\Pages\Tenancy\EditTenantProfile;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;

>>>>>>> 727968c (.)
class ApplyCalendarToPanelAction
{
    use QueueableAction;

    public function execute(Panel &$panel): Panel
    {
<<<<<<< HEAD
        // TODO: Reimplementare quando sarà disponibile un pacchetto FullCalendar compatibile con Filament v4
        // Per ora ritorniamo il panel senza modifiche per evitare errori
        
        // Log per debug
        if (config('app.debug')) {
            Log::info('ApplyCalendarToPanelAction: FullCalendar temporaneamente disabilitato per Filament v4');
        }

=======
        $timezone = Config::string('fullcalendar.localization.timezone', 'Europe/Rome');
        $locale = Config::string('fullcalendar.localization.locale', 'it');
        $calendarPlugin = FilamentFullCalendarPlugin::make()
        ->selectable(true)
        ->editable(true)
        ->timezone($timezone)
        ->locale($locale)
        ->plugins([
            'dayGrid',
            'timeGrid',
            'list',
            'interaction',
            'multiMonth',
            //'scrollGrid',//premium
        ]);

        // Aggiungi licenza scheduler solo se presente e valida
        $licenseKey = config('fullcalendar.scheduler_license_key');
        if ($licenseKey && is_string($licenseKey) && !empty(trim($licenseKey))) {
            $calendarPlugin->schedulerLicenseKey($licenseKey);
        }

        $panel->plugin($calendarPlugin);

>>>>>>> 727968c (.)
        return $panel;
    }
}
