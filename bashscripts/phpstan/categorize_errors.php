<?php

declare(strict_types=1);

/**
 * Script per categorizzare errori PHPStan
 * 
 * Analizza l'output di PHPStan e categorizza gli errori per tipo,
 * facilitando la correzione sistematica.
 */

echo "=== PHPStan Error Categorization Tool ===\n\n";
echo "Avvio analisi PHPStan...\n";

$startTime = microtime(true);

// Esegui PHPStan
$cmd = 'cd ../laravel && ./vendor/bin/phpstan analyse Modules --memory-limit=-1 --error-format=json 2>&1';
exec($cmd, $output, $returnCode);

$phpstanOutput = implode("\n", $output);
file_put_contents('/tmp/phpstan_raw_output.txt', $phpstanOutput);

$data = json_decode($phpstanOutput, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo "⚠️  Output non è JSON valido. Salvato in /tmp/phpstan_raw_output.txt\n";
    echo "Errore JSON: " . json_last_error_msg() . "\n";
    exit(1);
}

// Inizializza contatori
$errorsByType = [
    'factory_method' => [],
    'reflection_type' => [],
    'undefined_property' => [],
    'static_outside_class' => [],
    'method_not_found' => [],
    'property_non_object' => [],
    'argument_type' => [],
    'template_type' => [],
    'foreach_non_iterable' => [],
    'binary_op_invalid' => [],
    'new_abstract' => [],
    'new_internal_class' => [],
    'other' => [],
];

$totalErrors = 0;
$fileCount = 0;

// Processa errori
if (isset($data['files'])) {
    foreach ($data['files'] as $file => $fileData) {
        $fileCount++;
        if (isset($fileData['messages'])) {
            foreach ($fileData['messages'] as $error) {
                $message = $error['message'] ?? '';
                $line = $error['line'] ?? 0;
                $totalErrors++;

                $errorData = compact('file', 'line', 'message');

                // Categorizza per tipo
                if (strpos($message, '::factory()') !== false) {
                    $errorsByType['factory_method'][] = $errorData;
                } elseif (strpos($message, 'ReflectionType::getName()') !== false) {
                    $errorsByType['reflection_type'][] = $errorData;
                } elseif (stripos($message, 'undefined property') !== false) {
                    $errorsByType['undefined_property'][] = $errorData;
                } elseif (strpos($message, 'outside of class scope') !== false) {
                    $errorsByType['static_outside_class'][] = $errorData;
                } elseif (strpos($message, 'method.notFound') !== false || strpos($message, 'staticMethod.notFound') !== false) {
                    $errorsByType['method_not_found'][] = $errorData;
                } elseif (strpos($message, 'property.nonObject') !== false || strpos($message, 'method.nonObject') !== false) {
                    $errorsByType['property_non_object'][] = $errorData;
                } elseif (strpos($message, 'argument.type') !== false) {
                    $errorsByType['argument_type'][] = $errorData;
                } elseif (strpos($message, 'argument.templateType') !== false || strpos($message, 'template type') !== false) {
                    $errorsByType['template_type'][] = $errorData;
                } elseif (strpos($message, 'foreach.nonIterable') !== false) {
                    $errorsByType['foreach_non_iterable'][] = $errorData;
                } elseif (strpos($message, 'binaryOp.invalid') !== false) {
                    $errorsByType['binary_op_invalid'][] = $errorData;
                } elseif (strpos($message, 'new.abstract') !== false) {
                    $errorsByType['new_abstract'][] = $errorData;
                } elseif (strpos($message, 'new.internalClass') !== false) {
                    $errorsByType['new_internal_class'][] = $errorData;
                } else {
                    $errorsByType['other'][] = $errorData;
                }
            }
        }
    }
}

$endTime = microtime(true);
$duration = round($endTime - $startTime, 2);

// Stampa statistiche
echo "\n=== RISULTATI ANALISI ===\n";
echo str_repeat("=", 60) . "\n\n";
echo "Tempo di esecuzione: {$duration}s\n";
echo "File analizzati: {$fileCount}\n";
echo "Errori totali: {$totalErrors}\n\n";

echo "ERRORI PER CATEGORIA:\n";
echo str_repeat("-", 60) . "\n";

foreach ($errorsByType as $type => $errors) {
    $count = count($errors);
    $percentage = $totalErrors > 0 ? round(($count / $totalErrors) * 100, 1) : 0;
    printf("%-30s: %5d (%5.1f%%)\n", $type, $count, $percentage);
}

// Salva report dettagliato
$report = [
    'metadata' => [
        'total_errors' => $totalErrors,
        'total_files' => $fileCount,
        'execution_time' => $duration,
        'timestamp' => date('Y-m-d H:i:s'),
    ],
    'summary' => array_map(fn($errors) => count($errors), $errorsByType),
    'errors_by_type' => $errorsByType,
];

$reportPath = '/tmp/phpstan_errors_categorized.json';
file_put_contents($reportPath, json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

echo "\n✅ Report dettagliato salvato in: {$reportPath}\n";

// Mostra top 5 file con più errori
echo "\n=== TOP 10 FILE CON PIÙ ERRORI ===\n";
echo str_repeat("-", 60) . "\n";

$errorsByFile = [];
foreach ($errorsByType as $type => $errors) {
    foreach ($errors as $error) {
        $file = $error['file'];
        if (!isset($errorsByFile[$file])) {
            $errorsByFile[$file] = 0;
        }
        $errorsByFile[$file]++;
    }
}

arsort($errorsByFile);
$top10 = array_slice($errorsByFile, 0, 10, true);

foreach ($top10 as $file => $count) {
    // Estrai solo il nome del file relativo
    $shortFile = str_replace('/var/www/_bases/base_fixcity_fila4_mono/laravel/', '', $file);
    printf("%5d errori - %s\n", $count, $shortFile);
}

echo "\n";
exit(0);
