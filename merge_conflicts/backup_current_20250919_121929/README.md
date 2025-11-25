# Tema Sixteen - Bootstrap Italia per Laravel/Tailwind
<<<<<<< HEAD
# Tema Sixteen - Documentazione Completa

## Panoramica

Il tema Sixteen è un tema moderno per Laravel che implementa le **Linee Guida di Design per i Servizi Digitali della Pubblica Amministrazione** utilizzando **Tailwind CSS** invece di Bootstrap Italia. Il tema è progettato per garantire accessibilità, usabilità e coerenza visiva in conformità con gli standard italiani, fornendo una migrazione completa da Bootstrap Italia a Tailwind CSS.

## 🚀 Bootstrap Italia to Tailwind Migration

Questa documentazione include una **guida completa alla migrazione** da Bootstrap Italia a Tailwind CSS, con esempi pratici e implementazioni conformi alle linee guida PA:

- **[Guida alla Migrazione Bootstrap Italia → Tailwind](bootstrap-italia-to-tailwind.md)** - Mappatura completa dei componenti
- **[Esempi Pratici Bootstrap Italia](bootstrap-italia-examples.md)** - Implementazioni reali con codice
- **[Componenti Form](components/form-components.md)** - Input, validazione, accessibilità
- **[Componenti Navigazione](components/navigation-components.md)** - Header, breadcrumb, sidebar, footer
- **[Componenti Layout](components/layout-components.md)** - Grid, card, hero, modal, alert

## Caratteristiche Principali

### 🎨 Design System Compliant
- Conformità alle **Linee Guida di Design** della PA italiana
- Implementazione con **Tailwind CSS** per massima flessibilità
- Palette colori semantica e accessibile
- Tipografia ottimizzata per la leggibilità

### 🔧 Tecnologie
- **Tailwind CSS** per lo styling
- **DaisyUI** per componenti avanzati
- **Inter** come font principale
- **Heroicons** per le icone
- **Alpine.js** per interazioni dinamiche

### 📱 Responsive Design
- Mobile-first approach
- Breakpoint ottimizzati per dispositivi PA
- Touch-friendly per tablet e smartphone
- Accessibilità WCAG 2.1 AA

## Struttura del Tema

```
Themes/Sixteen/
├── docs/                    # Documentazione
├── lang/                    # Traduzioni
├── resources/
│   ├── views/              # Template Blade
│   │   ├── auth/           # Pagine autenticazione
│   │   ├── components/     # Componenti riutilizzabili
│   │   ├── filament/       # Componenti Filament
│   │   ├── layouts/        # Layout principali
│   │   └── pages/          # Pagine specifiche
│   ├── css/                # Stili personalizzati
│   └── js/                 # Script JavaScript
├── tailwind.config.js      # Configurazione Tailwind
├── vite.config.js          # Configurazione build
└── theme.json              # Metadati tema
```

## Configurazione Tailwind

Il tema utilizza una configurazione Tailwind avanzata con:

### Colori Semantici
```javascript
colors: {
    primary: colors.blue,      // Azioni principali
    secondary: colors.gray,    // Elementi secondari
    success: colors.green,     // Operazioni positive
    warning: colors.yellow,    // Avvisi
    danger: colors.red,        // Errori e pericoli
    info: colors.blue,         // Informazioni
}
```

### Font System
```javascript
fontFamily: {
    sans: ['Inter var', ...defaultTheme.fontFamily.sans],
}
```

### Dark Mode
```javascript
darkMode: 'class', // Abilitazione dark mode
```

## Componenti Principali

### 1. Layout Base
```blade
<x-sixteen::layout.app>
    <x-slot name="header">
        <!-- Header content -->
    </x-slot>
    
    <x-slot name="sidebar">
        <!-- Sidebar content -->
    </x-slot>
    
    <!-- Main content -->
</x-sixteen::layout.app>
```

### 2. Form Components
```blade
<x-sixteen::form.input
    name="email"
    type="email"
    label="Indirizzo Email"
    placeholder="Inserisci la tua email"
    required
/>

<x-sixteen::form.select
    name="provincia"
    label="Provincia"
    :options="$province"
    placeholder="Seleziona una provincia"
/>
```

### 3. Alert Components
```blade
<x-sixteen::alert.success>
    Operazione completata con successo
</x-sixteen::alert.success>

<x-sixteen::alert.warning>
    Attenzione: alcuni dati potrebbero essere incompleti
</x-sixteen::alert.warning>

<x-sixteen::alert.error>
    Si è verificato un errore durante l'operazione
</x-sixteen::alert.error>
```

### 4. Button Components
```blade
<x-sixteen::button.primary>
    Conferma Operazione
</x-sixteen::button.primary>

<x-sixteen::button.secondary>
    Annulla
</x-sixteen::button.secondary>

<x-sixteen::button.danger>
    Elimina
</x-sixteen::button.danger>
```

## Integrazione con Filament

### Admin Panel Provider
```php
use Filament\Panel;
use Themes\Sixteen\Providers\SixteenPanelProvider;

class AdminPanelProvider extends SixteenPanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->defaultTheme('sixteen')
            ->brandName('Nome Applicazione')
            ->favicon(asset('images/favicon.ico'))
            ->navigationGroups([
                'Gestione Utenti',
                'Configurazione',
                'Report',
            ]);
=======

## 🎯 Panoramica del Progetto

Il tema Sixteen è un'implementazione completa delle **Linee Guida AGID per il Design della PA Italiana** utilizzando **Laravel**, **Filament** e **Tailwind CSS**. Il tema fornisce una migrazione moderna da Bootstrap Italia, mantenendo la piena conformità alle specifiche AGID con un'architettura più flessibile e performante.

## 📊 Stato Implementazione AGID

### 📈 Compliance Generale
- **Componenti Bootstrap Italia**: 16/54+ implementati (30%)
- **Accessibilità**: WCAG 2.1 AA parziale
- **Design System**: Colori e tipografia base
- **Requisiti Legali**: In implementazione

### 📋 Documentazione Aggiornata
- **[Analisi Compliance AGID](agid-compliance-analysis.md)** - Analisi completa requisiti
- **[Roadmap Componenti Mancanti](missing-components-roadmap.md)** - Piano implementazione 38+ componenti
- **[Stato Componenti](components-status.md)** - Stato dettagliato implementazione

## 🏛️ Conformità PA Italiana

### Requisiti AGID Soddisfatti
- ✅ **Design System**: Colori, tipografia, spaziature conformi
- ✅ **Accessibilità**: WCAG 2.1 AA con skiplinks e navigation
- ✅ **Responsive**: Mobile-first, touch-friendly
- ✅ **Multilingual**: Supporto italiano/inglese
- ✅ **Performance**: Ottimizzato per dispositivi PA

### Requisiti AGID Mancanti  
- ❌ **SPID Authentication**: Componente login SPID
- ❌ **PagoPA Payments**: Integrazione pagamenti PA
- ❌ **Complete Forms**: Date/time pickers, validazione avanzata
- ❌ **Icon System**: Libreria completa SVG Bootstrap Italia

## 🚀 Avvio Rapido

### Installazione
```bash
# Clone del tema
cd themes/
git clone [repository-url] Sixteen

# Installazione dipendenze
cd Sixteen
npm install
composer install

# Build assets
npm run build
```

### Configurazione Laravel
```php
// config/app.php
'providers' => [
    Themes\Sixteen\Providers\SixteenServiceProvider::class,
],
```

### Configurazione Filament
```php
// app/Providers/AdminPanelProvider.php
public function panel(Panel $panel): Panel
{
    return $panel
        ->viteTheme('themes/sixteen/resources/css/app.css')
        ->theme('sixteen');
}
```

## 📁 Struttura del Progetto

```
Themes/Sixteen/
├── docs/                           # 📚 Documentazione completa
│   ├── agid-bootstrap-italia-gap-analysis.md  # Gap analysis AGID
│   ├── bootstrap-italia-compliance-analysis.md # Stato compliance
│   ├── components-status.md        # Stato componenti
│   └── index.md                    # Indice documentazione
├── resources/views/components/
│   └── bootstrap-italia/           # 🎨 Componenti AGID
│       ├── alert.blade.php         # ✅ Messaggi di stato
│       ├── badge.blade.php         # ✅ Indicatori stato
│       ├── breadcrumb.blade.php    # ✅ Navigazione breadcrumb
│       ├── button.blade.php        # ✅ Pulsanti PA-compliant
│       ├── card.blade.php          # ✅ Contenitori contenuto
│       ├── carousel.blade.php      # ✅ Slider contenuti
│       ├── cookiebar.blade.php     # ✅ GDPR compliance
│       ├── footer.blade.php        # ✅ Piè di pagina PA
│       ├── header-main.blade.php   # ✅ Header principale
│       ├── header-slim.blade.php   # ✅ Barra istituzionale
│       ├── hero.blade.php          # ✅ Sezioni hero
│       ├── megamenu.blade.php      # ✅ Menu complessi
│       ├── notification.blade.php  # ✅ Notifiche toast
│       ├── progress.blade.php      # ✅ Barre progresso
│       ├── radio.blade.php         # ✅ Radio button
│       ├── rating.blade.php        # ✅ Sistema valutazioni
│       ├── select.blade.php        # ✅ Dropdown selezione
│       ├── sidebar.blade.php       # ✅ Navigazione laterale
│       ├── skiplinks.blade.php     # ✅ Accessibilità WCAG
│       ├── tabs.blade.php          # ✅ Interfacce a schede
│       ├── toggle.blade.php        # ✅ Switch controlli
│       └── upload.blade.php        # ✅ Caricamento file
├── tailwind.config.js              # 🎨 Configurazione Tailwind
├── vite.config.js                  # ⚡ Build configuration
└── package.json                    # 📦 Dipendenze NPM
```

## 🎨 Sistema di Design

### Colori AGID Bootstrap Italia
```javascript
// Palette colori PA Italiana implementata in Tailwind
colors: {
    'italia-blue': {
        50: '#E3F2FD',
        500: '#0066CC',  // Primary PA blue
        900: '#003D7A'
    },
    'italia-green': {
        50: '#E8F5E8', 
        500: '#00B373', // Success green
        900: '#007A4F'
    },
    'italia-red': {
        50: '#FFEBEE',
        500: '#D9364F', // Error red  
        900: '#B71C1C'
>>>>>>> 90b9679 (.)
    }
}
```

<<<<<<< HEAD
### Custom Components
```php
use Filament\Forms\Components\Section;

Section::make('Dati Personali')
    ->schema([
        // Form fields
    ])
    ->columns(2)
    ->collapsible();
```

## Accessibilità

### WCAG 2.1 AA Compliance
- Contrasto colori ≥ 4.5:1 per testo normale
- Contrasto colori ≥ 3:1 per testo grande
- Focus visibile su tutti gli elementi interattivi
- Navigazione da tastiera completa
- Testo alternativo per immagini
- Struttura semantica corretta

### Screen Reader Support
```blade
<!-- Esempio di label accessibile -->
<label for="email" class="sr-only">
    Indirizzo Email
</label>
<input 
    id="email"
    type="email"
    aria-describedby="email-help"
    aria-required="true"
/>
<div id="email-help" class="text-sm text-gray-600">
    Inserisci un indirizzo email valido
</div>
```

## Best Practices

### 1. Naming Convention
- Utilizzare nomi descrittivi per le classi
- Seguire la convenzione BEM per CSS custom
- Mantenere coerenza nei nomi dei componenti

### 2. Performance
- Utilizzare Tailwind JIT per build ottimizzate
- Minimizzare CSS custom
- Lazy loading per componenti pesanti

### 3. Responsive Design
```blade
<!-- Mobile-first approach -->
<div class="w-full md:w-1/2 lg:w-1/3">
    <!-- Content -->
</div>

<!-- Touch-friendly buttons -->
<button class="min-h-[44px] px-4 py-2">
    <!-- Button content -->
</button>
```

### 4. Internationalization
```blade
<!-- Utilizzare sempre le traduzioni -->
<h1>{{ __('sixteen::pages.home.title') }}</h1>
<p>{{ __('sixteen::pages.home.description') }}</p>
```

## Personalizzazione

### Variabili CSS Custom
### Tipografia PA Compliant
```css
:root {
    --sixteen-primary: #0066cc;
    --sixteen-secondary: #666666;
    --sixteen-success: #28a745;
    --sixteen-warning: #ffc107;
    --sixteen-danger: #dc3545;
}
```

### Override Componenti
```blade
{{-- Override di un componente --}}
@component('sixteen::components.button', ['variant' => 'custom'])
    Testo Personalizzato
@endcomponent
```

## Testing

### Test Visivi
```php
// Test per componenti del tema
public function test_button_component_renders_correctly()
{
    $this->blade('<x-sixteen::button.primary>Test</x-sixteen::button.primary>')
        ->assertSee('Test')
        ->assertSee('bg-blue-600');
}
```

### Test di Accessibilità
```php
// Test per compliance WCAG
public function test_form_has_proper_labels()
{
    $this->get('/contact')
        ->assertSee('for="email"')
        ->assertSee('aria-required="true"');
}
```

## Deployment

### Build Process
```bash
# Installazione dipendenze
npm install

# Build per produzione
npm run build

# Build con ottimizzazioni
npm run build -- --minify
```

### Configurazione Server
```nginx
# Nginx configuration per asset statici
location /themes/sixteen {
    alias /path/to/themes/sixteen/public;
    expires 1y;
    add_header Cache-Control "public, immutable";
}
```

## Troubleshooting

### Problemi Comuni

1. **Stili non caricati**
   - Verificare che Vite sia configurato correttamente
   - Controllare i path degli asset

2. **Componenti non trovati**
   - Verificare il namespace del tema
   - Controllare la registrazione nel service provider

3. **Dark mode non funziona**
   - Verificare la classe 'dark' sul tag html
   - Controllare la configurazione Tailwind

### Debug
```bash
# Verificare build Tailwind
npx tailwindcss --config tailwind.config.js --input input.css --output output.css

# Analizzare bundle
npm run build -- --analyze
```

## Contribuire

### Guidelines per Contributi
1. Seguire le convenzioni di coding
2. Aggiungere test per nuove funzionalità
3. Documentare le modifiche
4. Verificare accessibilità

### Struttura Pull Request
- Descrizione chiara delle modifiche
- Screenshot per cambiamenti visivi
- Test unitari e di integrazione
- Documentazione aggiornata

## Riferimenti

- [Linee Guida Design PA](https://designers.italia.it/)
- [Bootstrap Italia](https://italia.github.io/bootstrap-italia/)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [WCAG 2.1 Guidelines](https://www.w3.org/WAI/WCAG21/quickref/)

---

**Versione**: 1.0.0  
**Ultimo aggiornamento**: Gennaio 2025  
**Compatibilità**: Laravel 10+, Filament 3.x, Tailwind CSS 3.x 
=======
### Tipografia PA Compliant
```css
/* Font system conformi alle linee guida */
font-family: {
    'sans': ['Inter var', 'system-ui', 'sans-serif'],
    'serif': ['Lora', 'Georgia', 'serif'],
    'mono': ['Roboto Mono', 'monospace']
}
```

## 🔧 Utilizzo Componenti

### Header PA Standard
```blade
<x-bootstrap-italia.header-slim
    :institution="'Comune di Roma'"
    :links="[
        ['url' => '#', 'text' => 'Amministrazione Trasparente'],
        ['url' => '#', 'text' => 'URP']
    ]"
/>

<x-bootstrap-italia.header-main
    :site-name="'Sito Comunale'"
    :tagline="'Servizi digitali per i cittadini'"
    :navigation="$mainNavigation"
    show-search
/>
```

### Form PA Compliant
```blade
<form class="space-y-6">
    <x-bootstrap-italia.select
        name="provincia"
        label="Provincia di residenza"
        :options="$province"
        placeholder="Seleziona provincia"
        required
    />
    
    <x-bootstrap-italia.radio
        name="servizio"
        label="Tipo di servizio richiesto"
        :options="[
            'certificati' => 'Certificati anagrafici',
            'tributi' => 'Tributi e pagamenti',
            'pratiche' => 'Pratiche edilizie'
        ]"
        required
    />
    
    <x-bootstrap-italia.upload
        name="documenti"
        label="Documenti allegati"
        accept=".pdf,.doc,.docx"
        multiple
    />
</form>
```

### Notifiche e Feedback
```blade
{{-- Notifica successo --}}
<x-bootstrap-italia.notification
    type="success"
    title="Richiesta inviata"
    message="La tua richiesta è stata inviata correttamente"
    dismissible
/>

{{-- Progress indicator per processi lunghi --}}
<x-bootstrap-italia.progress-indicators
    :steps="[
        'Compilazione dati',
        'Verifica documenti', 
        'Pagamento',
        'Conferma'
    ]"
    :current-step="2"
/>
```

### Accessibilità Built-in
```blade
{{-- Skiplinks per navigazione da tastiera --}}
<x-bootstrap-italia.skiplinks
    :links="[
        '#main-content' => 'Vai al contenuto principale',
        '#main-navigation' => 'Vai al menu principale',
        '#footer' => 'Vai al footer'
    ]"
/>
```

## ♿ Accessibilità WCAG 2.1 AA

### Funzionalità Implementate
- ✅ **Skiplinks**: Navigazione rapida da tastiera
- ✅ **Contrasto Colori**: Rapporto ≥ 4.5:1 per testo normale
- ✅ **Focus Visibile**: Indicatori focus chiari su tutti gli elementi interattivi  
- ✅ **Markup Semantico**: Struttura HTML corretta con landmark ARIA
- ✅ **Label Accessibili**: Tutti i form field hanno label associate
- ✅ **ARIA Attributes**: Supporto completo per screen reader

### Test di Accessibilità
```bash
# Test automatici con axe-core
npm run test:a11y

# Audit manuale con screen reader
# - NVDA (Windows)
# - VoiceOver (macOS)  
# - Orca (Linux)
```

## 📈 Roadmap Sviluppo

### 🚨 Priorità CRITICA (Prossime 2-3 settimane)
1. **Dropdown Component** - Essenziale per navigazione e form
2. **Pagination Component** - Richiesto per dataset PA
3. **SPID Integration** - Obbligatorio per autenticazione PA
4. **Form completi** - Date/time picker, autocomplete

### 🔥 Priorità ALTA (1-2 mesi)  
1. **PagoPA Integration** - Pagamenti PA
2. **Tooltip/Popover** - UX e accessibilità
3. **Steppers** - Processi multi-step
4. **Complete Icon System** - Libreria SVG Bootstrap Italia

### 📈 Priorità MEDIA (2-3 mesi)
1. **Timeline Component** - Visualizzazione processi
2. **Advanced UX** - Callout, Collapse, Avatar
3. **Performance Optimization** - Bundle size, lazy loading
4. **Documentation** - Guide complete utilizzo

## 🧪 Testing e Qualità

### Test Automatici
```bash
# Test componenti Laravel
php artisan test --filter=SixteenTheme

# Test accessibilità  
npm run test:a11y

# Test performance
npm run lighthouse
```

### Metriche Qualità Target
- **Accessibilità**: 100% WCAG 2.1 AA
- **Performance**: Lighthouse Score > 90
- **Bundle Size**: CSS < 300KB, JS < 200KB
- **Coverage**: Test coverage > 80%

## 📚 Documentazione Completa

### Guide Specializzate
- **[📊 Stato Componenti](components-status.md)** - Inventario completo implementazione
- **[🔍 Gap Analysis AGID](agid-bootstrap-italia-gap-analysis.md)** - Analisi conformità PA
- **[🔧 Bootstrap Italia → Tailwind](bootstrap-italia-to-tailwind.md)** - Guida migrazione
- **[📋 Indice Completo](index.md)** - Navigazione documentazione

### Risorse Esterne
- [Bootstrap Italia Documentation](https://italia.github.io/bootstrap-italia/docs/)
- [AGID Design Guidelines](https://www.agid.gov.it/it/argomenti/linee-guida-design-pa)  
- [Design Comuni Documentation](https://docs.italia.it/italia/designers-italia/design-comuni-docs/)
- [WCAG 2.1 Guidelines](https://www.w3.org/WAI/WCAG21/quickref/)

## 🤝 Contribuire

### Come Contribuire
1. **Fork** del repository
2. **Create feature branch** (`git checkout -b feature/nuovo-componente`)
3. **Implementa** seguendo le linee guida AGID
4. **Testa** accessibilità e performance
5. **Documenta** le modificare
6. **Submit Pull Request**

### Guidelines Sviluppo
- Seguire convenzioni nomenclatura esistenti
- Implementare test automatici per nuovi componenti
- Verificare conformità WCAG 2.1 AA
- Documentare API e utilizzo componenti
- Ottimizzare per performance

---

## 🏅 Status Badge

![AGID Compliance](https://img.shields.io/badge/AGID-48%25%20Compliant-yellow)
![WCAG 2.1](https://img.shields.io/badge/WCAG%202.1-AA-green)
![Laravel](https://img.shields.io/badge/Laravel-12+-red)
![Tailwind](https://img.shields.io/badge/Tailwind-3.4+-blue)

**Versione**: 2.0.0  
**Ultimo aggiornamento**: Settembre 1, 2025  
**Mantenuto da**: Team Bootstrap Italia Migration  
**Licenza**: MIT
>>>>>>> 90b9679 (.)
