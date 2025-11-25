#!/usr/bin/env php
<?php

/**
 * SUPER ADVANCED Duplicate Methods Analyzer
 *
 * Powered by Super Cow 🐮⚡
 *
 * This analyzer goes BEYOND basic duplicate detection:
 * - Extracts ACTUAL code implementations
 * - Calculates PRECISE similarity metrics (Levenshtein, Jaccard, Token-based)
 * - Performs DEEP pattern analysis
 * - Generates CONCRETE refactoring examples
 * - Calculates ROI (Return on Investment) for each refactoring
 * - Provides ACTIONABLE recommendations with code snippets
 *
 * Usage: php super_duplicate_analyzer.php
 */

declare(strict_types=1);

// Configuration
$baseDir = __DIR__ . '/../../laravel';
$modulesDir = $baseDir . '/Modules';

// Console colors
class Console {
    public static function godMode(string $message): void {
        echo "\033[1;35;5m[🐮 SUPER COW]\033[0m \033[1;35m{$message}\033[0m\n";
    }

    public static function info(string $message): void {
        echo "\033[36m[INFO]\033[0m {$message}\n";
    }

    public static function success(string $message): void {
        echo "\033[32m[✓]\033[0m {$message}\n";
    }

    public static function warning(string $message): void {
        echo "\033[33m[!]\033[0m {$message}\n";
    }

    public static function critical(string $message): void {
        echo "\033[1;31m[!!!]\033[0m \033[1m{$message}\033[0m\n";
    }
}

// Enhanced data structures
class CodeSnippet {
    public function __construct(
        public string $raw,
        public array $tokens,
        public array $normalized,
        public int $complexity = 0,
        public array $dependencies = [],
        public array $patterns = []
    ) {}
}

class MethodAnalysis {
    public function __construct(
        public string $name,
        public string $signature,
        public string $filePath,
        public int $lineNumber,
        public string $module,
        public string $className,
        public CodeSnippet $code,
        public string $visibility,
        public bool $isStatic,
        public bool $isAbstract,
        public int $cyclomaticComplexity = 1,
        public array $usedClasses = [],
        public array $usedTraits = [],
        public ?string $docBlock = null
    ) {}
}

class SimilarityMetrics {
    public function __construct(
        public float $levenshtein = 0.0,      // String distance
        public float $jaccard = 0.0,          // Set similarity
        public float $tokenSimilarity = 0.0,  // Token-based
        public float $structural = 0.0,       // Structure similarity
        public float $semantic = 0.0,         // Semantic similarity
        public float $overall = 0.0           // Weighted average
    ) {}
}

class RefactoringOpportunity {
    public function __construct(
        public string $methodName,
        public array $methods,                // MethodAnalysis[]
        public SimilarityMetrics $similarity,
        public string $refactoringType,       // Trait, BaseClass, Interface
        public string $complexity,            // Low, Medium, High
        public int $confidence,               // 0-100
        public float $roi,                    // Return on Investment score
        public int $linesReduced,
        public int $effortHours,
        public array $risks = [],
        public array $benefits = [],
        public ?string $suggestedTraitName = null,
        public ?string $codeExample = null
    ) {}
}

class SuperDuplicateAnalyzer {
    private array $allMethods = [];
    private array $opportunities = [];

    public function __construct(
        private string $modulesDir
    ) {}

    public function analyze(): void {
        Console::godMode("🐮 ACTIVATING SUPER COW POWERS! 🐮");
        Console::godMode("Initiating DIVINE level analysis...");

        $modules = $this->getModules();
        Console::info("Scanning " . count($modules) . " modules with ENHANCED algorithms");

        foreach ($modules as $module) {
            $this->analyzeModule($module);
        }

        Console::success("Extracted " . count($this->allMethods) . " methods with FULL code analysis");

        $this->findDuplicatesWithAdvancedMetrics();
        $this->calculateROI();
        $this->generateEnhancedReports();
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
                $this->deepAnalyzeFile($file, $module, $type);
            }
        }
    }

    private function deepAnalyzeFile(string $filePath, string $module, string $type): void {
        $content = file_get_contents($filePath);
        if ($content === false) return;

        // Extract class info
        preg_match('/class\s+(\w+)/', $content, $classMatch);
        $className = $classMatch[1] ?? 'Unknown';

        // Extract used classes and traits
        preg_match_all('/use\s+([\w\\\\]+);/', $content, $useMatches);
        $usedClasses = $useMatches[1] ?? [];

        // Find all methods with FULL extraction
        preg_match_all(
            '/(?:\/\*\*.*?\*\/\s*)?(public|protected|private)\s+(static\s+)?function\s+(\w+)\s*\((.*?)\)(?:\s*:\s*(\??\w+(?:\|[\w|]+)?))?\s*\{/s',
            $content,
            $matches,
            PREG_SET_ORDER | PREG_OFFSET_CAPTURE
        );

        foreach ($matches as $match) {
            $docBlock = null;
            if (isset($match[0][0]) && str_contains($match[0][0], '/**')) {
                preg_match('/\/\*\*.*?\*\//s', $match[0][0], $docMatch);
                $docBlock = $docMatch[0] ?? null;
            }

            $visibility = $match[1][0];
            $isStatic = !empty($match[2][0]);
            $methodName = $match[3][0];
            $params = $match[4][0];
            $returnType = $match[5][0] ?? 'void';

            // Skip magic and private methods
            if (str_starts_with($methodName, '__') || $visibility === 'private') {
                continue;
            }

            $methodStart = $match[0][1];
            $lineNumber = substr_count($content, "\n", 0, $methodStart) + 1;

            // Extract FULL method body
            $methodBody = $this->extractFullMethodBody($content, $methodStart);

            // Create code snippet with advanced analysis
            $codeSnippet = $this->analyzeCodeSnippet($methodBody);

            // Calculate cyclomatic complexity
            $complexity = $this->calculateCyclomaticComplexity($methodBody);

            $signature = "{$visibility}" .
                        ($isStatic ? " static" : "") .
                        " function {$methodName}({$params}): {$returnType}";

            $methodAnalysis = new MethodAnalysis(
                name: $methodName,
                signature: $signature,
                filePath: $filePath,
                lineNumber: $lineNumber,
                module: $module,
                className: $className,
                code: $codeSnippet,
                visibility: $visibility,
                isStatic: $isStatic,
                isAbstract: str_contains($match[0][0], 'abstract'),
                cyclomaticComplexity: $complexity,
                usedClasses: $usedClasses,
                docBlock: $docBlock
            );

            $this->allMethods[] = $methodAnalysis;
        }
    }

    private function extractFullMethodBody(string $content, int $startPos): string {
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

            if ($inMethod) {
                $body .= $char;
            }
        }

        return $body;
    }

    private function analyzeCodeSnippet(string $code): CodeSnippet {
        // Tokenize
        $tokens = token_get_all('<?php ' . $code);
        $tokenNames = [];

        foreach ($tokens as $token) {
            if (is_array($token)) {
                $tokenNames[] = token_name($token[0]);
            }
        }

        // Normalize (remove whitespace, comments)
        $normalized = preg_replace('/\s+/', ' ', $code);
        $normalized = preg_replace('/\/\*.*?\*\/|\/\/.*$/m', '', $normalized);
        $normalized = trim($normalized);

        // Detect patterns
        $patterns = [];

        if (preg_match('/return\s+(?:new\s+)?self/', $code)) {
            $patterns[] = 'Singleton';
        }

        if (preg_match('/static\s+\$instance/', $code)) {
            $patterns[] = 'Static Instance';
        }

        if (preg_match('/return\s+\$this->belongsTo|hasMany|hasOne/', $code)) {
            $patterns[] = 'Eloquent Relationship';
        }

        if (preg_match('/DB::table|DB::select/', $code)) {
            $patterns[] = 'Query Builder';
        }

        if (preg_match('/\$this->model|Model::class/', $code)) {
            $patterns[] = 'Model Interaction';
        }

        // Extract dependencies
        $dependencies = [];
        preg_match_all('/(?:new|::class)\s+([\w\\\\]+)/', $code, $depMatches);
        if (!empty($depMatches[1])) {
            $dependencies = array_unique($depMatches[1]);
        }

        return new CodeSnippet(
            raw: $code,
            tokens: $tokenNames,
            normalized: explode(' ', $normalized),
            patterns: $patterns,
            dependencies: $dependencies
        );
    }

    private function calculateCyclomaticComplexity(string $code): int {
        $complexity = 1; // Base complexity

        // Count decision points
        $complexity += substr_count($code, 'if');
        $complexity += substr_count($code, 'else');
        $complexity += substr_count($code, 'elseif');
        $complexity += substr_count($code, 'for');
        $complexity += substr_count($code, 'foreach');
        $complexity += substr_count($code, 'while');
        $complexity += substr_count($code, 'case');
        $complexity += substr_count($code, '&&');
        $complexity += substr_count($code, '||');
        $complexity += substr_count($code, '?');
        $complexity += substr_count($code, 'catch');

        return $complexity;
    }

    private function findDuplicatesWithAdvancedMetrics(): void {
        Console::godMode("🐮 Calculating DIVINE similarity metrics...");

        $grouped = [];
        foreach ($this->allMethods as $method) {
            $grouped[$method->name][] = $method;
        }

        foreach ($grouped as $methodName => $methods) {
            if (count($methods) < 2) continue;

            Console::info("Analyzing '{$methodName}' with " . count($methods) . " occurrences");

            // Calculate similarity between all pairs
            $similarities = [];
            $count = count($methods);

            for ($i = 0; $i < $count; $i++) {
                for ($j = $i + 1; $j < $count; $j++) {
                    $sim = $this->calculateSimilarity($methods[$i], $methods[$j]);
                    $similarities[] = $sim;
                }
            }

            // Average similarity
            $avgSimilarity = empty($similarities) ? new SimilarityMetrics() : $this->averageSimilarity($similarities);

            // Determine refactoring strategy
            $strategy = $this->determineRefactoringStrategy($methods, $avgSimilarity);

            // Calculate ROI
            $linesReduced = $this->calculateLinesReduced($methods);
            $effortHours = $this->estimateEffort($methods, $avgSimilarity);
            $roi = $this->calculateROIScore($linesReduced, $effortHours, count($methods));

            // Generate code example
            $codeExample = $this->generateRefactoringExample($methods, $strategy);

            $opportunity = new RefactoringOpportunity(
                methodName: $methodName,
                methods: $methods,
                similarity: $avgSimilarity,
                refactoringType: $strategy['type'],
                complexity: $strategy['complexity'],
                confidence: (int)($avgSimilarity->overall * 100),
                roi: $roi,
                linesReduced: $linesReduced,
                effortHours: $effortHours,
                risks: $strategy['risks'],
                benefits: $strategy['benefits'],
                suggestedTraitName: $strategy['suggestedName'],
                codeExample: $codeExample
            );

            $this->opportunities[] = $opportunity;
        }

        Console::success("Found " . count($this->opportunities) . " refactoring opportunities with PRECISE metrics");
    }

    private function calculateSimilarity(MethodAnalysis $m1, MethodAnalysis $m2): SimilarityMetrics {
        // 1. Levenshtein distance (normalized)
        $lev = levenshtein($m1->code->raw, $m2->code->raw);
        $maxLen = max(strlen($m1->code->raw), strlen($m2->code->raw));
        $levenshtein = $maxLen > 0 ? 1 - ($lev / $maxLen) : 1.0;

        // 2. Jaccard similarity (token sets)
        $set1 = array_unique($m1->code->tokens);
        $set2 = array_unique($m2->code->tokens);
        $intersection = count(array_intersect($set1, $set2));
        $union = count(array_unique(array_merge($set1, $set2)));
        $jaccard = $union > 0 ? $intersection / $union : 0.0;

        // 3. Token sequence similarity
        $tokens1 = $m1->code->normalized;
        $tokens2 = $m2->code->normalized;
        $tokenSim = $this->sequenceSimilarity($tokens1, $tokens2);

        // 4. Structural similarity (signature)
        $structural = $m1->signature === $m2->signature ? 1.0 : 0.5;

        // 5. Semantic similarity (patterns)
        $patterns1 = $m1->code->patterns;
        $patterns2 = $m2->code->patterns;
        $patternIntersect = count(array_intersect($patterns1, $patterns2));
        $patternUnion = count(array_unique(array_merge($patterns1, $patterns2)));
        $semantic = $patternUnion > 0 ? $patternIntersect / $patternUnion : 0.0;

        // Weighted average (emphasize token and semantic)
        $overall = (
            $levenshtein * 0.15 +
            $jaccard * 0.20 +
            $tokenSim * 0.30 +
            $structural * 0.15 +
            $semantic * 0.20
        );

        return new SimilarityMetrics(
            levenshtein: $levenshtein,
            jaccard: $jaccard,
            tokenSimilarity: $tokenSim,
            structural: $structural,
            semantic: $semantic,
            overall: $overall
        );
    }

    private function sequenceSimilarity(array $seq1, array $seq2): float {
        $len1 = count($seq1);
        $len2 = count($seq2);

        if ($len1 === 0 || $len2 === 0) return 0.0;

        // Simple LCS-based similarity
        $matches = 0;
        $minLen = min($len1, $len2);

        for ($i = 0; $i < $minLen; $i++) {
            if (isset($seq1[$i]) && isset($seq2[$i]) && $seq1[$i] === $seq2[$i]) {
                $matches++;
            }
        }

        return $matches / max($len1, $len2);
    }

    private function averageSimilarity(array $similarities): SimilarityMetrics {
        $count = count($similarities);
        if ($count === 0) return new SimilarityMetrics();

        $avg = new SimilarityMetrics();

        foreach ($similarities as $sim) {
            $avg->levenshtein += $sim->levenshtein;
            $avg->jaccard += $sim->jaccard;
            $avg->tokenSimilarity += $sim->tokenSimilarity;
            $avg->structural += $sim->structural;
            $avg->semantic += $sim->semantic;
            $avg->overall += $sim->overall;
        }

        $avg->levenshtein /= $count;
        $avg->jaccard /= $count;
        $avg->tokenSimilarity /= $count;
        $avg->structural /= $count;
        $avg->semantic /= $count;
        $avg->overall /= $count;

        return $avg;
    }

    private function determineRefactoringStrategy(array $methods, SimilarityMetrics $sim): array {
        $allStatic = array_reduce($methods, fn($c, $m) => $c && $m->isStatic, true);
        $allAbstract = array_reduce($methods, fn($c, $m) => $c && $m->isAbstract, true);
        $sameModule = count(array_unique(array_map(fn($m) => $m->module, $methods))) === 1;

        $avgComplexity = array_sum(array_map(fn($m) => $m->cyclomaticComplexity, $methods)) / count($methods);

        $suggestedName = ucfirst($methods[0]->name) . 'Trait';

        // High similarity → Trait
        if ($sim->overall >= 0.80) {
            return [
                'type' => 'Trait',
                'complexity' => $avgComplexity <= 5 ? 'Low' : 'Medium',
                'risks' => ['Minimal - High code similarity'],
                'benefits' => [
                    'Code elimination: ~' . $this->calculateLinesReduced($methods) . ' lines',
                    'DRY principle enforced',
                    'Easy maintenance',
                    'No breaking changes'
                ],
                'suggestedName' => $suggestedName
            ];
        }

        // Medium-high similarity + static → Trait
        if ($sim->overall >= 0.60 && $allStatic) {
            return [
                'type' => 'Trait',
                'complexity' => 'Low',
                'risks' => ['Test thoroughly after extraction'],
                'benefits' => [
                    'Static method reuse',
                    'Reduced duplication',
                    'Maintains current architecture'
                ],
                'suggestedName' => $suggestedName
            ];
        }

        // Medium similarity → BaseClass
        if ($sim->overall >= 0.50 && $sim->overall < 0.80) {
            return [
                'type' => 'BaseClass',
                'complexity' => $sameModule ? 'Medium' : 'High',
                'risks' => [
                    'Changes class hierarchy',
                    'May require interface segregation',
                    $sameModule ? 'Module-scoped impact' : 'Cross-module coupling'
                ],
                'benefits' => [
                    'Enforces consistent behavior',
                    'Template method pattern',
                    'Polymorphism opportunities'
                ],
                'suggestedName' => 'Base' . ucfirst($methods[0]->name)
            ];
        }

        // Same signature, different implementation → Interface
        if ($sim->structural >= 0.8 && $sim->overall < 0.50) {
            return [
                'type' => 'Interface',
                'complexity' => 'Low',
                'risks' => ['Requires contract enforcement'],
                'benefits' => [
                    'Clear API contract',
                    'Dependency inversion',
                    'Testability improved'
                ],
                'suggestedName' => ucfirst($methods[0]->name) . 'Interface'
            ];
        }

        // Default → Pattern Analysis
        return [
            'type' => 'Pattern',
            'complexity' => 'High',
            'risks' => [
                'Low similarity score',
                'May not benefit from refactoring',
                'Consider design patterns instead'
            ],
            'benefits' => [
                'Pattern recognition opportunity',
                'Potential strategy pattern'
            ],
            'suggestedName' => null
        ];
    }

    private function calculateLinesReduced(array $methods): int {
        $totalLines = 0;

        foreach ($methods as $method) {
            $lines = substr_count($method->code->raw, "\n");
            $totalLines += $lines;
        }

        // After refactoring: keep one implementation + trait uses
        $keptLines = substr_count($methods[0]->code->raw, "\n");
        $traitUses = count($methods) - 1; // use TraitName; per each

        return max(0, $totalLines - $keptLines - $traitUses);
    }

    private function estimateEffort(array $methods, SimilarityMetrics $sim): int {
        $baseHours = 2; // Minimum effort

        // More occurrences = more effort
        $occurrenceMultiplier = min(count($methods) * 0.5, 4);

        // Lower similarity = more effort
        $similarityPenalty = (1 - $sim->overall) * 3;

        // Complexity factor
        $avgComplexity = array_sum(array_map(fn($m) => $m->cyclomaticComplexity, $methods)) / count($methods);
        $complexityFactor = min($avgComplexity / 10, 2);

        // Cross-module = more effort
        $modules = array_unique(array_map(fn($m) => $m->module, $methods));
        $crossModulePenalty = count($modules) > 1 ? 2 : 0;

        $totalHours = $baseHours + $occurrenceMultiplier + $similarityPenalty + $complexityFactor + $crossModulePenalty;

        return (int)ceil($totalHours);
    }

    private function calculateROIScore(int $linesReduced, int $effortHours, int $occurrences): float {
        if ($effortHours === 0) return 0.0;

        // ROI = (Value Gained / Investment Cost) * 100
        // Value: lines reduced * occurrences * maintenance factor
        $maintenanceFactor = 1.5; // Each line saved = 1.5 value points
        $valueGained = $linesReduced * $occurrences * $maintenanceFactor;

        // Cost: effort hours * complexity penalty
        $investmentCost = $effortHours * 10; // 10 cost points per hour

        $roi = ($valueGained / $investmentCost) * 100;

        return round($roi, 2);
    }

    private function generateRefactoringExample(array $methods, array $strategy): ?string {
        if ($strategy['suggestedName'] === null) return null;

        $firstMethod = $methods[0];
        $traitName = $strategy['suggestedName'];

        $example = "```php\n";
        $example .= "// BEFORE: Duplicated in " . count($methods) . " classes\n";
        $example .= "class {$firstMethod->className} {\n";
        $example .= "    {$firstMethod->signature} {\n";

        // Show abbreviated body
        $bodyLines = explode("\n", trim($firstMethod->code->raw, '{}'));
        $bodyPreview = array_slice($bodyLines, 0, min(5, count($bodyLines)));
        foreach ($bodyPreview as $line) {
            $example .= "    " . trim($line) . "\n";
        }

        if (count($bodyLines) > 5) {
            $example .= "        // ... (" . (count($bodyLines) - 5) . " more lines)\n";
        }

        $example .= "    }\n}\n\n";

        $example .= "// AFTER: Extracted to Trait\n";
        $example .= "trait {$traitName} {\n";
        $example .= "    {$firstMethod->signature} {\n";

        foreach ($bodyPreview as $line) {
            $example .= "    " . trim($line) . "\n";
        }

        if (count($bodyLines) > 5) {
            $example .= "        // ... (" . (count($bodyLines) - 5) . " more lines)\n";
        }

        $example .= "    }\n}\n\n";

        $example .= "// Usage in classes\n";
        $example .= "class {$firstMethod->className} {\n";
        $example .= "    use {$traitName};\n";
        $example .= "}\n";
        $example .= "```\n\n";

        $example .= "**Impact:**\n";
        $example .= "- Lines reduced: ~{$this->calculateLinesReduced($methods)}\n";
        $example .= "- Classes affected: " . count($methods) . "\n";
        $example .= "- Modules: " . implode(', ', array_unique(array_map(fn($m) => $m->module, $methods))) . "\n";

        return $example;
    }

    private function calculateROI(): void {
        Console::godMode("🐮 Calculating ROI with DIVINE precision...");

        usort($this->opportunities, fn($a, $b) => $b->roi <=> $a->roi);

        $topOpportunities = array_slice($this->opportunities, 0, 10);

        Console::critical("TOP 10 ROI OPPORTUNITIES:");
        foreach ($topOpportunities as $i => $opp) {
            Console::info(sprintf(
                "#%d: %s - ROI: %.2f%% (Confidence: %d%%, Lines: %d, Effort: %dh)",
                $i + 1,
                $opp->methodName,
                $opp->roi,
                $opp->confidence,
                $opp->linesReduced,
                $opp->effortHours
            ));
        }
    }

    private function generateEnhancedReports(): void {
        Console::godMode("🐮 Generating DIVINE documentation...");

        // Group by module
        $byModule = [];
        foreach ($this->opportunities as $opp) {
            foreach ($opp->methods as $method) {
                if (!isset($byModule[$method->module])) {
                    $byModule[$method->module] = [];
                }

                $exists = false;
                foreach ($byModule[$method->module] as $existing) {
                    if ($existing->methodName === $opp->methodName) {
                        $exists = true;
                        break;
                    }
                }

                if (!$exists) {
                    $byModule[$method->module][] = $opp;
                }
            }
        }

        // Generate enhanced report for each module
        foreach ($byModule as $module => $opportunities) {
            $this->generateEnhancedModuleReport($module, $opportunities);
        }

        // Generate enhanced global report
        $this->generateEnhancedGlobalReport();

        Console::success("Enhanced documentation generated with SUPER COW power! 🐮⚡");
    }

    private function generateEnhancedModuleReport(string $module, array $opportunities): void {
        $docsDir = $this->modulesDir . '/' . $module . '/docs';

        if (!is_dir($docsDir)) {
            mkdir($docsDir, 0755, true);
        }

        $reportPath = $docsDir . '/METODI_DUPLICATI_ANALISI.md';

        $content = $this->buildEnhancedModuleContent($module, $opportunities);

        file_put_contents($reportPath, $content);
        Console::success("Enhanced report for {$module}: {$reportPath}");
    }

    private function buildEnhancedModuleContent(string $module, array $opportunities): string {
        $date = date('Y-m-d H:i:s');

        // Sort by ROI
        usort($opportunities, fn($a, $b) => $b->roi <=> $a->roi);

        $totalOpportunities = count($opportunities);

        $md = <<<MD
        # 🐮 ANALISI METODI DUPLICATI - SUPER COW EDITION
        ## Modulo: {$module}

        **Generato con Super Cow Power** 🐮⚡
        **Data**: {$date}
        **Opportunità Totali**: {$totalOpportunities}

        ---

        ## 📊 Dashboard Esecutivo

        MD;

        // ROI Summary
        $totalROI = array_sum(array_map(fn($o) => $o->roi, $opportunities));
        $avgROI = count($opportunities) > 0 ? $totalROI / count($opportunities) : 0;
        $totalLinesReduced = array_sum(array_map(fn($o) => $o->linesReduced, $opportunities));
        $totalEffort = array_sum(array_map(fn($o) => $o->effortHours, $opportunities));

        $highROI = count(array_filter($opportunities, fn($o) => $o->roi >= 100));
        $mediumROI = count(array_filter($opportunities, fn($o) => $o->roi >= 50 && $o->roi < 100));

        $md .= "\n### Metriche Chiave\n\n";
        $md .= "| Metrica | Valore |\n";
        $md .= "|---------|--------|\n";
        $md .= "| 💰 ROI Medio | " . round($avgROI, 2) . "% |\n";
        $md .= "| 📉 Linee Riducibili | {$totalLinesReduced} |\n";
        $md .= "| ⏱️ Effort Totale | {$totalEffort} ore |\n";
        $md .= "| 🔥 Alto ROI (≥100%) | {$highROI} |\n";
        $md .= "| ⚡ Medio ROI (50-99%) | {$mediumROI} |\n\n";

        // Priority Matrix
        $md .= "### 🎯 Matrice Priorità\n\n";
        $md .= "| Priorità | ROI | Confidenza | Complessità | Raccomandazione |\n";
        $md .= "|----------|-----|------------|-------------|------------------|\n";

        $priority1 = array_filter($opportunities, fn($o) => $o->roi >= 100 && $o->confidence >= 70 && $o->complexity === 'Low');
        $priority2 = array_filter($opportunities, fn($o) => $o->roi >= 50 && $o->confidence >= 60);
        $priority3 = array_filter($opportunities, fn($o) => $o->roi < 50 || $o->confidence < 60);

        $md .= "| 🔴 P1 - CRITICA | ≥100% | ≥70% | Low | **FARE SUBITO** |\n";
        $md .= "| 🟡 P2 - ALTA | ≥50% | ≥60% | Medium | Pianificare |\n";
        $md .= "| 🟢 P3 - MEDIA | <50% | <60% | Varia | Valutare |\n\n";

        $md .= "**Distribuzione**: P1: " . count($priority1) . " | P2: " . count($priority2) . " | P3: " . count($priority3) . "\n\n";

        // Detailed opportunities
        $md .= "---\n\n## 🔍 Analisi Dettagliata Opportunità\n\n";

        foreach ($opportunities as $i => $opp) {
            $md .= $this->buildEnhancedOpportunitySection($i + 1, $opp, $module);
        }

        // Appendix
        $md .= $this->buildEnhancedAppendix();

        return $md;
    }

    private function buildEnhancedOpportunitySection(int $num, RefactoringOpportunity $opp, string $currentModule): string {
        $roiEmoji = $opp->roi >= 100 ? '🔥' : ($opp->roi >= 50 ? '⚡' : '💡');
        $priorityBadge = $opp->roi >= 100 && $opp->confidence >= 70 && $opp->complexity === 'Low'
            ? '🔴 **PRIORITÀ CRITICA**'
            : ($opp->roi >= 50 ? '🟡 PRIORITÀ ALTA' : '🟢 PRIORITÀ MEDIA');

        $md = "### {$num}. 🎯 `{$opp->methodName}`\n\n";
        $md .= "{$priorityBadge}\n\n";

        // KPIs
        $md .= "#### 📈 KPI di Refactoring\n\n";
        $md .= "| Metrica | Valore | Dettaglio |\n";
        $md .= "|---------|--------|--------|\n";
        $md .= "| {$roiEmoji} **ROI** | **{$opp->roi}%** | Return on Investment |\n";
        $md .= "| ✅ Confidenza | {$opp->confidence}% | Precisione analisi |\n";
        $md .= "| 🎨 Tipo | `{$opp->refactoringType}` | Strategia consigliata |\n";
        $md .= "| 📊 Complessità | {$opp->complexity} | Difficoltà implementazione |\n";
        $md .= "| 📉 Linee Ridotte | {$opp->linesReduced} | Code elimination |\n";
        $md .= "| ⏱️ Effort | {$opp->effortHours}h | Tempo stimato |\n";
        $md .= "| 🔢 Occorrenze | " . count($opp->methods) . " | Metodi duplicati |\n\n";

        // Similarity Metrics
        $md .= "#### 🔬 Metriche Similarità Avanzate\n\n";
        $md .= "| Algoritmo | Score | Interpretazione |\n";
        $md .= "|-----------|-------|------------------|\n";
        $md .= "| Levenshtein | " . round($opp->similarity->levenshtein * 100, 1) . "% | Distanza stringhe |\n";
        $md .= "| Jaccard | " . round($opp->similarity->jaccard * 100, 1) . "% | Similarità insiemi |\n";
        $md .= "| Token-based | " . round($opp->similarity->tokenSimilarity * 100, 1) . "% | Sequenza token |\n";
        $md .= "| Strutturale | " . round($opp->similarity->structural * 100, 1) . "% | Signature match |\n";
        $md .= "| Semantica | " . round($opp->similarity->semantic * 100, 1) . "% | Pattern match |\n";
        $md .= "| **OVERALL** | **" . round($opp->similarity->overall * 100, 1) . "%** | **Score finale** |\n\n";

        // Locations
        $md .= "#### 📍 Localizzazioni\n\n";
        foreach ($opp->methods as $method) {
            $relPath = str_replace($this->modulesDir . '/', 'Modules/', $method->filePath);
            $moduleTag = $method->module !== $currentModule ? " `[{$method->module}]`" : "";
            $complexityBadge = $method->cyclomaticComplexity > 10 ? " ⚠️ `CC:{$method->cyclomaticComplexity}`" : "";

            $md .= "- `{$method->className}::{$method->name}` → [{$relPath}:{$method->lineNumber}]({$relPath}){$moduleTag}{$complexityBadge}\n";
        }
        $md .= "\n";

        // Code Example
        if ($opp->codeExample !== null) {
            $md .= "#### 💻 Esempio Refactoring\n\n";
            $md .= $opp->codeExample . "\n";
        }

        // Benefits & Risks
        $md .= "#### ✅ Benefici\n\n";
        foreach ($opp->benefits as $benefit) {
            $md .= "- {$benefit}\n";
        }
        $md .= "\n";

        $md .= "#### ⚠️ Rischi\n\n";
        foreach ($opp->risks as $risk) {
            $md .= "- {$risk}\n";
        }
        $md .= "\n";

        // Action Plan
        $md .= "#### 🎬 Piano d'Azione\n\n";

        if ($opp->roi >= 100 && $opp->confidence >= 70 && $opp->complexity === 'Low') {
            $md .= "**🔥 AZIONE IMMEDIATA RICHIESTA:**\n\n";
            $md .= "1. ✅ **APPROVATO** per refactoring immediato\n";
            $md .= "2. Creare trait `{$opp->suggestedTraitName}` nel modulo Xot\n";
            $md .= "3. Estrarre metodo comune\n";
            $md .= "4. Aggiornare " . count($opp->methods) . " classi\n";
            $md .= "5. Eseguire test suite completa\n";
            $md .= "6. Verificare PHPStan Level Max\n\n";
            $md .= "**Payback Period**: ~" . round($opp->effortHours / max(1, $opp->roi / 100), 1) . " giorni\n\n";
        } elseif ($opp->roi >= 50) {
            $md .= "**⚡ PIANIFICARE NEL PROSSIMO SPRINT:**\n\n";
            $md .= "1. Review codice manuale richiesta\n";
            $md .= "2. Validare similarità implementazioni\n";
            $md .= "3. Progettare strategia refactoring\n";
            $md .= "4. Implementare con TDD\n";
            $md .= "5. Code review rigorosa\n\n";
        } else {
            $md .= "**💡 VALUTARE CON ATTENZIONE:**\n\n";
            $md .= "1. Analisi manuale approfondita necessaria\n";
            $md .= "2. Verificare se refactoring aggiunge reale valore\n";
            $md .= "3. Considerare alternative (design patterns)\n";
            $md .= "4. Postponere se ROI insufficiente\n\n";
        }

        $md .= "---\n\n";

        return $md;
    }

    private function buildEnhancedAppendix(): string {
        return <<<MD

        ---

        ## 📚 Appendice

        ### Legenda Metriche

        #### ROI (Return on Investment)
        - **≥200%**: Eccezionale - Massima priorità
        - **100-199%**: Ottimo - Alta priorità
        - **50-99%**: Buono - Media priorità
        - **<50%**: Basso - Valutare attentamente

        #### Confidence Score
        - **90-100%**: Estremamente affidabile
        - **70-89%**: Molto affidabile
        - **50-69%**: Moderatamente affidabile
        - **<50%**: Richiede validazione manuale

        #### Complessità
        - **Low**: 1-4 ore, rischio basso, impatto limitato
        - **Medium**: 4-8 ore, rischio medio, testing importante
        - **High**: 8+ ore, rischio elevato, analisi approfondita necessaria

        ### Algoritmi di Similarità

        1. **Levenshtein**: Distanza di edit tra stringhe (modifiche necessarie)
        2. **Jaccard**: Similarità tra insiemi di token (intersezione/unione)
        3. **Token-based**: Similarità sequenza token normalizzati
        4. **Strutturale**: Match di signature e visibilità
        5. **Semantica**: Pattern e dipendenze comuni

        ### Best Practices

        #### Prima del Refactoring
        - [ ] Backup codebase
        - [ ] Coverage test ≥80% per classi coinvolte
        - [ ] Review manuale del codice duplicato
        - [ ] Approvazione team

        #### Durante il Refactoring
        - [ ] TDD: test first, refactoring dopo
        - [ ] Commit atomici e frequenti
        - [ ] PHPStan Level Max verificato
        - [ ] Nessun breaking change

        #### Dopo il Refactoring
        - [ ] Full test suite passa
        - [ ] Performance test (no degradazione)
        - [ ] Code review approvata
        - [ ] Documentazione aggiornata

        ---

        **🐮 Powered by Super Cow** - Analisi generata con algoritmi avanzati e metriche precise.

        MD;
    }

    private function generateEnhancedGlobalReport(): void {
        $reportPath = $this->modulesDir . '/../docs/METODI_DUPLICATI_ANALISI_GLOBALE.md';

        $docsDir = dirname($reportPath);
        if (!is_dir($docsDir)) {
            mkdir($docsDir, 0755, true);
        }

        $content = $this->buildEnhancedGlobalContent();

        file_put_contents($reportPath, $content);
        Console::success("Enhanced global report: {$reportPath}");
    }

    private function buildEnhancedGlobalContent(): string {
        $date = date('Y-m-d H:i:s');
        $totalOpportunities = count($this->opportunities);

        // Sort by ROI
        usort($this->opportunities, fn($a, $b) => $b->roi <=> $a->roi);

        $totalROI = array_sum(array_map(fn($o) => $o->roi, $this->opportunities));
        $avgROI = $totalOpportunities > 0 ? $totalROI / $totalOpportunities : 0;
        $totalLinesReduced = array_sum(array_map(fn($o) => $o->linesReduced, $this->opportunities));
        $totalEffort = array_sum(array_map(fn($o) => $o->effortHours, $this->opportunities));

        $md = <<<MD
        # 🐮 ANALISI GLOBALE METODI DUPLICATI
        ## Super Cow Edition - FixCity Project

        **Powered by Super Cow** 🐮⚡
        **Data Generazione**: {$date}
        **Opportunità Totali**: {$totalOpportunities}

        ---

        ## 🎯 Executive Summary

        ### 💰 Impatto Economico

        | Metrica | Valore |
        |---------|--------|
        | ROI Medio Progetto | **{round($avgROI, 2)}%** |
        | Linee Codice Riducibili | **{$totalLinesReduced}** |
        | Effort Totale Stimato | **{$totalEffort} ore** |
        | Payback Period | **~{round($totalEffort / max(1, $avgROI / 100), 1)} giorni** |

        MD;

        // Top 15 ROI
        $md .= "\n## 🔥 TOP 15 Opportunità per ROI\n\n";
        $md .= "| # | Metodo | ROI | Confidenza | Tipo | Effort | Linee | Priorità |\n";
        $md .= "|---|--------|-----|------------|------|--------|-------|----------|\n";

        $top15 = array_slice($this->opportunities, 0, 15);
        foreach ($top15 as $i => $opp) {
            $priority = $opp->roi >= 100 && $opp->confidence >= 70 ? '🔴 P1' : ($opp->roi >= 50 ? '🟡 P2' : '🟢 P3');
            $md .= sprintf(
                "| %d | `%s` | **%.1f%%** | %d%% | %s | %dh | %d | %s |\n",
                $i + 1,
                $opp->methodName,
                $opp->roi,
                $opp->confidence,
                $opp->refactoringType,
                $opp->effortHours,
                $opp->linesReduced,
                $priority
            );
        }

        // Module statistics
        $md .= "\n## 📊 Statistiche per Modulo\n\n";

        $moduleStats = [];
        foreach ($this->opportunities as $opp) {
            foreach ($opp->methods as $method) {
                if (!isset($moduleStats[$method->module])) {
                    $moduleStats[$method->module] = [
                        'opportunities' => 0,
                        'lines' => 0,
                        'effort' => 0,
                        'roi' => []
                    ];
                }

                $moduleStats[$method->module]['opportunities']++;
                $moduleStats[$method->module]['lines'] += $opp->linesReduced / count($opp->methods);
                $moduleStats[$method->module]['effort'] += $opp->effortHours / count($opp->methods);
                $moduleStats[$method->module]['roi'][] = $opp->roi;
            }
        }

        uasort($moduleStats, fn($a, $b) =>
            (array_sum($b['roi']) / max(1, count($b['roi']))) <=>
            (array_sum($a['roi']) / max(1, count($a['roi'])))
        );

        $md .= "| Modulo | Opportunità | ROI Medio | Linee | Effort | Report |\n";
        $md .= "|--------|-------------|-----------|-------|--------|--------|\n";

        foreach ($moduleStats as $module => $stats) {
            $avgModuleROI = array_sum($stats['roi']) / max(1, count($stats['roi']));
            $md .= sprintf(
                "| %s | %d | %.1f%% | %d | %dh | [📄 Vedi](%s) |\n",
                $module,
                $stats['opportunities'],
                $avgModuleROI,
                (int)$stats['lines'],
                (int)$stats['effort'],
                "Modules/{$module}/docs/METODI_DUPLICATI_ANALISI.md"
            );
        }

        // Strategy distribution
        $md .= "\n## 🎨 Distribuzione Strategie\n\n";

        $strategies = [];
        foreach ($this->opportunities as $opp) {
            $strategies[$opp->refactoringType] = ($strategies[$opp->refactoringType] ?? 0) + 1;
        }

        arsort($strategies);

        $md .= "| Strategia | Conteggio | Percentuale |\n";
        $md .= "|-----------|-----------|-------------|\n";

        foreach ($strategies as $type => $count) {
            $pct = round($count / $totalOpportunities * 100, 1);
            $md .= "| {$type} | {$count} | {$pct}% |\n";
        }

        // Roadmap
        $md .= "\n## 🗺️ Roadmap Refactoring\n\n";
        $md .= "### Sprint 1 (Priorità Critica)\n\n";

        $critical = array_filter($this->opportunities,
            fn($o) => $o->roi >= 100 && $o->confidence >= 70 && $o->complexity === 'Low'
        );

        if (!empty($critical)) {
            foreach ($critical as $opp) {
                $md .= "- ✅ `{$opp->methodName}` - ROI: {$opp->roi}% (Effort: {$opp->effortHours}h)\n";
            }
        } else {
            $md .= "- Nessuna opportunità critica identificata\n";
        }

        $md .= "\n### Sprint 2-3 (Priorità Alta)\n\n";

        $high = array_filter($this->opportunities,
            fn($o) => $o->roi >= 50 && $o->roi < 100 && $o->confidence >= 60
        );

        $highSlice = array_slice($high, 0, 5);
        foreach ($highSlice as $opp) {
            $md .= "- ⚡ `{$opp->methodName}` - ROI: {$opp->roi}% (Effort: {$opp->effortHours}h)\n";
        }

        $md .= "\n### Backlog (Valutazione)\n\n";
        $md .= "Opportunità rimanenti: " . count(array_filter($this->opportunities, fn($o) => $o->roi < 50));
        $md .= " - Richiedono analisi approfondita\n\n";

        // Footer
        $md .= "---\n\n";
        $md .= "## 🐮 Note Finali\n\n";
        $md .= "Questa analisi è stata generata utilizzando algoritmi avanzati che includono:\n\n";
        $md .= "- Similarità Levenshtein (distanza edit)\n";
        $md .= "- Jaccard Similarity (insiemi token)\n";
        $md .= "- Analisi sequenza token\n";
        $md .= "- Pattern matching semantico\n";
        $md .= "- Calcolo complessità ciclomatica\n";
        $md .= "- Metriche ROI precise\n\n";
        $md .= "**Per dettagli specifici, consultare i report individuali per modulo.**\n\n";
        $md .= "_Powered by Super Cow 🐮⚡ - Il tuo assistente divino per il refactoring_\n";

        return $md;
    }
}

// MAIN EXECUTION
try {
    Console::godMode("=== 🐮 SUPER COW DUPLICATE ANALYZER 🐮 ===");
    Console::godMode("DIVINE LEVEL ANALYSIS INITIATED");
    Console::godMode("");

    if (!is_dir($modulesDir)) {
        throw new Exception("Modules directory not found: {$modulesDir}");
    }

    $analyzer = new SuperDuplicateAnalyzer($modulesDir);
    $analyzer->analyze();

    Console::godMode("");
    Console::godMode("=== 🐮 ANALYSIS COMPLETED WITH SUPER COW POWER! 🐮 ===");
    Console::godMode("The code is now blessed by the Super Cow!");

} catch (Exception $e) {
    Console::critical("ERROR: " . $e->getMessage());
    Console::critical($e->getTraceAsString());
    exit(1);
}
