<?php

/**
 * Script per correggere errori di type safety in PerformanceMonitoringService
 */

$file = '/var/www/_bases/base_fixcity_fila4_mono/laravel/Modules/Xot/app/Services/PerformanceMonitoringService.php';

if (!file_exists($file)) {
    echo "File not found: $file\n";
    exit(1);
}

$content = file_get_contents($file);
$originalContent = $content;

// Correggi tutti gli accessi a offset su mixed
$content = preg_replace(
    '/\$this->metrics\[([^\]]+)\]/',
    '($this->metrics && is_array($this->metrics) && isset($this->metrics[$1]) ? $this->metrics[$1] : null)',
    $content
);

// Correggi tutti i count() su mixed
$content = preg_replace(
    '/count\(([^)]+)\)/',
    '(is_array($1) ? count($1) : 0)',
    $content
);

// Correggi tutti gli array_shift() su mixed
$content = preg_replace(
    '/array_shift\(([^)]+)\)/',
    '(is_array($1) ? array_shift($1) : null)',
    $content
);

// Correggi tutti gli array_column() su mixed
$content = preg_replace(
    '/array_column\(([^,]+),([^,]+)\)/',
    '(is_array($1) ? array_column($1, $2) : [])',
    $content
);

// Correggi tutti gli array_filter() su mixed
$content = preg_replace(
    '/array_filter\(([^)]+)\)/',
    '(is_array($1) ? array_filter($1) : [])',
    $content
);

// Correggi tutti i round() su mixed
$content = preg_replace(
    '/round\(([^,]+),([^)]+)\)/',
    '(is_numeric($1) ? round($1, $2) : 0)',
    $content
);

// Correggi tutti i foreach su mixed
$content = preg_replace(
    '/foreach \(([^)]+) as ([^)]+)\)/',
    'foreach ((is_iterable($1) ? $1 : []) as $2)',
    $content
);

if ($content !== $originalContent) {
    file_put_contents($file, $content);
    echo "Fixed: PerformanceMonitoringService.php -> corrected type safety issues\n";
} else {
    echo "No changes needed for PerformanceMonitoringService.php\n";
}

echo "Performance monitoring fixes completed!\n";

