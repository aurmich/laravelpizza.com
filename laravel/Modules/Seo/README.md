# Modulo Seo

## 📋 Panoramica

Il modulo Seo fornisce strumenti avanzati per l'ottimizzazione sui motori di ricerca, gestione meta tags e analisi delle performance SEO dell'applicazione Laravel Pizza.

## 🚀 Installazione

Il modulo è già incluso nel progetto principale. Per verificare lo stato:

```bash
# Verifica se il modulo è attivo
php artisan module:list

# Abilita il modulo se necessario
php artisan module:enable Seo
```

## 🎯 Funzionalità Principali

- **Meta Tags Management**: Gestione automatica e manuale di meta tags
- **Sitemap Generation**: Generazione automatica sitemap XML
- **SEO Analytics**: Monitoraggio performance SEO
- **Structured Data**: Implementazione schema.org JSON-LD
- **Open Graph**: Gestione tags per social media
- **Robots.txt**: Configurazione file robots.txt
- **SEO Audit**: Analisi automatica ottimizzazioni

## 🔧 Configurazione

### Configurazione Base
Il modulo si integra automaticamente con le configurazioni Laravel esistenti:

```php
// config/seo.php (se presente)
return [
    'default_title' => 'Laravel Pizza - Pizzeria Artigianale',
    'default_description' => 'Le migliori pizze artigianali consegnate a casa tua',
    'default_keywords' => 'pizza, consegna, artigianale, napoletana',
];
```

### Configurazioni Avanzate
```php
// Modules/Seo/config/seo.php
return [
    'sitemap' => [
        'enabled' => true,
        'cache_duration' => 3600,
        'urls' => [
            '/' => ['priority' => 1.0, 'changefreq' => 'daily'],
            '/menu' => ['priority' => 0.8, 'changefreq' => 'weekly'],
            '/events' => ['priority' => 0.7, 'changefreq' => 'weekly'],
        ],
    ],
    'analytics' => [
        'enabled' => true,
        'google_search_console' => env('GOOGLE_SEARCH_CONSOLE_KEY'),
    ],
];
```

## 📁 Struttura

```
Modules/Seo/
├── app/
│   ├── Actions/           # Business logic SEO
│   ├── Datas/             # Data objects SEO
│   ├── Filament/          # Admin panel resources
│   ├── Http/
│   │   ├── Controllers/   # SEO controllers
│   │   └── Middleware/    # SEO middleware
│   ├── Models/            # Modelli SEO
│   ├── Providers/         # Service providers
│   └── Services/          # Servizi SEO
├── config/                # Configurazioni SEO
├── database/
│   ├── migrations/        # Tabelle SEO
│   └── seeders/
├── docs/                  # Documentazione
├── resources/
│   └── views/             # Componenti SEO
└── tests/                 # Test suite
```

## 🔗 Dipendenze

- **Xot**: Per base classes e utilities
- **Cms**: Per gestione contenuti SEO-friendly
- **Activity**: Per tracking attività SEO

## 📚 Documentazione Correlata

- [Analisi Metodi Duplicati](./docs/METODI_DUPLICATI_ANALISI.md)
- [Documentazione Tecnica](./docs/README.md)

## 🎯 Esempi Utilizzo

### Meta Tags Dinamici

```php
<?php

namespace Modules\Seo\Services;

use Modules\Seo\Datas\SeoData;

class SeoService
{
    public function generateMetaTags(string $pageType, array $data = []): SeoData
    {
        return match($pageType) {
            'homepage' => SeoData::from([
                'title' => 'Laravel Pizza - Pizzeria Artigianale | Ordina Online',
                'description' => 'Le migliori pizze artigianali consegnate a casa tua. Ingredienti freschi, ricette tradizionali e consegna veloce.',
                'keywords' => 'pizza, consegna, artigianale, napoletana, ordina online',
                'og_image' => asset('images/og-pizza.jpg'),
                'canonical_url' => url('/'),
            ]),
            'menu' => SeoData::from([
                'title' => 'Menu Pizze - Laravel Pizza',
                'description' => 'Scopri il nostro menu completo di pizze artigianali. Margherita, Marinara, Diavola e tante altre specialità.',
                'keywords' => 'menu pizze, margherita, marinara, diavola, specialità',
                'og_image' => asset('images/og-menu.jpg'),
                'canonical_url' => url('/menu'),
            ]),
            default => SeoData::from([
                'title' => config('seo.default_title'),
                'description' => config('seo.default_description'),
                'keywords' => config('seo.default_keywords'),
                'canonical_url' => url()->current(),
            ]),
        };
    }
}
```

### Structured Data JSON-LD

```php
<?php

namespace Modules\Seo\Services;

class StructuredDataService
{
    public function generateRestaurantSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Restaurant',
            'name' => 'Laravel Pizza',
            'description' => 'Pizzeria artigianale con consegna a domicilio',
            'url' => url('/'),
            'telephone' => '+390123456789',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Via Roma 123',
                'addressLocality' => 'Roma',
                'postalCode' => '00100',
                'addressCountry' => 'IT',
            ],
            'servesCuisine' => 'Italian',
            'priceRange' => '€€',
            'openingHours' => [
                'Mo-Su 11:00-23:00',
            ],
            'menu' => url('/menu'),
        ];
    }

    public function generateProductSchema(array $pizza): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $pizza['name'],
            'description' => $pizza['description'],
            'image' => asset($pizza['image']),
            'offers' => [
                '@type' => 'Offer',
                'price' => $pizza['price'],
                'priceCurrency' => 'EUR',
                'availability' => 'https://schema.org/InStock',
            ],
        ];
    }
}
```

### Sitemap Generation

```php
<?php

namespace Modules\Seo\Http\Controllers;

use Illuminate\Http\Response;
use Modules\Seo\Services\SitemapService;

class SitemapController
{
    public function __construct(
        private SitemapService $sitemapService
    ) {}

    public function index(): Response
    {
        $sitemap = $this->sitemapService->generate();

        return response($sitemap, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
```

## 🔧 Comandi Artisan

```bash
# Genera sitemap
php artisan seo:sitemap:generate

# Analizza SEO
php artisan seo:analyze

# Aggiorna meta tags
php artisan seo:meta:update

# Genera robots.txt
php artisan seo:robots:generate
```

## 📊 Monitoring SEO

### Filament Admin Panel
Il modulo fornisce widget Filament per:
- Analisi performance SEO
- Gestione meta tags
- Monitoraggio posizionamento
- Report automatici

### Analytics Integration
Integrazione con:
- Google Search Console
- Google Analytics
- Bing Webmaster Tools
- Altri servizi SEO

## 🐛 Troubleshooting

### Problemi Comuni

1. **Meta tags non visibili**: Verifica configurazione modulo
2. **Sitemap non generata**: Controlla permessi cache
3. **Structured data errors**: Valida JSON-LD con Google Testing Tool

### Debug

```bash
# Verifica configurazione SEO
php artisan config:show seo

# Test sitemap generation
php artisan seo:sitemap:test

# Valida meta tags
php artisan seo:validate
```

## 🔒 Sicurezza

- Validazione input meta tags
- Sanitizzazione contenuti SEO
- Rate limiting per API SEO
- Audit trail completo modifiche

---
**Modulo**: Seo
**Versione**: 1.0
**Status**: ✅ Attivo
**PHPStan**: Level 10
**Documentazione**: Completa