<?php

declare(strict_types=1);

namespace Modules\Lang\Filament\Widgets;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
=======
>>>>>>> 8b0b6ac (.)
use Exception;
use Log;
use Illuminate\Support\Collection;
use Modules\Lang\Models\Language;
use Modules\Xot\Filament\Widgets\XotBaseWidget;

/**
 * Widget per il cambio di lingua.
 *
 * Fornisce un selettore dropdown per cambiare la lingua dell'interfaccia.
 * Utilizza il sistema di localizzazione di Laravel per gestire le traduzioni.
<<<<<<< HEAD
 *
 * @package Modules\Lang\Filament\Widgets *
 * Fornisce un selettore dropdown per cambiare la lingua dell'interfaccia.
 * Utilizza il sistema di localizzazione di Laravel per gestire le traduzioni.
=======
>>>>>>> 8b0b6ac (.)
 */
class LanguageSwitcherWidget extends XotBaseWidget
{
    /**
     * Vista del widget.
     */
    protected string $view = 'lang::filament.widgets.language-switcher';

    /**
     * Determina se il widget può essere visualizzato.
     */
    public static function canView(): bool
    {
        return true;
    }

    /**
     * Schema del form per la configurazione del widget.
<<<<<<< HEAD
     *      *
     * @return array<int, Component>
     */
    #[Override]
=======
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
>>>>>>> 8b0b6ac (.)
    public function getFormSchema(): array
    {
        return [];
    }

    /**
     * Dati da passare alla vista.
<<<<<<< HEAD
     *      *
=======
     *
>>>>>>> 8b0b6ac (.)
     * @return array<string, mixed>
     */
    protected function getViewData(): array
    {
        return [
            'current_locale' => app()->getLocale(),
            'available_locales' => $this->getAvailableLocales(),
<<<<<<< HEAD
            'widget_id' => 'language-switcher-' . uniqid(),
=======
            'widget_id' => 'language-switcher-'.uniqid(),
>>>>>>> 8b0b6ac (.)
        ];
    }

    /**
<<<<<<< HEAD
     * Metodo pubblico per esporre i dati della vista ad altri componenti.
     *
     * @return array<string, mixed>
     */
    public function exposeViewData(): array
    {
        return $this->getViewData();
    }

    /**
     * Ottiene le lingue disponibili nel sistema.
     *
     * @return Collection<int, array{code: string, name: string, native_name: string, flag: string|null}>
     */
    public function getAvailableLocales(): Collection
=======
     * Ottiene le lingue disponibili nel sistema.
     *
     * @return Collection<int, array{code: string, name: string, native_name: string, flag: string}>
     */
    protected function getAvailableLocales(): Collection
>>>>>>> 8b0b6ac (.)
    {
        // Verifica se il modello Language esiste e ha dati
        if (class_exists(Language::class)) {
            try {
                $languages = Language::where('active', true)
                    ->orderBy('order')
                    ->get(['code', 'name', 'native_name', 'flag']);

                if ($languages->isNotEmpty()) {
<<<<<<< HEAD
                    return $languages->map(fn($language) => [
                        'code' => $language->code,
                        'name' => $language->name,
                        'native_name' => $language->native_name ?? $language->name,
                        'flag' => (string) ($language->flag ?? ''),
                    ]);
=======
                    return $languages->map(function ($language) {
                        return [
                            'code' => $language->code,
                            'name' => $language->name,
                            'native_name' => $language->native_name ?? $language->name,
                            'flag' => $language->flag ?? null,
                        ];
                    });
>>>>>>> 8b0b6ac (.)
                }
            } catch (Exception $e) {
                // Log dell'errore ma continua con il fallback
                Log::warning('Language model query failed', ['error' => $e->getMessage()]);
            }
        }

        // Fallback alle lingue configurate staticamente
        return collect($this->getDefaultLanguages());
    }

    /**
     * Lingue di default se il modello Language non è disponibile.
     *
     * @return array<int, array{code: string, name: string, native_name: string, flag: string|null}>
     */
    protected function getDefaultLanguages(): array
    {
        return [
            [
                'code' => 'it',
                'name' => 'Italian',
                'native_name' => 'Italiano',
                'flag' => '🇮🇹',
            ],
            [
                'code' => 'en',
                'name' => 'English',
                'native_name' => 'English',
                'flag' => '🇬🇧',
            ],
            [
                'code' => 'de',
                'name' => 'German',
                'native_name' => 'Deutsch',
                'flag' => '🇩🇪',
            ],
        ];
    }

    /**
     * Cambia la lingua corrente.
     *
<<<<<<< HEAD
     * @param string $locale Codice della lingua
     * @return void     *
=======
>>>>>>> 8b0b6ac (.)
     * @param  string  $locale  Codice della lingua
     */
    public function changeLanguage(string $locale): void
    {
        if ($this->isValidLocale($locale)) {
            session(['locale' => $locale]);
            app()->setLocale($locale);

            // Redirect per applicare la nuova lingua
            $this->redirect(request()->url());
        }
    }

    /**
     * Verifica se il locale è valido.
<<<<<<< HEAD
     *
     * @param string $locale
     * @return bool     */
    protected function isValidLocale(string $locale): bool
    {
        $availableLocales = $this->getAvailableLocales();
=======
     */
    protected function isValidLocale(string $locale): bool
    {
        $availableLocales = $this->getAvailableLocales();

>>>>>>> 8b0b6ac (.)
        return $availableLocales->contains('code', $locale);
    }

    /**
     * Genera l'URL per una specifica lingua.
     *
<<<<<<< HEAD
     * @param string $locale Codice della lingua     *
=======
>>>>>>> 8b0b6ac (.)
     * @param  string  $locale  Codice della lingua
     * @return string URL con la lingua specificata
     */
    public function getLanguageUrl(string $locale): string
    {
        $currentUrl = request()->url();
        $currentLocale = app()->getLocale();

        // Se l'URL contiene già la lingua corrente, sostituiscila
<<<<<<< HEAD
        if (str_contains($currentUrl, '/' . $currentLocale . '/')) {
            return str_replace('/' . $currentLocale . '/', '/' . $locale . '/', $currentUrl);
        } elseif (str_ends_with($currentUrl, '/' . $currentLocale)) {
            return str_replace('/' . $currentLocale, '/' . $locale, $currentUrl);
=======
        if (strpos($currentUrl, '/'.$currentLocale.'/') !== false) {
            return str_replace('/'.$currentLocale.'/', '/'.$locale.'/', $currentUrl);
        } elseif (str_ends_with($currentUrl, '/'.$currentLocale)) {
            return str_replace('/'.$currentLocale, '/'.$locale, $currentUrl);
>>>>>>> 8b0b6ac (.)
        } else {
            // Aggiunge la lingua all'URL
            $path = request()->getPathInfo();

<<<<<<< HEAD
            return url($locale . ($path === '/' ? '' : $path));
=======
            return url($locale.($path === '/' ? '' : $path));
>>>>>>> 8b0b6ac (.)
        }
    }
}
