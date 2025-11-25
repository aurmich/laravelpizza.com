<?php

/**
 * Script per correggere i Contracts rimanenti
 */

$contracts = [
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ModelContactContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ModelContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ModelInputContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ModelProfileContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ModelWithAuthorContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ModelWithPosContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ModelWithStatusContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ModelWithUserContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/PassportHasApiTokensContract.php',
];

foreach ($contracts as $file) {
    if (!file_exists($file)) {
        continue;
    }
    
    $content = file_get_contents($file);
    $originalContent = $content;
    
    // Correggi tutti i metodi user() con BelongsTo
    $content = preg_replace(
        '/@method.*user\(\).*@return BelongsTo(?!<)/',
        '@method BelongsTo<\\Illuminate\\Database\\Eloquent\\Model, static> user()',
        $content
    );
    
    // Correggi tutti i metodi che restituiscono BelongsTo
    $content = preg_replace(
        '/@return BelongsTo(?!<)/',
        '@return BelongsTo<\\Illuminate\\Database\\Eloquent\\Model, static>',
        $content
    );
    
    // Correggi tutti i metodi che restituiscono HasMany
    $content = preg_replace(
        '/@return HasMany(?!<)/',
        '@return HasMany<\\Illuminate\\Database\\Eloquent\\Model, static>',
        $content
    );
    
    // Correggi tutti i metodi che restituiscono BelongsToMany
    $content = preg_replace(
        '/@return BelongsToMany(?!<)/',
        '@return BelongsToMany<\\Illuminate\\Database\\Eloquent\\Model, static, int, int, int>',
        $content
    );
    
    // Correggi tutti i metodi che restituiscono MorphMany
    $content = preg_replace(
        '/@return MorphMany(?!<)/',
        '@return MorphMany<\\Illuminate\\Database\\Eloquent\\Model, static>',
        $content
    );
    
    // Correggi tutti i metodi che restituiscono Builder
    $content = preg_replace(
        '/@return Builder(?!<)/',
        '@return Builder<static>',
        $content
    );
    
    // Correggi tutte le proprietà Collection
    $content = preg_replace(
        '/@property.*Collection(?!<)/',
        '@property Collection<int, mixed>',
        $content
    );
    
    // Correggi tutte le proprietà State
    $content = preg_replace(
        '/@property.*State(?!<)/',
        '@property State<static>',
        $content
    );
    
    if ($content !== $originalContent) {
        file_put_contents($file, $content);
        echo "Fixed: " . basename($file) . " -> added generic types\n";
    }
}

echo "Remaining contracts fixes completed!\n";

