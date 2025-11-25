<?php

/**
 * Script per correggere la sintassi generica nei return type
 */

$files = [
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/app/Models/Permission.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/app/Models/Preferences.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/app/Models/Role.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/app/Models/Settings.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/app/Models/SocialiteUser.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/app/Models/Team.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/app/Models/TeamInvitation.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/app/Models/TeamPermission.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/app/Models/TeamUser.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/app/Models/Tenant.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/app/Models/TenantUser.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/app/Models/User.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/app/Models/Traits/IsProfileTrait.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/ProfileContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Contracts/UserContract.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Models/BaseModel.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Models/Traits/HasExtraTrait.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Models/Traits/RelationX.php',
];

foreach ($files as $file) {
    if (!file_exists($file)) {
        continue;
    }
    
    $content = file_get_contents($file);
    $originalContent = $content;
    
    // Rimuovi sintassi generica dai return type
    $content = preg_replace('/public function (\w+)\(\): (BelongsTo|BelongsToMany|HasMany|HasOne|MorphOne|Collection)<[^>]+>/', 'public function $1(): $2', $content);
    
    if ($content !== $originalContent) {
        file_put_contents($file, $content);
        echo "Fixed: " . basename($file) . " -> removed generic syntax from return types\n";
    }
}

echo "Generic syntax fixes completed!\n";

