# Laravel Pizza Project - IFLOW.md

## Project Overview

This is a comprehensive Laravel modular application built with the Laravel Livewire Starter Kit. The project follows a modular architecture using the `nwidart/laravel-modules` package and incorporates modern Laravel features including Filament admin panel, Laravel Volt, and Folio for routing.

### Key Technologies & Features:
- **Laravel 12.x** - Modern PHP framework
- **Laravel Modules** - Modular architecture system
- **Filament** - Admin panel and UI components
- **Livewire Volt** - Declarative component framework
- **Laravel Folio** - File-based routing
- **Tailwind CSS** - CSS framework
- **Vite** - Build tooling
- **Multi-tenant support** - Built-in tenant management
- **Multi-language support** - With localization

## Project Architecture

### Modular Structure
The application is organized into 13 distinct modules:
- **Activity** - Activity logging and tracking
- **Cms** - Content management system
- **Gdpr** - GDPR compliance tools
- **Geo** - Geographic and location services
- **Job** - Job queue management
- **Lang** - Language and localization
- **Media** - Media file management
- **Notify** - Notification system
- **Seo** - SEO optimization tools
- **Tenant** - Multi-tenancy support
- **UI** - User interface components
- **User** - User authentication and authorization
- **Xot** - Core utilities and helpers

### Core Components
- **Xot Module** - Contains core utilities, actions, and helpers used across all modules
- **UI Module** - Houses reusable UI components, layouts and design systems
- **Cms Module** - Provides content management capabilities
- **User Module** - Handles authentication, user management, roles and permissions

## File Structure

```
laravel/
├── app/                    # Main Laravel application
├── bootstrap/              # Framework bootstrap files
├── config/                 # Configuration files
├── database/               # Migrations, factories, seeders
├── Modules/                # Modular components (13 modules)
│   ├── Activity/
│   ├── Cms/
│   ├── Gdpr/
│   ├── Geo/
│   ├── Job/
│   ├── Lang/
│   ├── Media/
│   ├── Notify/
│   ├── Seo/
│   ├── Tenant/
│   ├── UI/
│   ├── User/
│   └── Xot/
├── public_html/            # Public web root (custom path)
├── resources/              # Views, CSS, JS
├── routes/                 # Web and console routes
├── storage/                # Storage and cache
├── themes/                 # Frontend themes
├── composer.json           # PHP dependencies
├── package.json            # Node.js dependencies
└── IFLOW.md               # This documentation
```

## Key Features

### Multi-tenancy
The application supports multi-tenancy with tenant-specific configurations and data isolation.

### Localization
Built-in support for multiple languages with localization capabilities.

### View Rendering System
- Uses a custom view rendering system through `GetViewAction`
- Components like `Blocks` and `Block` for dynamic content rendering
- Theme composition via `ThemeComposer` and `XotComposer`

### Authentication & Authorization
- Laravel Fortify for authentication
- Role and permission management
- Two-factor authentication support

## Building and Running

### Prerequisites
- PHP 8.2+
- Composer
- Node.js and npm
- Database (MySQL, PostgreSQL, or SQLite)

### Setup Commands
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Create environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Build assets
npm run build

# Development server
npm run dev
```

### Development Scripts
- `composer setup` - Complete setup including dependencies, migrations and builds
- `composer dev` - Start development server with concurrent processes for server, queue, logs, and Vite
- `composer test` - Run application tests

### Alternative Development
```bash
# Run development server
php artisan serve

# Run queue worker
php artisan queue:listen

# Build assets for development
npm run dev

# Build assets for production
npm run build
```

## Development Conventions

### Module Development
- Each module follows the same structure and naming conventions
- Modules are activated/disabled via `modules_statuses.json`
- Module providers are automatically registered
- Follow the naming convention: `Modules\\{ModuleName}\\...`

### View Rendering
- Custom view resolution through `GetViewAction`
- Views follow format: `{module}::{path.to.view}`
- Theme composition via composers
- Component-based architecture

### Code Standards
- PSR-4 autoloading
- Strict typing `declare(strict_types=1)`
- Comprehensive error handling
- Type-safe collections and operations

## Error Handling

### Common Issues
1. **View Not Found Errors**: These typically occur when the view resolution system can't find the specified view. Check the module structure and ensure views exist in the correct location.

2. **Module Activation**: Ensure modules are properly activated in `modules_statuses.json`.

3. **Database Migrations**: Run `php artisan migrate` to ensure all modules' migrations are executed.

## Testing

The application uses Pest for testing (Laravel's testing framework). Run tests with:
```bash
composer test
```

## Deployment

The application follows standard Laravel deployment practices:
1. Install PHP and Node dependencies
2. Set up environment configuration
3. Run database migrations
4. Build frontend assets
5. Configure web server to point to `public_html/` directory

## Special Notes

### Custom Public Directory
The application uses a custom public directory (`public_html`) instead of the standard `public` directory, as evidenced by the custom `Application` class in `app/Application.php`.

### View Resolution Logic
The `GetViewAction` in the Xot module handles complex view resolution logic, supporting both public theme views and module-specific views.

### Folio Integration
The application uses Laravel Folio for file-based routing, allowing dynamic route creation based on file structure in the `User/resources/views/pages/` directory.

## Module Relationships

- **Xot** serves as the core utility module, providing common actions and helpers
- **UI** provides the component layer used across all modules
- **Cms** integrates with **UI** and **Xot** for content management
- **Tenant** affects how many other modules function in a multi-tenant environment
- **User** provides authentication services used throughout the application