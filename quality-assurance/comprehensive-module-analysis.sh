#!/bin/bash

################################################################################
# PTVX - Comprehensive Module Quality Analysis
################################################################################
#
# Description: Analizza tutti i moduli Laravel con PHPStan Level 10, PHPMD
#              e PHPInsights, generando un report markdown completo
#
# Category: quality-assurance
# Author: Claude Code
# Created: 2025-11-25
# Version: 1.0.0
#
# Usage:
#   cd laravel
#   ../bashscripts/quality-assurance/comprehensive-module-analysis.sh [output_file]
#
# Arguments:
#   output_file  - Path del file report (default: ../report.md)
#
# Requirements:
#   - PHPStan (./vendor/bin/phpstan)
#   - PHPMD (./vendor/bin/phpmd) [optional]
#   - PHPInsights (./vendor/bin/phpinsights) [optional]
#
# Exit Codes:
#   0 - Success
#   1 - Error during execution
#
################################################################################

set -euo pipefail

# Colors
readonly RED='\033[0;31m'
readonly GREEN='\033[0;32m'
readonly YELLOW='\033[1;33m'
readonly BLUE='\033[0;34m'
readonly NC='\033[0m'

# Configuration
readonly OUTPUT_FILE="${1:-../report.md}"
readonly TEMP_DIR="/tmp/module_analysis_$$"

# Create temp directory
mkdir -p "${TEMP_DIR}"
trap 'rm -rf "${TEMP_DIR}"' EXIT

# Logging functions
log_info() { echo -e "${BLUE}ℹ${NC} $*"; }
log_success() { echo -e "${GREEN}✔${NC} $*"; }
log_warning() { echo -e "${YELLOW}⚠${NC} $*"; }
log_error() { echo -e "${RED}✖${NC} $*" >&2; }

# Get modules list
get_modules() {
    ls -1 Modules/ | grep -v "^generate_docs.sh$" | sort
}

# Analyze module with PHPStan
analyze_phpstan() {
    local module="$1"
    local output_file="${TEMP_DIR}/phpstan_${module}.txt"
    
    if timeout 120 ./vendor/bin/phpstan analyse "Modules/${module}" \
        --level=10 \
        --no-progress \
        2>&1 | tee "${output_file}" | grep -q "\[OK\]"; then
        echo "OK:0"
    else
        local errors=$(grep -c "^.*:.*:" "${output_file}" 2>/dev/null || echo "0")
        echo "ERRORS:${errors}"
    fi
}

# Analyze module with PHPMD
analyze_phpmd() {
    local module="$1"
    local output_file="${TEMP_DIR}/phpmd_${module}.txt"
    
    if [[ ! -f "./vendor/bin/phpmd" ]]; then
        echo "SKIP:Tool not installed"
        return
    fi
    
    if ./vendor/bin/phpmd "Modules/${module}" text cleancode,codesize,design,naming \
        --suffixes php \
        > "${output_file}" 2>&1; then
        echo "OK:0"
    else
        local issues=$(wc -l < "${output_file}")
        echo "WARNINGS:${issues}"
    fi
}

# Analyze module with PHPInsights
analyze_phpinsights() {
    local module="$1"
    local output_file="${TEMP_DIR}/phpinsights_${module}.txt"
    
    if [[ ! -f "./vendor/bin/phpinsights" ]]; then
        echo "SKIP:Tool not installed"
        return
    fi
    
    if timeout 60 ./vendor/bin/phpinsights analyse "Modules/${module}" \
        --no-interaction \
        --min-quality=0 \
        --min-complexity=0 \
        --min-architecture=0 \
        --min-style=0 \
        > "${output_file}" 2>&1; then
        echo "OK:Check output"
    else
        echo "ERRORS:See logs"
    fi
}

# Generate report header
generate_header() {
    cat << EOF
# 📊 PTVX - Comprehensive Module Quality Analysis Report

> **Generated**: $(date '+%Y-%m-%d %H:%M:%S')  
> **Project**: PTVX Fila4 Mono  
> **Analysis Tools**: PHPStan Level 10, PHPMD, PHPInsights  

---

## 📋 Executive Summary

This report provides a comprehensive quality analysis of all Laravel modules using:
- **PHPStan Level 10**: Static analysis with strict type checking
- **PHPMD**: PHP Mess Detector for code quality issues
- **PHPInsights**: Overall code quality metrics

EOF
}

# Generate module report
generate_module_report() {
    local module="$1"
    
    cat << EOF

### 📦 Module: \`${module}\`

EOF
    
    # PHPStan analysis
    log_info "Analyzing ${module} with PHPStan Level 10..."
    local phpstan_result=$(analyze_phpstan "${module}")
    local phpstan_status="${phpstan_result%%:*}"
    local phpstan_count="${phpstan_result##*:}"
    
    if [[ "${phpstan_status}" == "OK" ]]; then
        cat << EOF
#### ✅ PHPStan Level 10

**Status**: PASS  
**Errors**: 0  

All type checks passed successfully.

EOF
    else
        cat << EOF
#### ❌ PHPStan Level 10

**Status**: FAIL  
**Errors**: ${phpstan_count}  

<details>
<summary>View Errors</summary>

\`\`\`
$(cat "${TEMP_DIR}/phpstan_${module}.txt" | head -100)
\`\`\`

$(( $(cat "${TEMP_DIR}/phpstan_${module}.txt" | wc -l) > 100 )) && echo "*Output truncated. See full log for details.*"

</details>

EOF
    fi
    
    # PHPMD analysis
    log_info "Analyzing ${module} with PHPMD..."
    local phpmd_result=$(analyze_phpmd "${module}")
    local phpmd_status="${phpmd_result%%:*}"
    local phpmd_info="${phpmd_result##*:}"
    
    case "${phpmd_status}" in
        "OK")
            cat << EOF
#### ✅ PHPMD

**Status**: PASS  
**Issues**: 0  

No code quality issues detected.

EOF
            ;;
        "SKIP")
            cat << EOF
#### ⚠️ PHPMD

**Status**: SKIPPED  
**Reason**: ${phpmd_info}

EOF
            ;;
        "WARNINGS")
            cat << EOF
#### ⚠️ PHPMD

**Status**: WARNINGS  
**Issues**: ${phpmd_info}  

<details>
<summary>View Issues</summary>

\`\`\`
$(cat "${TEMP_DIR}/phpmd_${module}.txt" | head -50)
\`\`\`

</details>

EOF
            ;;
    esac
    
    # PHPInsights analysis
    log_info "Analyzing ${module} with PHPInsights..."
    local phpinsights_result=$(analyze_phpinsights "${module}")
    local phpinsights_status="${phpinsights_result%%:*}"
    
    case "${phpinsights_status}" in
        "OK")
            cat << EOF
#### ℹ️ PHPInsights

**Status**: COMPLETED  

Analysis completed. Check detailed output for metrics.

EOF
            ;;
        "SKIP")
            cat << EOF
#### ⚠️ PHPInsights

**Status**: SKIPPED  
**Reason**: Tool not installed

EOF
            ;;
        "ERRORS")
            cat << EOF
#### ⚠️ PHPInsights

**Status**: ERRORS  

Analysis completed with errors. Check logs for details.

EOF
            ;;
    esac
    
    echo "---"
}

# Generate footer
generate_footer() {
    cat << EOF

## 🎯 Recommendations

### Immediate Actions

1. **Fix PHPStan Level 10 Errors**
   - Focus on modules with HIGH error counts
   - Address type safety issues
   - Add missing PHPDoc annotations

2. **Review PHPMD Warnings**
   - Reduce code complexity
   - Follow naming conventions
   - Eliminate unused code

3. **Improve Overall Quality**
   - Use PHPInsights metrics as guide
   - Follow PSR-12 standards
   - Increase test coverage

### Quality Standards (PTVX)

- ✅ **PHPStan Level 10**: 0 errors (mandatory)
- ✅ **PHPMD**: No critical violations
- ✅ **PHPInsights**: Score > 80%
- ✅ **PSR-12**: Compliant (use \`vendor/bin/pint\`)
- ✅ **Test Coverage**: > 80%

---

## 📚 Resources

- [PHPStan Documentation](https://phpstan.org/)
- [PHPMD Rules](https://phpmd.org/rules/index.html)
- [PHPInsights](https://phpinsights.com/)
- [Project Guidelines](CLAUDE.md)

---

**Generated by**: \`bashscripts/quality-assurance/comprehensive-module-analysis.sh\`  
**Documentation**: See \`../bashscripts/docs/\` for script documentation

EOF
}

# Main function
main() {
    log_info "Starting comprehensive module analysis..."
    log_info "Output file: ${OUTPUT_FILE}"
    
    # Initialize report
    generate_header > "${OUTPUT_FILE}"
    
    # Get modules
    mapfile -t modules < <(get_modules)
    log_info "Found ${#modules[@]} modules to analyze"
    
    # Add modules count to summary
    cat >> "${OUTPUT_FILE}" << EOF

**Total Modules**: ${#modules[@]}

---

## 📦 Module Analysis

EOF
    
    # Analyze each module
    for module in "${modules[@]}"; do
        log_info "Processing module: ${module}"
        generate_module_report "${module}" >> "${OUTPUT_FILE}"
    done
    
    # Add footer
    generate_footer >> "${OUTPUT_FILE}"
    
    log_success "Analysis complete!"
    log_success "Report saved to: ${OUTPUT_FILE}"
}

# Execute main
main "$@"
