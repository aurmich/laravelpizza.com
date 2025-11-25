#!/bin/bash

# Script per eseguire analisi completa con tutti gli strumenti
# Data: 2025-01-06
# Posizione: bashscripts/analysis/run-all-analysis.sh

set -e

# Script deve essere eseguito dalla root del progetto
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/../.." && pwd)"
LARAVEL_DIR="$PROJECT_ROOT/laravel"

cd "$LARAVEL_DIR" || exit 1

# Colori per output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Array moduli
MODULES=(
    "Activity"
    "Cms"
    "Employee"
    "Gdpr"
    "Geo"
    "Job"
    "Lang"
    "Media"
    "Notify"
    "TechPlanner"
    "Tenant"
    "UI"
    "User"
    "Xot"
)

# Crea directory reports
mkdir -p reports

# Header
echo -e "${BLUE}========================================${NC}"
echo -e "${BLUE}Analisi Completa Strumenti Qualità Codice${NC}"
echo -e "${BLUE}Data: $(date)${NC}"
echo -e "${BLUE}========================================${NC}"
echo ""

# Funzione per eseguire PHPStan
run_phpstan() {
    local module=$1
    echo -e "${YELLOW}[PHPStan]${NC} Analizzando modulo $module..."
    ./vendor/bin/phpstan analyse "Modules/$module" --level=10 --memory-limit=2G --no-progress 2>&1 | tee "reports/phpstan-$module.txt" || true
}

# Funzione per eseguire PHPMD
run_phpmd() {
    local module=$1
    if [ -f "./vendor/bin/phpmd" ]; then
        echo -e "${YELLOW}[PHPMD]${NC} Analizzando modulo $module..."
        ./vendor/bin/phpmd "Modules/$module" text cleancode,codesize,controversial,design,naming,unusedcode 2>&1 | tee "reports/phpmd-$module.txt" || true
    else
        echo -e "${RED}[PHPMD]${NC} Non installato, skip..."
    fi
}

# Funzione per eseguire PHPInsights
run_phpinsights() {
    local module=$1
    if [ -f "./vendor/bin/phpinsights" ]; then
        echo -e "${YELLOW}[PHPInsights]${NC} Analizzando modulo $module..."
        ./vendor/bin/phpinsights analyse "Modules/$module" --no-interaction --format=json 2>&1 | tee "reports/phpinsights-$module.json" || true
    else
        echo -e "${RED}[PHPInsights]${NC} Non installato, skip..."
    fi
}

# Funzione per eseguire Rector
run_rector() {
    local module=$1
    if [ -f "./vendor/bin/rector" ]; then
        echo -e "${YELLOW}[Rector]${NC} Analizzando modulo $module..."
        ./vendor/bin/rector process "Modules/$module" --dry-run --no-progress-bar 2>&1 | tee "reports/rector-$module.txt" || true
    else
        echo -e "${RED}[Rector]${NC} Non installato, skip..."
    fi
}

# Analizza ogni modulo
for module in "${MODULES[@]}"; do
    echo -e "${GREEN}========================================${NC}"
    echo -e "${GREEN}Modulo: $module${NC}"
    echo -e "${GREEN}========================================${NC}"
    echo ""
    
    # PHPStan
    run_phpstan "$module"
    echo ""
    
    # PHPMD
    run_phpmd "$module"
    echo ""
    
    # PHPInsights
    run_phpinsights "$module"
    echo ""
    
    # Rector
    run_rector "$module"
    echo ""
    
    echo -e "${GREEN}Modulo $module completato${NC}"
    echo ""
done

echo -e "${BLUE}========================================${NC}"
echo -e "${BLUE}Analisi completata!${NC}"
echo -e "${BLUE}Report salvati in: reports/${NC}"
echo -e "${BLUE}========================================${NC}"

