<?php

declare(strict_types=1);
<<<<<<< HEAD

=======
>>>>>>> 3401a6b (.)
/**
 * @see https://github.com/3x1io/filament-themes/blob/main/src/Pages/Themes.php
 */

namespace Modules\Cms\Filament\Pages;

use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\File;
use Modules\Cms\Datas\ThemeData;
use Modules\Tenant\Services\TenantService;
<<<<<<< HEAD
use Webmozart\Assert\Assert;

use function Safe\json_decode;

=======

use function Safe\json_decode;

use Webmozart\Assert\Assert;

>>>>>>> 3401a6b (.)
class Themes extends Page
{
    public array $data = [];

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-paint-brush';

    protected string $view = 'cms::filament.pages.themes';

    protected static string | \UnitEnum | null $navigationGroup = 'Settings';

    public function changePubTheme(string $name): void
    {
        $data = [];
        $data['pub_theme'] = $name;
        TenantService::saveConfig('xra', $data);
        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }

    /*
<<<<<<< HEAD
     * public static function getNavigationGroup(): ?string
     * {
     * return config('filament-themes.group') ?? static::$navigationGroup;
     * }
     */
=======
    public static function getNavigationGroup(): ?string
    {
        return config('filament-themes.group') ?? static::$navigationGroup;
    }
    */
>>>>>>> 3401a6b (.)

    /**
     * @return array[]
     */
    protected function getViewData(): array
    {
<<<<<<< HEAD
        $themes = File::directories(base_path() . str('/Themes')->replace('/', \DIRECTORY_SEPARATOR));
        $data = [];
        if ($themes) {
            foreach ($themes as $key => $item) {
                Assert::string($item, __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
                $filename = $item . DIRECTORY_SEPARATOR . 'theme.json';
                if (!File::exists($filename)) {
=======
        $themes = File::directories(base_path().str('/Themes')->replace('/', \DIRECTORY_SEPARATOR));
        $data = [];
        if ($themes) {
            foreach ($themes as $key => $item) {
                Assert::string($item);
                $filename = $item.DIRECTORY_SEPARATOR.'theme.json';
                if (! File::exists($filename)) {
>>>>>>> 3401a6b (.)
                    $theme_data = ThemeData::from(['name' => basename((string) $item)]);
                    File::put($filename, $theme_data->toJson());
                }
                $info = json_decode(File::get($filename), true);
                $info = ThemeData::from($info)->toArray();
                // $info->image = '#';

                $data[] = [
                    'id' => $key + 1,
                    'path' => $item,
                    'info' => $info,
                ];
            }
        }
        $this->data = $data;

        return ['data' => $data];
    }

    /*
<<<<<<< HEAD
     * protected static function shouldRegisterNavigation(): bool
     * {
     * return auth()->user()->can('page_Themes');
     * }
     *
     *
     * public function mount(): void
     * {
     * abort_unless(auth()->user()->can('page_Themes'), 403);
     * }
     */
=======
    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('page_Themes');
    }


    public function mount(): void
    {
        abort_unless(auth()->user()->can('page_Themes'), 403);
    }
    */
>>>>>>> 3401a6b (.)
}
