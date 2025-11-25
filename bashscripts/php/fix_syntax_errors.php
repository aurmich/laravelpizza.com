<?php

/**
 * Script per rimuovere sintassi generica non valida
 */

$files = [
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ProfileContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/UserContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ModelWithStatusContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ModelWithPosContract.php',
];

foreach ($files as $file) {
    if (!file_exists($file)) {
        continue;
    }
    
    $content = file_get_contents($file);
    $originalContent = $content;
    
    // Rimuovi sintassi generica dai parametri di metodo
    $content = preg_replace(
        '/Collection<int, mixed>/',
        'Collection',
        $content
    );
    
    // Rimuovi sintassi generica dai return types
    $content = preg_replace(
        '/BelongsTo<\\\\Illuminate\\\\Database\\\\Eloquent\\\\Model, static>/',
        'BelongsTo',
        $content
    );
    
    $content = preg_replace(
        '/HasOne<\\\\Illuminate\\\\Database\\\\Eloquent\\\\Model, static>/',
        'HasOne',
        $content
    );
    
    $content = preg_replace(
        '/BelongsToMany<\\\\Illuminate\\\\Database\\\\Eloquent\\\\Model, static, int, int, int>/',
        'BelongsToMany',
        $content
    );
    
    $content = preg_replace(
        '/MorphMany<\\\\Illuminate\\\\Database\\\\Eloquent\\\\Model, static>/',
        'MorphMany',
        $content
    );
    
    $content = preg_replace(
        '/Builder<static>/',
        'Builder',
        $content
    );
    
    $content = preg_replace(
        '/State<static>/',
        'State',
        $content
    );
    
    if ($content !== $originalContent) {
        file_put_contents($file, $content);
        echo "Fixed: " . basename($file) . " -> removed invalid generic syntax\n";
    }
}

echo "Syntax errors fixes completed!\n";

