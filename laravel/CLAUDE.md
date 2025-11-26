# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## ⚠️ CRITICAL RULE - CODE QUALITY VALIDATION ⚠️

**OGNI VOLTA che modifichi un file PHP, DEVI SEMPRE verificarlo con questi strumenti di analisi statica:**

1. **PHPStan a livello 10** - Analisi statica rigorosa
2. **PHPMD** (PHP Mess Detector) - Rilevamento di code smell
3. **PHPInsights** - Analisi di qualità del codice

### Comandi di Verifica

```bash
# PHPStan - Livello 10 (massimo rigore)
vendor/bin/phpstan analyse --level=10 path/to/modified/file.php

# Per moduli con configurazione specifica
cd Modules/NomeModulo
../../vendor/bin/phpstan analyse --configuration=phpstan.neon

# PHPInsights (se disponibile)
php artisan insights path/to/modified/file.php
```

**NON procedere mai con commit o modifiche successive senza aver verificato e risolto tutti gli errori riportati da questi strumenti.**

### Configurazioni Disponibili

- PHPStan: Configurazioni in `Modules/*/phpstan.neon` (livello 10)
- PHPInsights: Configurazioni in `Modules/*/phpinsights.php`

## Project Overview

This is a **modular Laravel application** built using **nwidart/laravel-modules** with **Filament 4** as the admin panel framework. The project follows a custom **Laraxot architecture** that provides base classes and patterns for consistent development across modules.

### Key Architectural Concepts

- **Custom Application Class**: Uses `App\Application` (extends `Illuminate\Foundation\Application`) that overrides `publicPath()` to point to `../public_html/` instead of the default `public/`
- **Module-Based Architecture**: All business logic is organized in self-contained modules under `Modules/`
- **Tenant Configuration System**: Uses `TenantService::getConfig()` and `TenantService::config()` to load tenant-specific configurations from `config/{tenant_name}/` directories
- **Theme System**: Supports themes in `Themes/` directory with views and assets
- **XotData Singleton**: Central configuration object (`Modules\Xot\Datas\XotData`) manages module settings, user/team/tenant classes, and theme paths

## Development Commands

### Setup and Installation
```bash
composer setup              # Full setup: install deps, copy .env, generate key, migrate, build assets
composer install            # Install PHP dependencies
npm install                 # Install Node dependencies
php artisan key:generate    # Generate application key
```

### Development Server
```bash
composer dev                # Runs concurrently: serve, queue, pail logs, and vite dev server
php artisan serve           # Run Laravel development server (standalone)
npm run dev                 # Run Vite development server for hot module replacement
```

### Testing
```bash
composer test               # Run all tests (clears config first)
php artisan test            # Run PHPUnit/Pest tests
php artisan test --filter=TestName  # Run specific test
```

### Building Assets
```bash
npm run build               # Build production assets with Vite
```

### Module Management
```bash
php artisan module:list                          # List all modules
php artisan module:enable ModuleName             # Enable a module
php artisan module:disable ModuleName            # Disable a module
php artisan module:make ModuleName               # Create new module
php artisan module:make-{type} ModuleName Name   # Create specific component in module
```

Module activation is controlled by `modules_statuses.json` in the project root.

## Architecture

### Module Structure

Modules follow this standard structure:
```
Modules/{ModuleName}/
├── app/
│   ├── Filament/         # Filament resources, pages, widgets
│   │   ├── Resources/
│   │   ├── Pages/
│   │   └── Widgets/
│   ├── Models/           # Eloquent models
│   ├── Actions/          # Spatie Queueable Actions
│   ├── Services/         # Service classes
│   ├── Providers/        # Service providers
│   ├── Http/
│   │   └── Controllers/
│   ├── Datas/           # Spatie Laravel Data objects
│   └── Contracts/       # Interfaces
├── config/              # Module configuration
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
├── resources/
│   ├── views/
│   └── assets/
├── routes/
│   ├── web.php
│   └── api.php
├── tests/
├── docs/                # Module documentation
├── composer.json        # Module dependencies (merged via wikimedia/composer-merge-plugin)
└── module.json          # Module metadata
```

### Core Modules

- **Xot**: Foundation module providing base classes, traits, contracts, and utilities. All other modules depend on Xot.
- **Tenant**: Multi-tenancy support with tenant-specific configurations
- **User**: User management, authentication, teams, and memberships
- **UI**: UI components and rendering system
- **Cms**: Content management with Laravel Folio and Livewire Volt
- **Activity**: Activity logging and tracking
- **Media**: Media library management
- **Lang**: Internationalization and translations
- **Notify**: Notifications system
- **Geo**: Geographical data management
- **Gdpr**: GDPR compliance features
- **Job**: Job queue management
- **Seo**: SEO optimization features

### Laraxot Base Class Architecture

**CRITICAL**: This project uses a custom abstraction layer over Filament 4. **NEVER** extend Filament classes directly.

#### Always Extend XotBase Classes

```php
// ❌ WRONG - Never extend Filament classes directly
class MyPage extends ViewRecord {}
class MyWidget extends Widget {}
class MyResource extends Resource {}

// ✅ CORRECT - Always extend XotBase classes
class MyPage extends XotBaseViewRecord {}
class MyWidget extends XotBaseWidget {}
class MyResource extends XotBaseResource {}
```

Available XotBase classes:
- `Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord`
- `Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord`
- `Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord`
- `Modules\Xot\Filament\Resources\Pages\XotBaseListRecords`
- `Modules\Xot\Filament\Pages\XotBasePage`
- `Modules\Xot\Filament\Widgets\XotBaseWidget`
- `Modules\Xot\Filament\Resources\XotBaseResource`

XotBase classes already implement necessary interfaces and traits (HasForms, HasActions, etc.). Do not re-implement them.

#### Namespace Convention

Filament classes use `Modules\{Module}\Filament\...` namespace:

```php
// ✅ CORRECT
namespace Modules\Survey\Filament\Resources\QuestionResource\Pages;

// ❌ WRONG
namespace Modules\Survey\App\Filament\Resources\QuestionResource\Pages;
```

### Patterns and Practices

#### Use Actions Instead of Services

Prefer **Spatie Queueable Actions** over traditional service classes:

```php
// ✅ CORRECT
use Modules\Tenant\Actions\GetTenantNameAction;

$name = app(GetTenantNameAction::class)->execute();

// ❌ WRONG - Avoid traditional service pattern
use Modules\Tenant\Services\SomeService;
```

#### Translation System

**NEVER** hardcode labels, placeholders, or tooltips. Use translation files managed by LangServiceProvider:

```php
// ❌ WRONG
TextInput::make('name')
    ->label('Name')
    ->placeholder('Enter name');

// ✅ CORRECT - translations handled automatically
TextInput::make('name');
```

#### Deprecated Components

- **NEVER** use `BadgeColumn` - use `TextColumn::make()->badge()` instead

#### Filament 4 Schema Pattern

Use `Schema` instead of `Form`:

```php
// ✅ CORRECT - Filament 4
public function form(Schema $schema): Schema
{
    return $schema->components($this->getFormSchema());
}

// ❌ WRONG - Filament 3 pattern
public function form(Form $form): Form
{
    return $form->schema($this->getFormSchema());
}
```

### Tenant Configuration System

Configuration files can be tenant-specific:

```php
// Load tenant-specific config
$value = TenantService::config('key.subkey', $default);

// Get tenant name
$tenantName = TenantService::getName();

// Tenant configs stored in: config/{tenant_name}/
```

### Theme System

Themes are located in `Themes/` with resources in `resources/views/`:

```php
$xotData = XotData::make();
$viewPath = $xotData->getPubThemeViewPath('partial/header');
$assetUrl = $xotData->getPubThemePublicAsset('css/style.css');
```

### XotData Singleton

Central configuration object for module settings:

```php
$xotData = XotData::make(); // Singleton instance

$xotData->getUserClass();         // Get user model class
$xotData->getTeamClass();         // Get team model class
$xotData->getTenantClass();       // Get tenant model class
$xotData->getProfileClass();      // Get profile model class
$xotData->getProfileModel();      // Get current user's profile
$xotData->iAmSuperAdmin();        // Check if current user is super admin
```

## Common Anti-Patterns to Avoid

### DRY Violations

Don't re-implement interfaces or traits already in base classes:

```php
// ❌ WRONG
class MyWidget extends XotBaseWidget implements HasForms
{
    use InteractsWithForms; // Already in XotBaseWidget
}

// ✅ CORRECT
class MyWidget extends XotBaseWidget
{
    // Interfaces and traits already included
}
```

### XotBaseResource Anti-Patterns

When extending `XotBaseResource`:
- **DON'T** include `getTableColumns()` - use separate TableWidget
- **DON'T** include navigation properties in resource
- **DO** implement only `getFormSchema(): array`

### XotBasePage Anti-Patterns

When extending `XotBasePage`:
- **DON'T** include `$navigationIcon`, `$title`, `$navigationLabel`
- **DO** implement `getFormSchema(): array`

## Type Safety and Code Quality

### Mandatory Quality Checks

**EVERY modified PHP file MUST be validated with:**

```bash
# 1. PHPStan Level 10 (MANDATORY)
vendor/bin/phpstan analyse --level=10 path/to/file.php

# 2. PHPMD (MANDATORY)
vendor/bin/phpmd path/to/file.php text cleancode,codesize,controversial,design,naming,unusedcode

# 3. PHPInsights (MANDATORY)
php artisan insights path/to/file.php --no-interaction --min-quality=90 --min-complexity=90 --min-architecture=90 --min-style=90
```

### Code Standards

- Use `declare(strict_types=1);` at the top of all PHP files
- Use type hints for all method parameters and return types
- Use PHPStan-compatible assertions from `Webmozart\Assert\Assert`
- Follow PSR-12 coding standards
- All code must pass PHPStan level 10 without errors
- Maintain minimum 90% quality score in PHPInsights

## Important Files

- `bootstrap/app.php` - Application bootstrapping with custom `App\Application`
- `app/Application.php` - Custom application class with modified public path
- `config/modules.php` - Module system configuration
- `modules_statuses.json` - Module activation status
- `composer.json` - Dependencies with composer-merge-plugin for module composer.json files
- `vite.config.js` - Vite configuration for asset building
- `Modules/Xot/app/Datas/XotData.php` - Central configuration singleton
- `Modules/Xot/docs/` - Comprehensive documentation on architecture and patterns

## Module Documentation

Each module may have a `docs/` directory with specific documentation. The Xot module has extensive documentation including:
- `FILAMENT_4_LARAXOT_RULES.md` - Filament 4 architecture rules
- `CODE_QUALITY_STANDARDS.md` - Code quality standards
- `COMMON_ANTI_PATTERNS.md` - Anti-patterns to avoid
- Various integration guides in `docs/-integration/`

## Routes and Views

- Laravel Folio pages are managed by `FolioVoltServiceProvider` in the Cms module
- Views use Laravel Volt for reactive components
- Routes support localization via `mcamara/laravel-localization`
- Main web routes in `routes/web.php` (currently commented out in favor of Folio)

## Environment

- **Default DB**: SQLite (`database/database.sqlite`)
- **Public Directory**: `../public_html/` (not `public/`)
- **Session Driver**: database
- **Queue**: Supports queue workers (included in `composer dev`)
- **Log Viewer**: Pail (included in `composer dev`)

## Git Workflow

- Main branch: `master`
- Recent commits show integration of Meetup theme and module via git subtrees
