<?php

/**
 * Script per correggere tipi generici negli Exports Xot
 */

$exports = [
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Exports/CollectionExport.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Exports/LazyCollectionExport.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Exports/QueryExport.php',
];

foreach ($exports as $file) {
    if (!file_exists($file)) {
        continue;
    }
    
    $content = file_get_contents($file);
    $originalContent = $content;
    
    // Correggi WithMapping generics
    $content = preg_replace(
        '/implements WithMapping(?!<)/',
        'implements WithMapping<\\Illuminate\\Database\\Eloquent\\Model>',
        $content
    );
    
    // Correggi Collection generics
    $content = preg_replace(
        '/Collection(?!<)/',
        'Collection<int, \\Illuminate\\Database\\Eloquent\\Model>',
        $content
    );
    
    // Correggi LazyCollection generics
    $content = preg_replace(
        '/LazyCollection(?!<)/',
        'LazyCollection<int, \\Illuminate\\Database\\Eloquent\\Model>',
        $content
    );
    
    // Correggi Builder generics
    $content = preg_replace(
        '/Builder(?!<)/',
        'Builder<\\Illuminate\\Database\\Eloquent\\Model>',
        $content
    );
    
    // Correggi Relation generics
    $content = preg_replace(
        '/Relation(?!<)/',
        'Relation<\\Illuminate\\Database\\Eloquent\\Model, \\Illuminate\\Database\\Eloquent\\Model>',
        $content
    );
    
    if ($content !== $originalContent) {
        file_put_contents($file, $content);
        echo "Fixed: " . basename($file) . " -> added generic types\n";
    }
}

echo "Exports generics fixes completed!\n";

