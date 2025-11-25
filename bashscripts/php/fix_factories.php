<?php

/**
 * Script per correggere i tipi generici nelle Factory
 */

$factories = [
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/User/database/factories/',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/database/factories/',
];

foreach ($factories as $factoryDir) {
    if (!is_dir($factoryDir)) {
        continue;
    }
    
    $files = glob($factoryDir . '*.php');
    
    foreach ($files as $file) {
        $content = file_get_contents($file);
        
        // Estrai il nome della classe dal file
        if (preg_match('/class\s+(\w+Factory)\s+extends\s+Factory/', $content, $matches)) {
            $className = $matches[1];
            
            // Estrai il nome del modello dalla proprietà $model
            if (preg_match('/protected\s+\$model\s*=\s*([^;]+);/', $content, $modelMatches)) {
                $modelClass = trim($modelMatches[1]);
                
                // Rimuovi eventuali commenti o spazi
                $modelClass = preg_replace('/\/\*.*?\*\//s', '', $modelClass);
                $modelClass = trim($modelClass);
                
                // Aggiungi il PHPDoc se non esiste già
                if (!str_contains($content, '@extends Factory<')) {
                    $newContent = preg_replace(
                        '/(class\s+' . preg_quote($className) . '\s+extends\s+Factory)/',
                        "/**\n * @extends Factory<{$modelClass}>\n */\n$1",
                        $content
                    );
                    
                    if ($newContent !== $content) {
                        file_put_contents($file, $newContent);
                        echo "Fixed: " . basename($file) . " -> @extends Factory<{$modelClass}>\n";
                    }
                }
            }
        }
    }
}

echo "Factory fixes completed!\n";

