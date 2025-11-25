<?php

/**
 * Script per sostituire funzioni non sicure con Safe
 */

$files = [
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Services/MonitoringService.php',
    '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Services/PerformanceMonitoringService.php',
];

foreach ($files as $file) {
    if (!file_exists($file)) {
        continue;
    }
    
    $content = file_get_contents($file);
    $originalContent = $content;
    
    // Aggiungi use Safe all'inizio del file
    if (strpos($content, 'use function Safe\\') === false) {
        $content = preg_replace(
            '/^<\?php\s*\n\s*declare\(strict_types=1\);\s*\n/',
            "<?php\n\ndeclare(strict_types=1);\n\nuse function Safe\\file_get_contents;\nuse function Safe\\sys_getloadavg;\nuse function Safe\\disk_total_space;\nuse function Safe\\disk_free_space;\nuse function Safe\\preg_replace;\n\n",
            $content
        );
    }
    
    // Sostituisci le funzioni non sicure
    $content = str_replace('file_get_contents(', 'Safe\\file_get_contents(', $content);
    $content = str_replace('sys_getloadavg(', 'Safe\\sys_getloadavg(', $content);
    $content = str_replace('disk_total_space(', 'Safe\\disk_total_space(', $content);
    $content = str_replace('disk_free_space(', 'Safe\\disk_free_space(', $content);
    $content = str_replace('preg_replace(', 'Safe\\preg_replace(', $content);
    
    if ($content !== $originalContent) {
        file_put_contents($file, $content);
        echo "Fixed: " . basename($file) . " -> replaced unsafe functions with Safe\n";
    }
}

echo "Safe functions fixes completed!\n";
