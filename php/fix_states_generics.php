<?php

/**
 * Script per correggere tipi generici negli States Xot
 */

$states = [
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/States/XotBaseState.php',
];

foreach ($states as $file) {
    if (!file_exists($file)) {
        continue;
    }
    
    $content = file_get_contents($file);
    $originalContent = $content;
    
    // Correggi State generics
    $content = preg_replace(
        '/extends State(?!<)/',
        'extends State<\\Illuminate\\Database\\Eloquent\\Model>',
        $content
    );
    
    if ($content !== $originalContent) {
        file_put_contents($file, $content);
        echo "Fixed: " . basename($file) . " -> added generic types\n";
    }
}

echo "States generics fixes completed!\n";

