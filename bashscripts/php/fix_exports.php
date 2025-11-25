<?php

/**
 * Script per correggere i tipi generici negli Export
 */

$exportFiles = [
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Exports/LazyCollectionExport.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Exports/QueryExport.php',
];

foreach ($exportFiles as $file) {
    if (!file_exists($file)) {
        continue;
    }
    
    $content = file_get_contents($file);
    
    // Aggiungi @implements WithMapping<Model> se non esiste
    if (str_contains($content, 'implements') && str_contains($content, 'WithMapping') && !str_contains($content, '@implements WithMapping<Model>')) {
        $newContent = preg_replace(
            '/(class\s+\w+Export\s+implements[^\{]+WithMapping[^\{]*\{)/',
            "/**\n * @implements WithMapping<Model>\n */\n$1",
            $content
        );
        
        if ($newContent !== $content) {
            file_put_contents($file, $newContent);
            echo "Fixed: " . basename($file) . " -> @implements WithMapping<Model>\n";
        }
    }
    
    // Aggiungi tipi generici per Collection
    if (str_contains($content, 'Collection $') && !str_contains($content, 'Collection<int, Model>')) {
        $newContent = preg_replace(
            '/(\w+)\s+Collection\s+\$(\w+);/',
            '/** @var Collection<int, Model> */\n    public Collection $\\2;',
            $content
        );
        
        if ($newContent !== $content) {
            file_put_contents($file, $newContent);
            echo "Fixed: " . basename($file) . " -> Collection<int, Model>\n";
        }
    }
    
    // Aggiungi tipi generici per parametri Collection
    if (str_contains($content, 'Collection $') && !str_contains($content, 'Collection<int, Model>')) {
        $newContent = preg_replace(
            '/(public function __construct\()([^)]*Collection \$([^)]+)\)/',
            '$1/** @param Collection<int, Model> $\\3 */\n    public function __construct($2Collection $\\3)',
            $content
        );
        
        if ($newContent !== $content) {
            file_put_contents($file, $newContent);
            echo "Fixed: " . basename($file) . " -> Collection<int, Model> parameter\n";
        }
    }
}

echo "Export fixes completed!\n";

