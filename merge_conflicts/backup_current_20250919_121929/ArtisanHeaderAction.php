<?php

/**
 * @see https://coderflex.com/blog/create-advanced-filters-with-filament
 */

declare(strict_types=1);

namespace Modules\Xot\Filament\Actions\Header;

// Header actions must be an instance of Filament\Actions\Action, or Filament\Actions\ActionGroup.
// use Filament\Tables\Actions\Action;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Artisan;
use Webmozart\Assert\Assert;

class ArtisanHeaderAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->translateLabel()
<<<<<<< HEAD
            
=======

            // 
>>>>>>> f1d4085 (.)
            // ->tooltip(__('xot::actions.export_xls'))

            // ->icon('heroicon-o-cloud-arrow-down')
            // ->icon('fas-file-excel')
            // ->icon('heroicon-o-arrow-down-tray')
            ->action(function () {
                Assert::string($cmd = $this->getName());
                Artisan::call($cmd);
                $output = Artisan::output();
                Notification::make()
                    ->title('Executed successfully')
                    ->success()
                    ->body($output)
                    ->persistent();
            });
    }

<<<<<<< HEAD
    public static function getDefaultName(): null|string
=======
    public static function getDefaultName(): ?string
>>>>>>> f1d4085 (.)
    {
        return 'artisan_action';
    }
}
