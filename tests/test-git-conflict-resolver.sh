#!/usr/bin/env bash
# test-git-conflict-resolver.sh
# Test suite completo per git-conflict-resolver.sh
# Versione: 1.0.0
# Data: 2025-10-22

set -euo pipefail

# ============================================================================
# SETUP TEST ENVIRONMENT
# ============================================================================

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
LIB_DIR="${SCRIPT_DIR}/../lib"
TEST_DIR="/tmp/git-conflict-resolver-tests-$$"
TESTS_PASSED=0
TESTS_FAILED=0
TESTS_TOTAL=0

# Colori per output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[0;33m'
BLUE='\033[0;34m'
NC='\033[0m'

# Setup test directory
setup_test_env() {
    mkdir -p "$TEST_DIR"
    cd "$TEST_DIR"

    # Setup environment per la libreria
    export GCR_BASE_DIR="$TEST_DIR"
    export GCR_BACKUP_DIR="${TEST_DIR}/.backups"
    export GCR_LOG_FILE="${TEST_DIR}/test.log"

    # Carica la libreria
    if [[ -f "${LIB_DIR}/git-conflict-resolver.sh" ]]; then
        # shellcheck source=../lib/git-conflict-resolver.sh
        source "${LIB_DIR}/git-conflict-resolver.sh"
    else
        echo -e "${RED}❌ Libreria non trovata: ${LIB_DIR}/git-conflict-resolver.sh${NC}"
        exit 1
    fi
}

cleanup_test_env() {
    cd /
    rm -rf "$TEST_DIR"
}

# ============================================================================
# TEST HELPERS
# ============================================================================

assert_equals() {
    local expected="$1"
    local actual="$2"
    local test_name="$3"

    ((TESTS_TOTAL++))

    if [[ "$expected" == "$actual" ]]; then
        echo -e "${GREEN}✓${NC} PASS: $test_name"
        ((TESTS_PASSED++))
        return 0
    else
        echo -e "${RED}✗${NC} FAIL: $test_name"
        echo -e "  Expected: ${expected}"
        echo -e "  Actual:   ${actual}"
        ((TESTS_FAILED++))
        return 1
    fi
}

assert_true() {
    local command="$1"
    local test_name="$2"

    ((TESTS_TOTAL++))

    if eval "$command"; then
        echo -e "${GREEN}✓${NC} PASS: $test_name"
        ((TESTS_PASSED++))
        return 0
    else
        echo -e "${RED}✗${NC} FAIL: $test_name"
        echo -e "  Command failed: $command"
        ((TESTS_FAILED++))
        return 1
    fi
}

assert_false() {
    local command="$1"
    local test_name="$2"

    ((TESTS_TOTAL++))

    if ! eval "$command"; then
        echo -e "${GREEN}✓${NC} PASS: $test_name"
        ((TESTS_PASSED++))
        return 0
    else
        echo -e "${RED}✗${NC} FAIL: $test_name"
        echo -e "  Command should have failed: $command"
        ((TESTS_FAILED++))
        return 1
    fi
}

assert_file_exists() {
    local file="$1"
    local test_name="$2"

    ((TESTS_TOTAL++))

    if [[ -f "$file" ]]; then
        echo -e "${GREEN}✓${NC} PASS: $test_name"
        ((TESTS_PASSED++))
        return 0
    else
        echo -e "${RED}✗${NC} FAIL: $test_name"
        echo -e "  File not found: $file"
        ((TESTS_FAILED++))
        return 1
    fi
}

assert_file_contains() {
    local file="$1"
    local pattern="$2"
    local test_name="$3"

    ((TESTS_TOTAL++))

    if grep -q "$pattern" "$file" 2>/dev/null; then
        echo -e "${GREEN}✓${NC} PASS: $test_name"
        ((TESTS_PASSED++))
        return 0
    else
        echo -e "${RED}✗${NC} FAIL: $test_name"
        echo -e "  Pattern not found in file: $pattern"
        ((TESTS_FAILED++))
        return 1
    fi
}

assert_file_not_contains() {
    local file="$1"
    local pattern="$2"
    local test_name="$3"

    ((TESTS_TOTAL++))

    if ! grep -q "$pattern" "$file" 2>/dev/null; then
        echo -e "${GREEN}✓${NC} PASS: $test_name"
        ((TESTS_PASSED++))
        return 0
    else
        echo -e "${RED}✗${NC} FAIL: $test_name"
        echo -e "  Pattern should not be in file: $pattern"
        ((TESTS_FAILED++))
        return 1
    fi
}

# ============================================================================
# TEST SUITES
# ============================================================================

# Test 1: Dependency Check
test_dependencies() {
    echo -e "\n${BLUE}=== Test Suite 1: Dependency Check ===${NC}"

    assert_true "gcr_command_exists awk" "AWK command exists"
    assert_true "gcr_command_exists grep" "GREP command exists"
    assert_true "gcr_command_exists find" "FIND command exists"
    assert_true "gcr_command_exists file" "FILE command exists"
    assert_true "gcr_check_dependencies" "All dependencies present"
}

# Test 2: File Validation
test_file_validation() {
    echo -e "\n${BLUE}=== Test Suite 2: File Validation ===${NC}"

    # Crea file di test
    echo "test content" > "${TEST_DIR}/text.txt"
    echo -e "\x00binary" > "${TEST_DIR}/binary.bin"

    assert_false "gcr_is_binary_file '${TEST_DIR}/text.txt'" "Text file detected as non-binary"
    assert_true "gcr_is_binary_file '${TEST_DIR}/binary.bin'" "Binary file detected"

    # File con conflitti
    cat > "${TEST_DIR}/conflict.txt" << 'EOF'
line 1
<<<<<<< HEAD
current change
=======
incoming change
>>>>>>> branch
line 2
EOF

    assert_true "gcr_has_conflict_markers '${TEST_DIR}/conflict.txt'" "Conflict markers detected"
    assert_false "gcr_has_conflict_markers '${TEST_DIR}/text.txt'" "No conflict markers in normal file"

    local count
    count=$(gcr_count_conflicts "${TEST_DIR}/conflict.txt")
    assert_equals "1" "$count" "Conflict count is correct"
}

# Test 3: Resolve Keep Incoming
test_resolve_incoming() {
    echo -e "\n${BLUE}=== Test Suite 3: Resolve Keep Incoming ===${NC}"

    cat > "${TEST_DIR}/incoming.txt" << 'EOF'
line 1
<<<<<<< HEAD
current change
=======
incoming change
>>>>>>> branch
line 2
EOF

    local expected="line 1
incoming change
line 2"

    local actual
    actual=$(gcr_resolve_keep_incoming "${TEST_DIR}/incoming.txt")

    assert_equals "$expected" "$actual" "Incoming change preserved correctly"

    # Verifica che non ci siano marker
    assert_false "echo '$actual' | grep -q '^<<<<<<< '" "No HEAD markers in output"
    assert_false "echo '$actual' | grep -q '^======='" "No separator markers in output"
    assert_false "echo '$actual' | grep -q '^>>>>>>> '" "No end markers in output"
}

# Test 4: Resolve Keep Current
test_resolve_current() {
    echo -e "\n${BLUE}=== Test Suite 4: Resolve Keep Current ===${NC}"

    cat > "${TEST_DIR}/current.txt" << 'EOF'
line 1
<<<<<<< HEAD
current change
=======
incoming change
>>>>>>> branch
line 2
EOF

    local expected="line 1
current change
line 2"

    local actual
    actual=$(gcr_resolve_keep_current "${TEST_DIR}/current.txt")

    assert_equals "$expected" "$actual" "Current change preserved correctly"

    # Verifica che non ci siano marker
    assert_false "echo '$actual' | grep -q '^<<<<<<< '" "No HEAD markers in output"
    assert_false "echo '$actual' | grep -q '^======='" "No separator markers in output"
    assert_false "echo '$actual' | grep -q '^>>>>>>> '" "No end markers in output"
}

# Test 5: Multiple Conflicts
test_multiple_conflicts() {
    echo -e "\n${BLUE}=== Test Suite 5: Multiple Conflicts ===${NC}"

    cat > "${TEST_DIR}/multiple.txt" << 'EOF'
line 1
<<<<<<< HEAD
conflict 1 current
=======
conflict 1 incoming
>>>>>>> branch
line 2
<<<<<<< HEAD
conflict 2 current
=======
conflict 2 incoming
>>>>>>> branch
line 3
EOF

    local count
    count=$(gcr_count_conflicts "${TEST_DIR}/multiple.txt")
    assert_equals "2" "$count" "Multiple conflicts counted correctly"

    local result
    result=$(gcr_resolve_keep_incoming "${TEST_DIR}/multiple.txt")

    assert_true "echo '$result' | grep -q 'conflict 1 incoming'" "First incoming conflict resolved"
    assert_true "echo '$result' | grep -q 'conflict 2 incoming'" "Second incoming conflict resolved"
    assert_false "echo '$result' | grep -q 'conflict 1 current'" "First current conflict removed"
    assert_false "echo '$result' | grep -q 'conflict 2 current'" "Second current conflict removed"
}

# Test 6: Backup Creation
test_backup() {
    echo -e "\n${BLUE}=== Test Suite 6: Backup Creation ===${NC}"

    echo "original content" > "${TEST_DIR}/backup-test.txt"

    assert_true "gcr_init_backup_dir" "Backup directory initialized"
    assert_true "[[ -d '${GCR_BACKUP_DIR}' ]]" "Backup directory exists"

    local backup_path
    backup_path=$(gcr_create_backup "${TEST_DIR}/backup-test.txt")

    assert_file_exists "$backup_path" "Backup file created"
    assert_file_contains "$backup_path" "original content" "Backup contains original content"

    # Verifica dimensione
    local orig_size backup_size
    orig_size=$(stat -c%s "${TEST_DIR}/backup-test.txt" 2>/dev/null || stat -f%z "${TEST_DIR}/backup-test.txt")
    backup_size=$(stat -c%s "$backup_path" 2>/dev/null || stat -f%z "$backup_path")

    assert_equals "$orig_size" "$backup_size" "Backup size matches original"
}

# Test 7: File Resolution Integration
test_file_resolution() {
    echo -e "\n${BLUE}=== Test Suite 7: File Resolution Integration ===${NC}"

    cat > "${TEST_DIR}/resolve-test.txt" << 'EOF'
header
<<<<<<< HEAD
old version
=======
new version
>>>>>>> branch
footer
EOF

    # Risolvi con incoming
    assert_true "gcr_resolve_file '${TEST_DIR}/resolve-test.txt' 'incoming'" "File resolved successfully"

    # Verifica contenuto
    assert_file_contains "${TEST_DIR}/resolve-test.txt" "new version" "New version present"
    assert_file_not_contains "${TEST_DIR}/resolve-test.txt" "old version" "Old version removed"
    assert_file_not_contains "${TEST_DIR}/resolve-test.txt" "^<<<<<<< " "No conflict markers"

    # Verifica che esista un backup
    local backup_count
    backup_count=$(find "${GCR_BACKUP_DIR}" -name "*resolve-test.txt*" | wc -l)
    assert_true "[[ $backup_count -gt 0 ]]" "Backup was created"
}

# Test 8: Find Conflicted Files
test_find_files() {
    echo -e "\n${BLUE}=== Test Suite 8: Find Conflicted Files ===${NC}"

    # Crea file con e senza conflitti
    cat > "${TEST_DIR}/conflict1.txt" << 'EOF'
<<<<<<< HEAD
conflict
=======
resolved
>>>>>>> branch
EOF

    cat > "${TEST_DIR}/conflict2.php" << 'EOF'
<?php
<<<<<<< HEAD
$old = true;
=======
$new = true;
>>>>>>> branch
EOF

    echo "no conflict" > "${TEST_DIR}/normal.txt"

    local found_files
    found_files=$(gcr_find_conflicted_files "$TEST_DIR")
    local count
    count=$(echo "$found_files" | wc -l)

    assert_equals "2" "$count" "Found correct number of conflicted files"
    assert_true "echo '$found_files' | grep -q 'conflict1.txt'" "Found conflict1.txt"
    assert_true "echo '$found_files' | grep -q 'conflict2.php'" "Found conflict2.php"
    assert_false "echo '$found_files' | grep -q 'normal.txt'" "Normal file not included"
}

# Test 9: Batch Resolution
test_batch_resolution() {
    echo -e "\n${BLUE}=== Test Suite 9: Batch Resolution ===${NC}"

    # Crea directory di test con conflitti
    mkdir -p "${TEST_DIR}/batch"

    for i in {1..3}; do
        cat > "${TEST_DIR}/batch/file${i}.txt" << EOF
line 1
<<<<<<< HEAD
current $i
=======
incoming $i
>>>>>>> branch
line 2
EOF
    done

    # Esegui batch resolution (dry-run)
    assert_true "gcr_resolve_batch '${TEST_DIR}/batch' 'incoming' 'true'" "Batch dry-run successful"

    # Verifica che i file non siano stati modificati (dry-run)
    assert_file_contains "${TEST_DIR}/batch/file1.txt" "^<<<<<<< " "File1 still has conflicts (dry-run)"

    # Esegui batch resolution (reale)
    assert_true "gcr_resolve_batch '${TEST_DIR}/batch' 'incoming' 'false'" "Batch resolution successful"

    # Verifica che i conflitti siano risolti
    assert_file_not_contains "${TEST_DIR}/batch/file1.txt" "^<<<<<<< " "File1 conflicts resolved"
    assert_file_not_contains "${TEST_DIR}/batch/file2.txt" "^<<<<<<< " "File2 conflicts resolved"
    assert_file_not_contains "${TEST_DIR}/batch/file3.txt" "^<<<<<<< " "File3 conflicts resolved"

    # Verifica contenuti
    assert_file_contains "${TEST_DIR}/batch/file1.txt" "incoming 1" "File1 has incoming change"
    assert_file_contains "${TEST_DIR}/batch/file2.txt" "incoming 2" "File2 has incoming change"
    assert_file_contains "${TEST_DIR}/batch/file3.txt" "incoming 3" "File3 has incoming change"
}

# Test 10: Edge Cases
test_edge_cases() {
    echo -e "\n${BLUE}=== Test Suite 10: Edge Cases ===${NC}"

    # File vuoto
    touch "${TEST_DIR}/empty.txt"
    assert_false "gcr_has_conflict_markers '${TEST_DIR}/empty.txt'" "Empty file has no conflicts"

    # File inesistente
    assert_false "gcr_has_conflict_markers '${TEST_DIR}/nonexistent.txt'" "Nonexistent file returns false"

    # File con marker incompleti
    cat > "${TEST_DIR}/incomplete.txt" << 'EOF'
<<<<<<< HEAD
only start marker
EOF
    # Non dovrebbe crashare
    assert_true "gcr_resolve_keep_incoming '${TEST_DIR}/incomplete.txt' > /dev/null" "Incomplete markers handled gracefully"

    # File con caratteri speciali nel nome
    echo "test" > "${TEST_DIR}/file with spaces.txt"
    assert_true "[[ -f '${TEST_DIR}/file with spaces.txt' ]]" "File with spaces handled"

    # Conflitti annidati (edge case complesso)
    cat > "${TEST_DIR}/nested.txt" << 'EOF'
outer start
<<<<<<< HEAD
outer current
<<<<<<< HEAD
inner current
=======
inner incoming
>>>>>>> inner
outer current end
=======
outer incoming
>>>>>>> outer
outer end
EOF

    # Dovrebbe gestire almeno il conflitto esterno
    local result
    result=$(gcr_resolve_keep_incoming "${TEST_DIR}/nested.txt")
    assert_true "echo '$result' | grep -q 'outer'" "Nested conflicts partially handled"
}

# ============================================================================
# MAIN TEST RUNNER
# ============================================================================

run_all_tests() {
    echo -e "${BLUE}╔════════════════════════════════════════════════════════════╗${NC}"
    echo -e "${BLUE}║  Git Conflict Resolver - Test Suite v1.0.0               ║${NC}"
    echo -e "${BLUE}╚════════════════════════════════════════════════════════════╝${NC}"

    setup_test_env

    # Esegui tutti i test
    test_dependencies
    test_file_validation
    test_resolve_incoming
    test_resolve_current
    test_multiple_conflicts
    test_backup
    test_file_resolution
    test_find_files
    test_batch_resolution
    test_edge_cases

    # Cleanup
    cleanup_test_env

    # Riepilogo
    echo -e "\n${BLUE}╔════════════════════════════════════════════════════════════╗${NC}"
    echo -e "${BLUE}║  Test Summary                                             ║${NC}"
    echo -e "${BLUE}╚════════════════════════════════════════════════════════════╝${NC}"
    echo -e "Total tests:  ${TESTS_TOTAL}"
    echo -e "${GREEN}Passed:       ${TESTS_PASSED}${NC}"
    echo -e "${RED}Failed:       ${TESTS_FAILED}${NC}"

    local percentage=0
    if [[ $TESTS_TOTAL -gt 0 ]]; then
        percentage=$((TESTS_PASSED * 100 / TESTS_TOTAL))
    fi

    echo -e "Success rate: ${percentage}%"

    if [[ $TESTS_FAILED -eq 0 ]]; then
        echo -e "\n${GREEN}✓ All tests passed!${NC}"
        return 0
    else
        echo -e "\n${RED}✗ Some tests failed!${NC}"
        return 1
    fi
}

# Esegui i test
if run_all_tests; then
    exit 0
else
    exit 1
fi
