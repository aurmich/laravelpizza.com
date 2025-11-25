<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Modules\UI\Filament\Widgets\DarkModeSwitcherWidget;

/**
 * Componente Blade per il Dark Mode Switcher.
 *
 * Wrappa il DarkModeSwitcherWidget per l'uso nei temi tramite sintassi Blade.
 */
class DarkModeSwitcher extends Component
{
    /**
     * Widget associato al componente.
     */
    protected DarkModeSwitcherWidget $widget;

    /**
     * Crea una nuova istanza del componente.
     */
    public function __construct()
    {
<<<<<<< HEAD
        $this->widget = new DarkModeSwitcherWidget();
=======
        $this->widget = new DarkModeSwitcherWidget;
>>>>>>> 727968c (.)
    }

    /**
     * Renderizza il componente.
     */
    public function render(): View
    {
        // Verifica se il widget può essere visualizzato
<<<<<<< HEAD
        if (!DarkModeSwitcherWidget::canView()) {
=======
        if (! DarkModeSwitcherWidget::canView()) {
>>>>>>> 727968c (.)
            return view('ui::components.empty');
        }

        // Ottiene i dati dal widget
<<<<<<< HEAD
        $viewData = ['darkMode' => $this->widget->darkMode];
=======
        $viewData = $this->widget->getViewData();
>>>>>>> 727968c (.)

        return view('ui::filament.widgets.dark-mode-switcher', $viewData);
    }
}
