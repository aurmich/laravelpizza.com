<?php

/**
 * Script per correggere protected $casts deprecato in Laravel 11+
 */

$files = [
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/app/Models/Settings.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/app/Models/Notification.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/app/Models/OauthAccessToken.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/app/Models/AuthenticationLog.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/app/Models/OauthClient.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/app/Models/Device.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/app/Models/Tenant.php',
];

foreach ($files as $file) {
    if (!file_exists($file)) {
        continue;
    }
    
    $content = file_get_contents($file);
    $originalContent = $content;
    
    // Pattern per trovare protected $casts = [...];
    $pattern = '/\/\*\* @var array<string, string> \*\/\s*protected \$casts = \[([^\]]+)\];/s';
    
    if (preg_match($pattern, $content, $matches)) {
        $castsArray = $matches[1];
        
        // Rimuovi il vecchio protected $casts
        $content = preg_replace($pattern, '', $content);
        
        // Aggiungi il nuovo metodo casts()
        $newCastsMethod = "
    /**
     * Get the attributes that should be cast.
     * 
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [$castsArray
        ];
    }";
        
        // Inserisci il nuovo metodo prima dell'ultima parentesi graffa della classe
        $content = preg_replace('/(\s+)(\})$/m', $newCastsMethod . "\n$1$2", $content);
        
        if ($content !== $originalContent) {
            file_put_contents($file, $content);
            echo "Fixed: " . basename($file) . " -> converted protected \$casts to casts() method\n";
        }
    }
}

echo "Deprecated casts fixes completed!\n";

