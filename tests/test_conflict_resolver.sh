#!/bin/bash
# ==============================================================================
# Test Suite per Git Conflict Resolver
# ==============================================================================
# Test automatici per verificare il corretto funzionamento dello script
# di risoluzione conflitti Git.
#
# Uso: ./tests/test_conflict_resolver.sh
#
# Autore: AI Assistant + Laraxot Team
# Versione: 1.0
# ==============================================================================

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
LIB_DIR="$SCRIPT_DIR/../lib"
TEST_DIR="$SCRIPT_DIR/temp_test_$$"

# Colori
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[0;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Contatori
TESTS_RUN=0
TESTS_PASSED=0
TESTS_FAILED=0

# ==============================================================================
# FUNZIONI UTILITY
# ==============================================================================

log_test() {
    echo -e "${BLUE}[TEST]${NC} $1"
}

log_pass() {
    echo -e "${GREEN}[PASS]${NC} $1"
    ((TESTS_PASSED++))
}

log_fail() {
    echo -e "${RED}[FAIL]${NC} $1"
    ((TESTS_FAILED++))
}

setup_test_env() {
    mkdir -p "$TEST_DIR"
    log_test "Test environment created: $TEST_DIR"
}

cleanup_test_env() {
    rm -rf "$TEST_DIR"
    log_test "Test environment cleaned up"
}

create_conflict_file() {
    local file="$1"
    local strategy="${2:-simple}"
    
    case "$strategy" in
        simple)
            cat > "$file" << 'EOF'
<?php
namespace Test;

class Example
{
<<<<<<< HEAD
    public function methodA()
    {
        return 'version A';
    }
=======
    public function methodB()
    {
        return 'version B';
    }
>>>>>>> branch
}
EOF
            ;;
        nested)
            cat > "$file" << 'EOF'
<?php
namespace Test;

class Example
{
<<<<<<< HEAD
    public function method1()
    {
<<<<<<< HEAD
        return 'nested A';
=======
        return 'nested B';
>>>>>>> inner
    }
=======
    public function method2()
    {
        return 'outer B';
    }
>>>>>>> outer
}
EOF
            ;;
        multiple)
            cat > "$file" << 'EOF'
<?php
namespace Test;

class Example
{
<<<<<<< HEAD
    public $varA = 'A';
=======
    public $varB = 'B';
>>>>>>> branch1

    public function method()
    {
<<<<<<< HEAD
        return 'method A';
=======
        return 'method B';
>>>>>>> branch2
    }
}
EOF
            ;;
    esac
}

# ==============================================================================
# TEST CASES
# ==============================================================================

test_library_load() {
    ((TESTS_RUN++))
    log_test "Testing library load..."
    
    if [ -f "$LIB_DIR/git_conflict_resolver.sh" ]; then
        source "$LIB_DIR/git_conflict_resolver.sh"
        log_pass "Library loaded successfully"
        return 0
    else
        log_fail "Library not found at $LIB_DIR/git_conflict_resolver.sh"
        return 1
    fi
}

test_conflict_detection() {
    ((TESTS_RUN++))
    log_test "Testing conflict detection..."
    
    local test_file="$TEST_DIR/test_conflict.php"
    create_conflict_file "$test_file" "simple"
    
    if gcr_has_conflicts "$test_file"; then
        log_pass "Conflict detected correctly"
        return 0
    else
        log_fail "Failed to detect conflict"
        return 1
    fi
}

test_conflict_count() {
    ((TESTS_RUN++))
    log_test "Testing conflict counting..."
    
    local test_file="$TEST_DIR/test_multiple.php"
    create_conflict_file "$test_file" "multiple"
    
    local count=$(gcr_count_conflicts "$test_file")
    
    if [ "$count" -eq 2 ]; then
        log_pass "Counted 2 conflicts correctly"
        return 0
    else
        log_fail "Expected 2 conflicts, got $count"
        return 1
    fi
}

test_resolve_incoming() {
    ((TESTS_RUN++))
    log_test "Testing incoming strategy resolution..."
    
    local test_file="$TEST_DIR/test_incoming.php"
    create_conflict_file "$test_file" "simple"
    
    gcr_resolve_file "$test_file" "incoming" > /dev/null 2>&1
    
    if ! gcr_has_conflicts "$test_file" && grep -q "methodB" "$test_file"; then
        log_pass "Incoming strategy resolved correctly"
        return 0
    else
        log_fail "Incoming strategy failed"
        return 1
    fi
}

test_resolve_head() {
    ((TESTS_RUN++))
    log_test "Testing head strategy resolution..."
    
    local test_file="$TEST_DIR/test_head.php"
    create_conflict_file "$test_file" "simple"
    
    gcr_resolve_file "$test_file" "head" > /dev/null 2>&1
    
    if ! gcr_has_conflicts "$test_file" && grep -q "methodA" "$test_file"; then
        log_pass "Head strategy resolved correctly"
        return 0
    else
        log_fail "Head strategy failed"
        return 1
    fi
}

test_resolve_both() {
    ((TESTS_RUN++))
    log_test "Testing both strategy resolution..."
    
    local test_file="$TEST_DIR/test_both.php"
    create_conflict_file "$test_file" "simple"
    
    gcr_resolve_file "$test_file" "both" > /dev/null 2>&1
    
    if ! gcr_has_conflicts "$test_file" && grep -q "methodA" "$test_file" && grep -q "methodB" "$test_file"; then
        log_pass "Both strategy resolved correctly"
        return 0
    else
        log_fail "Both strategy failed"
        return 1
    fi
}

test_binary_detection() {
    ((TESTS_RUN++))
    log_test "Testing binary file detection..."
    
    # Crea un file binario finto
    local test_file="$TEST_DIR/test.bin"
    printf '\x00\x01\x02\x03' > "$test_file"
    
    if gcr_is_binary "$test_file"; then
        log_pass "Binary file detected correctly"
        return 0
    else
        log_fail "Failed to detect binary file"
        return 1
    fi
}

test_no_conflict_file() {
    ((TESTS_RUN++))
    log_test "Testing file without conflicts..."
    
    local test_file="$TEST_DIR/test_clean.php"
    cat > "$test_file" << 'EOF'
<?php
namespace Test;

class Clean
{
    public function method()
    {
        return 'clean';
    }
}
EOF
    
    if ! gcr_has_conflicts "$test_file"; then
        log_pass "No conflict detected correctly"
        return 0
    else
        log_fail "False positive conflict detection"
        return 1
    fi
}

test_script_help() {
    ((TESTS_RUN++))
    log_test "Testing script help output..."
    
    if "$SCRIPT_DIR/../resolve_conflicts_incoming.sh" --help > /dev/null 2>&1; then
        log_pass "Help command works"
        return 0
    else
        log_fail "Help command failed"
        return 1
    fi
}

test_script_dry_run() {
    ((TESTS_RUN++))
    log_test "Testing script dry-run mode..."
    
    local test_file="$TEST_DIR/test_dryrun.php"
    create_conflict_file "$test_file" "simple"
    
    "$SCRIPT_DIR/../resolve_conflicts_incoming.sh" \
        --target "$TEST_DIR" \
        --dry-run \
        --strategy incoming > /dev/null 2>&1
    
    # Il file dovrebbe ancora avere conflitti (dry-run non modifica)
    if gcr_has_conflicts "$test_file"; then
        log_pass "Dry-run mode works (file unchanged)"
        return 0
    else
        log_fail "Dry-run mode failed (file was modified)"
        return 1
    fi
}

# ==============================================================================
# ESECUZIONE TEST
# ==============================================================================

main() {
    echo ""
    echo "╔══════════════════════════════════════════════════════════════╗"
    echo "║         GIT CONFLICT RESOLVER - TEST SUITE                   ║"
    echo "╚══════════════════════════════════════════════════════════════╝"
    echo ""
    
    setup_test_env
    
    # Carica libreria
    if [ -f "$LIB_DIR/git_conflict_resolver.sh" ]; then
        source "$LIB_DIR/git_conflict_resolver.sh"
    else
        echo -e "${RED}ERROR: Library not found!${NC}"
        exit 1
    fi
    
    # Esegui test
    test_library_load || true
    test_conflict_detection || true
    test_conflict_count || true
    test_resolve_incoming || true
    test_resolve_head || true
    test_resolve_both || true
    test_binary_detection || true
    test_no_conflict_file || true
    test_script_help || true
    test_script_dry_run || true
    
    cleanup_test_env
    
    # Risultati
    echo ""
    echo "╔══════════════════════════════════════════════════════════════╗"
    echo "║                      TEST RESULTS                            ║"
    echo "╚══════════════════════════════════════════════════════════════╝"
    echo ""
    echo -e "Total tests:  ${BLUE}$TESTS_RUN${NC}"
    echo -e "Passed:       ${GREEN}$TESTS_PASSED${NC}"
    echo -e "Failed:       ${RED}$TESTS_FAILED${NC}"
    echo ""
    
    if [ $TESTS_FAILED -eq 0 ]; then
        echo -e "${GREEN}✅ ALL TESTS PASSED!${NC}"
        exit 0
    else
        echo -e "${RED}❌ SOME TESTS FAILED!${NC}"
        exit 1
    fi
}

# Esegui main
main "$@"
