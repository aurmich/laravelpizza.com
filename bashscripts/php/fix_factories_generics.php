<?php

/**
 * Script per correggere tipi generici nelle Factory Xot
 */

$factories = [
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/database/factories/CacheFactory.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/database/factories/CacheLockFactory.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/database/factories/ExtraFactory.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/database/factories/FeedFactory.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/database/factories/LogFactory.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/database/factories/PulseAggregateFactory.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/database/factories/PulseEntryFactory.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/database/factories/PulseValueFactory.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/database/factories/SessionFactory.php',
];

foreach ($factories as $file) {
    if (!file_exists($file)) {
        continue;
    }
    
    $content = file_get_contents($file);
    $originalContent = $content;
    
    // Correggi Factory generics
    $content = preg_replace(
        '/extends Factory(?!<)/',
        'extends Factory<\\Illuminate\\Database\\Eloquent\\Model>',
        $content
    );
    
    if ($content !== $originalContent) {
        file_put_contents($file, $content);
        echo "Fixed: " . basename($file) . " -> added generic types\n";
    }
}

echo "Factories generics fixes completed!\n";

