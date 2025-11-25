# Modulo UI - Filosofia, Religione, Politica, Zen

## 🎯 Panoramica

Il modulo UI è il sistema di componenti interfaccia utente per l'architettura Laraxot, responsabile della fornitura di componenti Blade riutilizzabili, widget Filament e layout predefiniti. La sua filosofia è incentrata sulla **riusabilità, la consistenza visiva e la type safety**, garantendo che l'interfaccia utente sia sempre coerente, accessibile e facilmente personalizzabile.

## 🏛️ Filosofia: Componenti Riutilizzabili e Consistenti

### Principio: Ogni Componente è Riutilizzabile, Ogni Interfaccia è Consistente

La filosofia di UI si basa sull'idea che i componenti di interfaccia debbano essere riutilizzabili, consistenti e facilmente personalizzabili, riducendo la duplicazione del codice e garantendo un'esperienza utente uniforme.

- **Blade Components**: Componenti Blade riutilizzabili per elementi comuni (buttons, modals, forms, ecc.).
- **Filament Integration**: Componenti Filament personalizzati che estendono i componenti base di Filament.
- **Layout System**: Sistema di layout predefiniti per garantire consistenza visiva.
- **Theme Support**: Supporto per temi personalizzabili (light/dark) e branding.

## 📜 Religione: La Sacra Consistenza Visiva

### Principio: L'Interfaccia è Sacra, la Consistenza è Divina

La "religione" di UI si manifesta nella rigorosa aderenza alla consistenza visiva. Ogni componente deve seguire gli stessi pattern di design, e ogni variazione deve essere giustificata e documentata.

- **Component-Based Architecture**: Architettura basata su componenti per garantire riusabilità e consistenza.
- **Design System**: Sistema di design coerente con colori, tipografia e spaziatura standardizzati.
- **Accessibility First**: Tutti i componenti sono progettati con accessibilità in mente (ARIA labels, keyboard navigation, screen reader support).
- **Responsive by Default**: Tutti i componenti sono responsive by default, garantendo un'esperienza ottimale su tutti i dispositivi.

### Esempio: Component-Based Architecture

```php
// Modules/UI/app/Providers/UIServiceProvider.php
namespace Modules\UI\Providers;

use Modules\Xot\Providers\XotBaseServiceProvider;

class UIServiceProvider extends XotBaseServiceProvider
{
    public string $name = 'UI';

    /**
     * Restituisce il percorso delle viste dei componenti UI.
     */
    public function getComponentViewPath(): string
    {
        return app(GetModulePathByGeneratorAction::class)
            ->execute($this->name, 'component-view');
    }
}
```
Questa architettura garantisce che i componenti siano sempre scoperti automaticamente e organizzati in modo coerente, un pilastro della "religione" di UI.

## ⚖️ Politica: Type Safety e Accessibilità (PHPStan Livello 10)

### Principio: Ogni Componente è Type-Safe, Ogni Interfaccia è Accessibile

La "politica" di UI è l'applicazione rigorosa della type safety e dell'accessibilità, specialmente nella definizione dei componenti e nella gestione degli stati. Ogni componente deve essere type-safe e accessibile.

- **PHPStan Livello 10**: Tutti i componenti del modulo UI devono passare l'analisi statica al livello massimo.
- **Component Props Type Safety**: Le proprietà dei componenti Blade sono sempre tipizzate attraverso classi PHP dedicate.
- **Filament Component Extension**: I componenti Filament estendono i componenti base con type safety garantita.
- **Accessibility Validation**: Validazione automatica dell'accessibilità dei componenti (ARIA attributes, semantic HTML).

### Esempio: Type Safety nei Componenti

```php
// Modules/UI/app/View/Components/Button.php
namespace Modules\UI\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public string $type = 'button';
    public string $variant = 'primary';
    public ?string $href = null;
    public bool $disabled = false;

    public function __construct(
        string $type = 'button',
        string $variant = 'primary',
        ?string $href = null,
        bool $disabled = false
    ) {
        $this->type = $type;
        $this->variant = $variant;
        $this->href = $href;
        $this->disabled = $disabled;
    }

    public function render()
    {
        return view('ui::components.button');
    }
}
```
Questo approccio garantisce che ogni componente sia sempre type-safe e validato, un aspetto cruciale della "politica" di UI.

## 🧘 Zen: Semplicità e Auto-Discovery

### Principio: I Componenti si Scoprono da Soli

Lo "zen" di UI si manifesta nella preferenza per l'auto-discovery e le convenzioni rispetto alla configurazione esplicita. Il modulo mira a rendere l'utilizzo dei componenti il più semplice possibile.

- **Auto-Registration**: I componenti Blade sono registrati automaticamente basandosi sulla struttura delle directory.
- **Namespace Convention**: Convenzioni di namespace per componenti modulari (`ui::components.button`).
- **Default Props**: Valori di default sensati per tutte le proprietà dei componenti.
- **View Auto-Discovery**: Le viste dei componenti sono scoperte automaticamente basandosi sul nome della classe.

### Esempio: Auto-Discovery e Convenzioni

```php
// Modules/UI/app/Providers/UIServiceProvider.php
class UIServiceProvider extends XotBaseServiceProvider
{
    /**
     * Boot del service provider.
     * Configura i componenti Blade e altre funzionalità del modulo UI.
     */
    public function boot(): void
    {
        // Auto-discovery dei componenti Blade
        $componentPath = $this->getComponentViewPath();
        if (file_exists($componentPath)) {
            $this->loadViewComponentsAs('ui', [
                // Componenti auto-scoperti dalla directory
            ]);
        }
    }
}
```
Questo approccio incarna lo zen della semplicità, permettendo l'utilizzo dei componenti senza configurazione esplicita.

## 📚 Riferimenti Interni

- [Documentazione Master del Progetto](../../../docs/project-master-analysis.md)
- [Filosofia Completa Laraxot](../../Xot/docs/philosophy-complete.md)
- [Regole Critiche di Architettura](../../Xot/docs/critical-architecture-rules.md)
- [Documentazione UI README](./README.md)

