<?php

declare(strict_types=1);

namespace Modules\UI\Filament\Widgets;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
=======
>>>>>>> 727968c (.)
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cookie;
use Modules\Xot\Filament\Widgets\XotBaseWidget;

class DarkModeSwitcherWidget extends XotBaseWidget
{
<<<<<<< HEAD
    public null|array $data = [];
=======
    public ?array $data = [];
>>>>>>> 727968c (.)

    protected string $view = 'ui::filament.widgets.dark-mode-switcher';

    public bool $darkMode = false;

    public function mount(): void
    {
        $this->darkMode = filter_var(request()->cookie('dark_mode', 'false'), FILTER_VALIDATE_BOOLEAN);
    }

    public function toggleDarkMode(): void
    {
<<<<<<< HEAD
        $this->darkMode = !$this->darkMode;
=======
        $this->darkMode = ! $this->darkMode;
>>>>>>> 727968c (.)

        // Set cookie for persistence
        Cookie::queue('dark_mode', $this->darkMode ? 'true' : 'false', 60 * 24 * 30);

        // Dispatch event for frontend to handle theme switching
        $this->dispatch('darkModeUpdated', ['darkMode' => $this->darkMode]);
    }

    /**
     * Schema del form per la configurazione del widget.
     *
<<<<<<< HEAD
     * @return array<int, Component>
     */
    #[Override]
=======
     * @return array<int, \Filament\Schemas\Components\Component>
     */
>>>>>>> 727968c (.)
    public function getFormSchema(): array
    {
        return [];
    }

    public function render(): View
    {
<<<<<<< HEAD
        return view($this->view, [
=======
        return view(static::$view, [
>>>>>>> 727968c (.)
            'darkMode' => $this->darkMode,
        ]);
    }
}
