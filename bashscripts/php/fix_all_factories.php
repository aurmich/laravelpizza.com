<?php

/**
 * Script per correggere tutte le Factory rimuovendo la sintassi generica non valida
 */

$factoryDir = '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/database/factories/';
$files = glob($factoryDir . '*.php');

foreach ($files as $file) {
    $content = file_get_contents($file);
    $originalContent = $content;
    
    // Rimuovi sintassi generica non valida dalle classi
    $content = preg_replace('/class (\w+Factory) extends Factory<[^>]+>/', 'class $1 extends Factory', $content);
    
    if ($content !== $originalContent) {
        file_put_contents($file, $content);
        echo "Fixed: " . basename($file) . " -> removed invalid generic syntax\n";
    }
}

// Correggi anche le Factory di Xot
$xotFactoryDir = '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/database/factories/';
if (is_dir($xotFactoryDir)) {
    $files = glob($xotFactoryDir . '*.php');
    
    foreach ($files as $file) {
        $content = file_get_contents($file);
        $originalContent = $content;
        
        // Rimuovi sintassi generica non valida dalle classi
        $content = preg_replace('/class (\w+Factory) extends Factory<[^>]+>/', 'class $1 extends Factory', $content);
        
        if ($content !== $originalContent) {
            file_put_contents($file, $content);
            echo "Fixed: " . basename($file) . " -> removed invalid generic syntax\n";
        }
    }
}

echo "All Factory fixes completed!\n";

