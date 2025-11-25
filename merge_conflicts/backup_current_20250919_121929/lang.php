<?php

declare(strict_types=1);

return [
    /*
<<<<<<< HEAD
     * |--------------------------------------------------------------------------
     * | Configurazione Base Localizzazione
     * |--------------------------------------------------------------------------
     * |
     * | Configurazione principale per il sistema di localizzazione
     * | del modulo Lang. Segue i principi DRY + KISS + SOLID.
     * |
     */
=======
    |--------------------------------------------------------------------------
    | Configurazione Base Localizzazione
    |--------------------------------------------------------------------------
    |
    | Configurazione principale per il sistema di localizzazione
    | del modulo Lang. Segue i principi DRY + KISS + SOLID.
    |
    */
>>>>>>> 8b0b6ac (.)

    'default_locale' => env('APP_LOCALE', 'it'),
    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),
    'available_locales' => ['it', 'en', 'de'],
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Configurazione Cache e Performance
     * |--------------------------------------------------------------------------
     * |
     * | Ottimizzazioni per performance e scalabilità
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Configurazione Cache e Performance
    |--------------------------------------------------------------------------
    |
    | Ottimizzazioni per performance e scalabilità
    |
    */
>>>>>>> 8b0b6ac (.)

    'cache' => [
        'enabled' => env('LANG_CACHE_ENABLED', true),
        'ttl' => env('LANG_CACHE_TTL', 3600), // 1 ora
        'prefix' => 'lang_translations',
        'compression' => env('LANG_CACHE_COMPRESSION', true),
    ],
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Configurazione Validazione
     * |--------------------------------------------------------------------------
     * |
     * | Sistema di validazione e controllo qualità traduzioni
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Configurazione Validazione
    |--------------------------------------------------------------------------
    |
    | Sistema di validazione e controllo qualità traduzioni
    |
    */
>>>>>>> 8b0b6ac (.)

    'validation' => [
        'enabled' => env('LANG_VALIDATION_ENABLED', true),
        'strict_mode' => env('LANG_STRICT_MODE', false),
        'auto_fix' => env('LANG_AUTO_FIX', false),
        'report_missing_keys' => env('LANG_REPORT_MISSING', true),
        'quality_threshold' => env('LANG_QUALITY_THRESHOLD', 95), // %
    ],
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Configurazione Auto-Translation
     * |--------------------------------------------------------------------------
     * |
     * | Integrazione con servizi di traduzione automatica
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Configurazione Auto-Translation
    |--------------------------------------------------------------------------
    |
    | Integrazione con servizi di traduzione automatica
    |
    */
>>>>>>> 8b0b6ac (.)

    'auto_translate' => [
        'enabled' => env('LANG_AUTO_TRANSLATE', false),
        'provider' => env('LANG_TRANSLATION_PROVIDER', 'google'),
        'api_key' => env('LANG_TRANSLATION_API_KEY'),
        'fallback_chain' => [
            'it' => ['en', 'de'],
            'de' => ['en', 'it'],
            'en' => ['it', 'de'],
        ],
        'quality_check' => env('LANG_AUTO_QUALITY_CHECK', true),
    ],
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Configurazione Filament Integration
     * |--------------------------------------------------------------------------
     * |
     * | Integrazione specifica con Filament UI
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Configurazione Filament Integration
    |--------------------------------------------------------------------------
    |
    | Integrazione specifica con Filament UI
    |
    */
>>>>>>> 8b0b6ac (.)

    'filament' => [
        'auto_labels' => env('LANG_FILAMENT_AUTO_LABELS', true),
        'auto_placeholders' => env('LANG_FILAMENT_AUTO_PLACEHOLDERS', true),
        'auto_help_text' => env('LANG_FILAMENT_AUTO_HELP', true),
        'component_prefix' => env('LANG_FILAMENT_PREFIX', ''),
        'fallback_to_key' => env('LANG_FILAMENT_FALLBACK_KEY', false),
    ],
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Configurazione Struttura File
     * |--------------------------------------------------------------------------
     * |
     * | Standardizzazione struttura file traduzioni
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Configurazione Struttura File
    |--------------------------------------------------------------------------
    |
    | Standardizzazione struttura file traduzioni
    |
    */
>>>>>>> 8b0b6ac (.)

    'structure' => [
        'required_files' => [
            'fields.php',
            'actions.php',
            'messages.php',
            'validation.php',
        ],
        'optional_files' => [
            'navigation.php',
            'errors.php',
            'notifications.php',
            'emails.php',
        ],
        'naming_convention' => 'snake_case',
        'array_syntax' => 'short', // [] invece di array()
        'strict_types' => true,
    ],
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Configurazione Debug e Logging
     * |--------------------------------------------------------------------------
     * |
     * | Strumenti per sviluppo e troubleshooting
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Configurazione Debug e Logging
    |--------------------------------------------------------------------------
    |
    | Strumenti per sviluppo e troubleshooting
    |
    */
>>>>>>> 8b0b6ac (.)

    'debug' => [
        'enabled' => env('LANG_DEBUG', false),
        'log_missing_keys' => env('LANG_LOG_MISSING', true),
        'log_performance' => env('LANG_LOG_PERFORMANCE', false),
        'log_channel' => env('LANG_LOG_CHANNEL', 'translations'),
        'show_keys_in_production' => env('LANG_SHOW_KEYS_PROD', false),
    ],
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Configurazione Performance
     * |--------------------------------------------------------------------------
     * |
     * | Ottimizzazioni avanzate per performance
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Configurazione Performance
    |--------------------------------------------------------------------------
    |
    | Ottimizzazioni avanzate per performance
    |
    */
>>>>>>> 8b0b6ac (.)

    'performance' => [
        'lazy_loading' => env('LANG_LAZY_LOADING', true),
        'memory_optimization' => env('LANG_MEMORY_OPT', true),
        'batch_loading' => env('LANG_BATCH_LOADING', true),
        'preload_common_keys' => env('LANG_PRELOAD_COMMON', true),
        'compression_level' => env('LANG_COMPRESSION_LEVEL', 6),
    ],
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Configurazione Sicurezza
     * |--------------------------------------------------------------------------
     * |
     * | Protezioni e validazioni di sicurezza
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Configurazione Sicurezza
    |--------------------------------------------------------------------------
    |
    | Protezioni e validazioni di sicurezza
    |
    */
>>>>>>> 8b0b6ac (.)

    'security' => [
        'validate_file_integrity' => env('LANG_VALIDATE_INTEGRITY', true),
        'max_file_size' => env('LANG_MAX_FILE_SIZE', 1024 * 1024), // 1MB
        'allowed_extensions' => ['php'],
        'scan_for_malicious_code' => env('LANG_SCAN_MALICIOUS', true),
        'rate_limiting' => env('LANG_RATE_LIMITING', true),
    ],
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Configurazione Business Logic
     * |--------------------------------------------------------------------------
     * |
     * | Regole specifiche per logica di business
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Configurazione Business Logic
    |--------------------------------------------------------------------------
    |
    | Regole specifiche per logica di business
    |
    */
>>>>>>> 8b0b6ac (.)

    'business' => [
        'enforce_naming_conventions' => true,
        'require_context_in_keys' => true,
        'validate_business_terms' => true,
        'consistency_check' => true,
        'domain_specific_validation' => true,
    ],
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Configurazione Laraxot Integration
     * |--------------------------------------------------------------------------
     * |
     * | Integrazione specifica con framework Laraxot
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Configurazione Laraxot Integration
    |--------------------------------------------------------------------------
    |
    | Integrazione specifica con framework Laraxot
    |
    */
>>>>>>> 8b0b6ac (.)

    'laraxot' => [
        'module_auto_discovery' => true,
        'shared_translations' => true,
        'cross_module_validation' => true,
        'unified_naming' => true,
        'framework_compliance' => true,
    ],
];
<<<<<<< HEAD
=======

>>>>>>> 8b0b6ac (.)
