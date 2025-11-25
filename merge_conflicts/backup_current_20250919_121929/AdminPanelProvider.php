<?php

declare(strict_types=1);

namespace Modules\Lang\Providers\Filament;

<<<<<<< HEAD
use Override;
=======
>>>>>>> 8b0b6ac (.)
use LaraZeus\SpatieTranslatable\SpatieTranslatablePlugin;
use Filament\Panel;
use Modules\Xot\Providers\Filament\XotBasePanelProvider;

class AdminPanelProvider extends XotBasePanelProvider
{
    protected string $module = 'Lang';

<<<<<<< HEAD
    #[Override]
    public function panel(Panel $panel): Panel
    {
        $panel = parent::panel($panel);
=======
    public function panel(Panel $panel): Panel
    {
        $panel= parent::panel($panel);
>>>>>>> 8b0b6ac (.)
        // FilamentAsset::register(
        //     [
        //         Css::make('filament-navigation-styles', __DIR__.'/../../resources/dist/plugin.css'),
        //         Js::make('filament-navigation-scripts', __DIR__.'/../../resources/dist/plugin.js'),
        //     ],
        //     'filament-navigation'
        // );

<<<<<<< HEAD
        $spatieLaravelTranslatablePlugin = SpatieTranslatablePlugin::make()->defaultLocales(['en', 'it']);
=======
        $spatieLaravelTranslatablePlugin=SpatieTranslatablePlugin::make()
                ->defaultLocales(['en', 'it']);
>>>>>>> 8b0b6ac (.)
        $panel->plugins([
            $spatieLaravelTranslatablePlugin,
        ]);

        return $panel;
    }
}
