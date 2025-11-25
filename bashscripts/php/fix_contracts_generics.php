<?php

/**
 * Script per correggere tipi generici nei Contracts Xot
 */

$contracts = [
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/HasRecursiveRelationshipsContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ModelContactContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ModelContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ModelInputContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ModelProfileContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ModelWithAuthorContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ModelWithPosContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ModelWithStatusContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ModelWithUserContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/PassportHasApiTokensContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ProfileContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/UserContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/WithStateStatusContract.php',
];

foreach ($contracts as $file) {
    if (!file_exists($file)) {
        continue;
    }
    
    $content = file_get_contents($file);
    $originalContent = $content;
    
    // Correggi BelongsTo generics
    $content = preg_replace(
        '/@return BelongsTo(?!<)/',
        '@return BelongsTo<\\Illuminate\\Database\\Eloquent\\Model, static>',
        $content
    );
    
    // Correggi HasMany generics
    $content = preg_replace(
        '/@return HasMany(?!<)/',
        '@return HasMany<\\Illuminate\\Database\\Eloquent\\Model, static>',
        $content
    );
    
    // Correggi BelongsToMany generics
    $content = preg_replace(
        '/@return BelongsToMany(?!<)/',
        '@return BelongsToMany<\\Illuminate\\Database\\Eloquent\\Model, static, int, int, int>',
        $content
    );
    
    // Correggi HasOne generics
    $content = preg_replace(
        '/@return HasOne(?!<)/',
        '@return HasOne<\\Illuminate\\Database\\Eloquent\\Model, static>',
        $content
    );
    
    // Correggi MorphMany generics
    $content = preg_replace(
        '/@return MorphMany(?!<)/',
        '@return MorphMany<\\Illuminate\\Database\\Eloquent\\Model, static>',
        $content
    );
    
    // Correggi Collection generics
    $content = preg_replace(
        '/@param Collection(?!<)/',
        '@param Collection<int, mixed>',
        $content
    );
    
    // Correggi Builder generics
    $content = preg_replace(
        '/@return Builder(?!<)/',
        '@return Builder<static>',
        $content
    );
    
    // Correggi State generics
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

echo "Contracts generics fixes completed!\n";

