#!/usr/bin/env php
<?php

/**
 * Analyze Duplicate Methods Across Modules
 *
 * This script scans all modules to identify duplicate methods that could be
 * refactored into traits or base classes.
 *
 * Usage: php analyze_duplicate_methods.php
 *
 * Output: Generates documentation files in each module's docs/ directory
 */

declare(strict_types=1);

// Configuration
$baseDir = __DIR__ . '/../../laravel';
$modulesDir = $baseDir . '/Modules';

// Output colors for CLI
class Console {
    public static function info(string $message): void {
        echo "\033[36m[INFO]\033[0m {$message}\n";
    }

    public static function success(string $message): void {
        echo "\033[32m[SUCCESS]\033[0m {$message}\n";
    }

    public static function warning(string $message): void {
        echo "\033[33m[WARNING]\033[0m {$message}\n";
    }

    public static function error(string $message): void {
        echo "\033[31m[ERROR]\033[0m {$message}\n";
    }
}

// Data structures
class MethodInfo {
    public function __construct(
        public string $name,
        public string $signature,
        public string $filePath,
        public int $lineNumber,
        public string $module,
        public string $className,
        public string $returnType,
        public array $parameters,
        public string $visibility,
        public bool $isStatic,
        public bool $isAbstract,
        public ?string $bodyHash = null
    ) {}
}

class DuplicateGroup {
    /** @var MethodInfo[] */
    public array $methods = [];
    public string $methodName;
    public string $refactoringType = 'Unknown'; // 'Trait', 'BaseClass', 'Interface'
    public string $complexity = 'Unknown'; // 'Low', 'Medium', 'High'
    public int $confidence = 0; // 0-100%

    public function __construct(string $methodName) {
        $this->methodName = $methodName;
    }

    public function addMethod(MethodInfo $method): void {
        $this->methods[] = $method;
    }

    public function analyze(): void {
        if (count($this->methods) < 2) {
            return;
        }

        // Analizza similarità delle implementazioni
        $uniqueBodies = count(array_unique(array_map(fn($m) => $m->bodyHash, $this->methods)));
        $totalMethods = count($this->methods);

        // Calcola confidence basato sulla similarità
        $this->confidence = (int)(($totalMethods - $uniqueBodies + 1) / $totalMethods * 100);

        // Determina tipo di refactoring
        $allStatic = array_reduce($this->methods, fn($carry, $m) => $carry && $m->isStatic, true);
        $allAbstract = array_reduce($this->methods, fn($carry, $m) => $carry && $m->isAbstract, true);
        $sameSignature = count(array_unique(array_map(fn($m) => $m->signature, $this->methods))) === 1;

        if ($allAbstract || !$sameSignature) {
            $this->refactoringType = 'Interface';
            $this->complexity = 'Low';
        } elseif ($allStatic) {
            $this->refactoringType = 'Trait';
            $this->complexity = 'Low';
        } elseif ($uniqueBodies === 1) {
            $this->refactoringType = 'Trait';
            $this->complexity = 'Low';
        } elseif ($uniqueBodies <= $totalMethods / 2) {
            $this->refactoringType = 'BaseClass';
            $this->complexity = 'Medium';
        } else {
            $this->refactoringType = 'Pattern';
            $this->complexity = 'High';
        }
    }
}

class ModuleAnalyzer {
    private array $allMethods = [];
    private array $duplicateGroups = [];

    public function __construct(
        private string $modulesDir
    ) {}

    public function analyze(): void {
        Console::info("Starting module analysis...");

        $modules = $this->getModules();
        Console::info("Found " . count($modules) . " modules");

        foreach ($modules as $module) {
            Console::info("Analyzing module: {$module}");
            $this->analyzeModule($module);
        }

        Console::info("Total methods found: " . count($this->allMethods));

        $this->findDuplicates();
        $this->analyzeDuplicates();
        $this->generateReports();
    }

    private function getModules(): array {
        $modules = [];
        $dirs = glob($this->modulesDir . '/*', GLOB_ONLYDIR);

        foreach ($dirs as $dir) {
            $moduleName = basename($dir);
            if (preg_match('/^[A-Z]/', $moduleName)) {
                $modules[] = $moduleName;
            }
        }

        sort($modules);
        return $modules;
    }

    private function analyzeModule(string $module): void {
        $modulePath = $this->modulesDir . '/' . $module;

        // Analizza diversi tipi di file
        $patterns = [
            'Models' => $modulePath . '/app/Models/*.php',
            'Services' => $modulePath . '/app/Services/*.php',
            'Actions' => $modulePath . '/app/Actions/*.php',
            'Traits' => $modulePath . '/app/Traits/*.php',
        ];

        foreach ($patterns as $type => $pattern) {
            $files = glob($pattern);
            if ($files === false) continue;

            foreach ($files as $file) {
                $this->analyzeFile($file, $module, $type);
            }
        }
    }

    private function analyzeFile(string $filePath, string $module, string $type): void {
        $content = file_get_contents($filePath);
        if ($content === false) return;

        // Estrai nome classe
        preg_match('/class\s+(\w+)/', $content, $classMatch);
        $className = $classMatch[1] ?? 'Unknown';

        // Trova tutti i metodi pubblici e protetti
        preg_match_all(
            '/^\s*(public|protected|private)\s+(static\s+)?function\s+(\w+)\s*\((.*?)\)(?:\s*:\s*(\??\w+(?:\|[\w|]+)?))?\s*\{/ms',
            $content,
            $matches,
            PREG_SET_ORDER | PREG_OFFSET_CAPTURE
        );

        foreach ($matches as $match) {
            $visibility = $match[1][0];
            $isStatic = !empty($match[2][0]);
            $methodName = $match[3][0];
            $params = $match[4][0];
            $returnType = $match[5][0] ?? 'void';

            // Skip magic methods e metodi privati (per ora)
            if (str_starts_with($methodName, '__') || $visibility === 'private') {
                continue;
            }

            // Calcola hash del corpo del metodo
            $methodStart = $match[0][1];
            $bodyHash = $this->extractMethodBody($content, $methodStart);

            // Calcola numero di riga
            $lineNumber = substr_count($content, "\n", 0, $methodStart) + 1;

            // Crea signature
            $signature = "{$visibility}" .
                        ($isStatic ? " static" : "") .
                        " function {$methodName}({$params}): {$returnType}";

            $methodInfo = new MethodInfo(
                name: $methodName,
                signature: $signature,
                filePath: $filePath,
                lineNumber: $lineNumber,
                module: $module,
                className: $className,
                returnType: $returnType,
                parameters: $this->parseParameters($params),
                visibility: $visibility,
                isStatic: $isStatic,
                isAbstract: str_contains($match[0][0], 'abstract'),
                bodyHash: $bodyHash
            );

            $this->allMethods[] = $methodInfo;
        }
    }

    private function extractMethodBody(string $content, int $startPos): string {
        // Trova la chiusura della funzione
        $braceCount = 0;
        $inMethod = false;
        $body = '';

        for ($i = $startPos; $i < strlen($content); $i++) {
            $char = $content[$i];

            if ($char === '{') {
                $braceCount++;
                $inMethod = true;
            } elseif ($char === '}') {
                $braceCount--;
                if ($braceCount === 0 && $inMethod) {
                    break;
                }
            }

            if ($inMethod && $braceCount > 0) {
                $body .= $char;
            }
        }

        // Normalizza il body per il confronto
        $body = preg_replace('/\s+/', ' ', $body);
        $body = preg_replace('/\/\*.*?\*\/|\/\/.*$/m', '', $body);

        return md5($body);
    }

    private function parseParameters(string $params): array {
        if (empty(trim($params))) {
            return [];
        }

        $paramArray = [];
        $parts = explode(',', $params);

        foreach ($parts as $param) {
            $param = trim($param);
            if (preg_match('/(?:(\??\w+(?:\|[\w|]+)?)\s+)?(\$\w+)(?:\s*=\s*(.+))?/', $param, $matches)) {
                $paramArray[] = [
                    'type' => $matches[1] ?? 'mixed',
                    'name' => $matches[2] ?? '',
                    'default' => $matches[3] ?? null,
                ];
            }
        }

        return $paramArray;
    }

    private function findDuplicates(): void {
        Console::info("Finding duplicate methods...");

        // Raggruppa per nome metodo
        $grouped = [];
        foreach ($this->allMethods as $method) {
            $grouped[$method->name][] = $method;
        }

        // Filtra solo quelli con duplicati
        foreach ($grouped as $methodName => $methods) {
            if (count($methods) >= 2) {
                $group = new DuplicateGroup($methodName);
                foreach ($methods as $method) {
                    $group->addMethod($method);
                }
                $this->duplicateGroups[] = $group;
            }
        }

        Console::success("Found " . count($this->duplicateGroups) . " duplicate method groups");
    }

    private function analyzeDuplicates(): void {
        Console::info("Analyzing duplicates for refactoring opportunities...");

        foreach ($this->duplicateGroups as $group) {
            $group->analyze();
        }
    }

    private function generateReports(): void {
        Console::info("Generating reports...");

        // Raggruppa per modulo
        $byModule = [];
        foreach ($this->duplicateGroups as $group) {
            foreach ($group->methods as $method) {
                if (!isset($byModule[$method->module])) {
                    $byModule[$method->module] = [];
                }

                // Evita duplicati nello stesso modulo
                $exists = false;
                foreach ($byModule[$method->module] as $existingGroup) {
                    if ($existingGroup->methodName === $group->methodName) {
                        $exists = true;
                        break;
                    }
                }

                if (!$exists) {
                    $byModule[$method->module][] = $group;
                }
            }
        }

        // Genera report per ogni modulo
        foreach ($byModule as $module => $groups) {
            $this->generateModuleReport($module, $groups);
        }

        // Genera report globale
        $this->generateGlobalReport();
    }

    private function generateModuleReport(string $module, array $groups): void {
        $docsDir = $this->modulesDir . '/' . $module . '/docs';

        if (!is_dir($docsDir)) {
            mkdir($docsDir, 0755, true);
        }

        $reportPath = $docsDir . '/duplicate-methods-analysis.md';

        $content = $this->buildModuleReportContent($module, $groups);

        file_put_contents($reportPath, $content);
        Console::success("Generated report for module {$module}: {$reportPath}");
    }

    private function buildModuleReportContent(string $module, array $groups): string {
        $date = date('Y-m-d H:i:s');
        $groupCount = count($groups);

        $md = <<<MD
        # Analisi Metodi Duplicati - Modulo {$module}

        **Data Generazione**: {$date}
        **Totale Gruppi di Duplicati**: {$groupCount}

        ## Sommario Esecutivo

        Questo documento identifica i metodi duplicati nel modulo **{$module}** che potrebbero beneficiare di refactoring.

        MD;

        // Statistiche
        $traitCandidates = array_filter($groups, fn($g) => $g->refactoringType === 'Trait');
        $baseClassCandidates = array_filter($groups, fn($g) => $g->refactoringType === 'BaseClass');
        $interfaceCandidates = array_filter($groups, fn($g) => $g->refactoringType === 'Interface');

        $md .= "\n### Statistiche\n\n";
        $md .= "| Tipo Refactoring | Conteggio |\n";
        $md .= "|------------------|----------:|\n";
        $md .= "| **Trait** | " . count($traitCandidates) . " |\n";
        $md .= "| **Base Class** | " . count($baseClassCandidates) . " |\n";
        $md .= "| **Interface** | " . count($interfaceCandidates) . " |\n";
        $md .= "| **Altro** | " . (count($groups) - count($traitCandidates) - count($baseClassCandidates) - count($interfaceCandidates)) . " |\n\n";

        // Dettagli per ogni gruppo
        $md .= "## Dettaglio Metodi Duplicati\n\n";

        usort($groups, fn($a, $b) => $b->confidence <=> $a->confidence);

        foreach ($groups as $i => $group) {
            $md .= $this->buildGroupSection($i + 1, $group, $module);
        }

        // Footer
        $md .= "\n---\n\n";
        $md .= "## Legenda\n\n";
        $md .= "### Tipo di Refactoring\n\n";
        $md .= "- **Trait**: Metodi con implementazione identica o molto simile\n";
        $md .= "- **Base Class**: Metodi con logica comune ma implementazioni variabili\n";
        $md .= "- **Interface**: Metodi con stessa signature ma implementazioni diverse\n";
        $md .= "- **Pattern**: Metodi che seguono pattern simili ma richiedono analisi più approfondita\n\n";

        $md .= "### Complessità di Refactoring\n\n";
        $md .= "- **Low**: Refactoring semplice, basso rischio\n";
        $md .= "- **Medium**: Refactoring moderato, richiede test accurati\n";
        $md .= "- **High**: Refactoring complesso, richiede analisi approfondita\n\n";

        $md .= "### Percentuale di Confidenza\n\n";
        $md .= "Indica quanto è probabile che il refactoring sia vantaggioso:\n";
        $md .= "- **90-100%**: Altamente raccomandato\n";
        $md .= "- **70-89%**: Raccomandato\n";
        $md .= "- **50-69%**: Valutare caso per caso\n";
        $md .= "- **< 50%**: Richiede analisi dettagliata\n\n";

        return $md;
    }

    private function buildGroupSection(int $number, DuplicateGroup $group, string $currentModule): string {
        $md = "### {$number}. Metodo: `{$group->methodName}`\n\n";

        // Badge
        $complexityEmoji = [
            'Low' => '🟢',
            'Medium' => '🟡',
            'High' => '🔴',
        ];

        $confidenceEmoji = $group->confidence >= 70 ? '✅' : ($group->confidence >= 50 ? '⚠️' : '❌');

        $md .= "**Tipo Refactoring**: `{$group->refactoringType}` | ";
        $md .= "**Complessità**: {$complexityEmoji[$group->complexity]} {$group->complexity} | ";
        $md .= "**Confidenza**: {$confidenceEmoji} {$group->confidence}%\n\n";

        // Trovato in
        $fileCount = count($group->methods);
        $md .= "**Trovato in {$fileCount} file**:\n\n";

        foreach ($group->methods as $method) {
            $relPath = str_replace($this->modulesDir . '/', 'Modules/', $method->filePath);
            $moduleTag = $method->module !== $currentModule ? " (Modulo: {$method->module})" : "";
            $md .= "- `{$method->className}::{$method->name}` - [{$relPath}:{$method->lineNumber}]({$relPath}){$moduleTag}\n";
        }

        $md .= "\n**Signature**:\n```php\n{$group->methods[0]->signature}\n```\n\n";

        // Vantaggi e rischi
        $md .= $this->buildProsAndCons($group);

        $md .= "\n---\n\n";

        return $md;
    }

    private function buildProsAndCons(DuplicateGroup $group): string {
        $md = "#### 📊 Analisi Refactoring\n\n";

        $md .= "##### ✅ Vantaggi\n\n";

        $advantages = [
            "Riduzione duplicazione codice (" . count($group->methods) . " occorrenze)",
            "Manutenibilità migliorata",
            "Consistenza tra moduli",
        ];

        if ($group->refactoringType === 'Trait') {
            $advantages[] = "Riuso semplice tramite Trait";
            $advantages[] = "Nessuna modifica alla gerarchia delle classi";
        } elseif ($group->refactoringType === 'BaseClass') {
            $advantages[] = "Struttura gerarchica chiara";
            $advantages[] = "Possibilità di override controllato";
        } elseif ($group->refactoringType === 'Interface') {
            $advantages[] = "Contratto chiaro tra moduli";
            $advantages[] = "Flessibilità implementativa";
        }

        foreach ($advantages as $adv) {
            $md .= "- {$adv}\n";
        }

        $md .= "\n##### ⚠️ Rischi e Considerazioni\n\n";

        $risks = [];

        if ($group->complexity === 'High') {
            $risks[] = "Complessità elevata del refactoring";
            $risks[] = "Possibili breaking changes";
        } elseif ($group->complexity === 'Medium') {
            $risks[] = "Richiede testing approfondito";
            $risks[] = "Possibili dipendenze nascoste";
        } else {
            $risks[] = "Rischio basso, monitorare test";
        }

        if ($group->confidence < 70) {
            $risks[] = "Confidenza non ottimale - verificare manualmente";
        }

        if ($group->refactoringType === 'BaseClass') {
            $risks[] = "Accoppiamento gerarchico tra moduli";
        }

        $risks[] = "Verificare compatibilità PHPStan Level Max";

        foreach ($risks as $risk) {
            $md .= "- {$risk}\n";
        }

        // Raccomandazione
        $md .= "\n##### 💡 Raccomandazione\n\n";

        if ($group->confidence >= 70 && $group->complexity === 'Low') {
            $md .= "**Procedere con refactoring** - Alta confidenza e bassa complessità rendono questa ottimizzazione sicura.\n";
        } elseif ($group->confidence >= 50) {
            $md .= "**Valutare attentamente** - Analizzare le implementazioni specifiche prima di procedere.\n";
        } else {
            $md .= "**Analisi manuale richiesta** - Le differenze tra le implementazioni potrebbero essere significative.\n";
        }

        return $md;
    }

    private function generateGlobalReport(): void {
        $reportPath = $this->modulesDir . '/../docs/duplicate-methods-global-analysis.md';

        $docsDir = dirname($reportPath);
        if (!is_dir($docsDir)) {
            mkdir($docsDir, 0755, true);
        }

        $content = $this->buildGlobalReportContent();

        file_put_contents($reportPath, $content);
        Console::success("Generated global report: {$reportPath}");
    }

    private function buildGlobalReportContent(): string {
        $date = date('Y-m-d H:i:s');
        $totalGroups = count($this->duplicateGroups);
        $totalMethods = count($this->allMethods);

        $md = <<<MD
        # Analisi Globale Metodi Duplicati - FixCity

        **Data Generazione**: {$date}
        **Totale Metodi Analizzati**: {$totalMethods}
        **Totale Gruppi di Duplicati**: {$totalGroups}

        ## Panoramica

        Questa analisi identifica opportunità di refactoring cross-module per ridurre la duplicazione del codice e migliorare la manutenibilità.

        MD;

        // Top duplicati
        usort($this->duplicateGroups, fn($a, $b) => count($b->methods) <=> count($a->methods));

        $md .= "\n## Top 10 Metodi Più Duplicati\n\n";
        $md .= "| # | Metodo | Occorrenze | Tipo Refactoring | Confidenza |\n";
        $md .= "|---|--------|------------|------------------|------------|\n";

        $top10 = array_slice($this->duplicateGroups, 0, 10);
        foreach ($top10 as $i => $group) {
            $md .= "| " . ($i + 1) . " | `{$group->methodName}` | " . count($group->methods) .
                   " | {$group->refactoringType} | {$group->confidence}% |\n";
        }

        // Statistiche per tipo
        $md .= "\n## Statistiche per Tipo di Refactoring\n\n";

        $byType = [];
        foreach ($this->duplicateGroups as $group) {
            $byType[$group->refactoringType] = ($byType[$group->refactoringType] ?? 0) + 1;
        }

        $md .= "| Tipo | Conteggio | Percentuale |\n";
        $md .= "|------|-----------|-------------|\n";

        foreach ($byType as $type => $count) {
            $percentage = round($count / $totalGroups * 100, 1);
            $md .= "| {$type} | {$count} | {$percentage}% |\n";
        }

        // Moduli coinvolti
        $md .= "\n## Moduli con Più Duplicazioni\n\n";

        $moduleCount = [];
        foreach ($this->duplicateGroups as $group) {
            foreach ($group->methods as $method) {
                $moduleCount[$method->module] = ($moduleCount[$method->module] ?? 0) + 1;
            }
        }

        arsort($moduleCount);

        $md .= "| Modulo | Metodi Duplicati | Report |\n";
        $md .= "|--------|------------------|--------|\n";

        foreach ($moduleCount as $module => $count) {
            $reportPath = "Modules/{$module}/docs/duplicate-methods-analysis.md";
            $md .= "| {$module} | {$count} | [Visualizza]({$reportPath}) |\n";
        }

        $md .= "\n## Prossimi Passi\n\n";
        $md .= "1. Consultare i report specifici per modulo\n";
        $md .= "2. Prioritizzare refactoring ad alta confidenza (>70%) e bassa complessità\n";
        $md .= "3. Creare Traits per metodi identici\n";
        $md .= "4. Valutare Base Classes per gerarchie condivise\n";
        $md .= "5. Eseguire test approfonditi dopo ogni refactoring\n";
        $md .= "6. Verificare PHPStan Level Max dopo modifiche\n\n";

        return $md;
    }
}

// Main execution
try {
    Console::info("=== Module Duplicate Methods Analyzer ===\n");

    if (!is_dir($modulesDir)) {
        throw new Exception("Modules directory not found: {$modulesDir}");
    }

    $analyzer = new ModuleAnalyzer($modulesDir);
    $analyzer->analyze();

    Console::success("\n=== Analysis completed successfully ===");

} catch (Exception $e) {
    Console::error("Error: " . $e->getMessage());
    exit(1);
}
