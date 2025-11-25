<?php

declare(strict_types=1);

namespace Modules\UI\Filament\Widgets;

<<<<<<< HEAD
use Override;
=======
>>>>>>> 727968c (.)
use Modules\Xot\Filament\Widgets\XotBaseWidget;

/**
 * RedirectWidget - Widget per gestire redirect verso URL specifici.
 *
<<<<<<< HEAD
 * Questo widget è progettato per creare elementi UI (bottoni, link)
 * che reindirizzano l'utente verso URL specifici.
 *
=======
 * Questo widget è progettato per creare elementi UI (bottoni, link) 
 * che reindirizzano l'utente verso URL specifici.
 * 
>>>>>>> 727968c (.)
 * Utilizzo tipico in configurazioni JSON:
 * {
 *     "type": "widget",
 *     "data": {
 *         "view": "pub_theme::components.blocks.widget.simple",
 *         "to": "/admin",
 *         "widget": "Modules\\UI\\Filament\\Widgets\\RedirectWidget"
 *     }
 * }
 */
class RedirectWidget extends XotBaseWidget
{
    /**
     * URL di destinazione per il redirect.
     */
    public string $to = '';

    /**
     * Testo del link/button (opzionale).
     */
    public string $label = '';

    /**
     * Icona da mostrare (opzionale).
     */
    public string $icon = '';

    /**
     * Classe CSS per styling (opzionale).
     */
    public string $class = '';

    /**
     * Determina se aprire in una nuova tab.
     */
    public bool $external = false;

    /**
     * Vista di default per il widget.
     * Può essere sovrascritta dalla configurazione con la chiave 'view'.
     */
    protected string $view = 'ui::filament.widgets.redirect-widget';
<<<<<<< HEAD
=======
    
    
>>>>>>> 727968c (.)

    /**
     * Implementazione richiesta da XotBaseWidget.
     * Per questo widget non abbiamo form, quindi restituiamo array vuoto.
     *
     * @return array<string, mixed>
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> 727968c (.)
    public function getFormSchema(): array
    {
        return [];
    }

    /**
     * Dati da passare alla vista.
     *
     * @return array<string, mixed>
     */
    protected function getViewData(): array
    {
<<<<<<< HEAD
=======
        
>>>>>>> 727968c (.)
        return [
            'to' => $this->to,
            'label' => $this->label ?: 'Vai',
            'icon' => $this->icon,
            'class' => $this->class,
            'external' => $this->external,
        ];
    }

    /**
     * Determina se il widget può essere visualizzato.
     * Per il redirect widget, sempre visibile se ha una destinazione.
     */
    public static function canView(): bool
    {
        return true;
    }
<<<<<<< HEAD
}
=======
} 
>>>>>>> 727968c (.)
