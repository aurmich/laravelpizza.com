<?php

/**
 * Script per correggere tipi generici nei file rimanenti
 */

$files = [
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Datas/ComponentFileData.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Datas/RelationData.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Exceptions/ApplicationError.php',
];

foreach ($files as $file) {
    if (!file_exists($file)) {
        continue;
    }
    
    $content = file_get_contents($file);
    $originalContent = $content;
    
    // Correggi Collection generics
    $content = preg_replace(
        '/Collection(?!<)/',
        'Collection<int, mixed>',
        $content
    );
    
    // Correggi DataCollection generics
    $content = preg_replace(
        '/DataCollection(?!<)/',
        'DataCollection<int, mixed>',
        $content
    );
    
    // Correggi Relation generics
    $content = preg_replace(
        '/Relation(?!<)/',
        'Relation<\\Illuminate\\Database\\Eloquent\\Model, \\Illuminate\\Database\\Eloquent\\Model>',
        $content
    );
    
    // Correggi Arrayable generics
    $content = preg_replace(
        '/Arrayable(?!<)/',
        'Arrayable<int, mixed>',
        $content
    );
    
    if ($content !== $originalContent) {
        file_put_contents($file, $content);
        echo "Fixed: " . basename($file) . " -> added generic types\n";
    }
}

echo "Remaining generics fixes completed!\n";

