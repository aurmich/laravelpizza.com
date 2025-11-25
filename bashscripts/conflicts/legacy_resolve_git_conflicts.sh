#!/bin/bash

# Script per risolvere automaticamente i marker di conflitto Git
# Gestisce sia i conflitti semplici che quelli complessi

set -e  # Esci in caso di errore

# Imposta il locale per evitare problemi
export LC_ALL=C

echo "=== Script di Risoluzione Conflitti Git ==="
echo "Data: $(date)"
echo

# Directory di lavoro
WORK_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$WORK_DIR"

echo "Directory di lavoro: $WORK_DIR"
echo

# Funzione per identificare i tipi di conflitti
identify_conflict_type() {
    local file="$1"
    local conflict_type="unknown"
    
    # Conta i marker di conflitto
    local head_markers=$(grep -c "^<<<<<<< HEAD" "$file" 2>/dev/null || echo 0)
    local incoming_markers=$(grep -c "^>>>>>>> " "$file" 2>/dev/null || echo 0)
    local separator_markers=$(grep -c "^=======" "$file" 2>/dev/null || echo 0)
    
    # Converti a numeri interi per il confronto
    head_markers=$(echo "$head_markers" | tr -d ' ')
    incoming_markers=$(echo "$incoming_markers" | tr -d ' ')
    separator_markers=$(echo "$separator_markers" | tr -d ' ')
    
    # Gestisci valori vuoti
    if [[ -z "$head_markers" ]]; then head_markers=0; fi
    if [[ -z "$incoming_markers" ]]; then incoming_markers=0; fi
    if [[ -z "$separator_markers" ]]; then separator_markers=0; fi
    
    if [[ $head_markers -gt 0 && $incoming_markers -gt 0 ]]; then
        if [[ $head_markers -eq $incoming_markers && $head_markers -eq $separator_markers ]]; then
            conflict_type="standard"
        else
            conflict_type="complex"
        fi
    elif [[ $incoming_markers -gt 0 && $head_markers -eq 0 ]]; then
        conflict_type="residual"
    fi
    
    echo "$conflict_type"
}

# Funzione per risolvere i conflitti standard (3-way)
resolve_standard_conflict() {
    local file="$1"
    echo "Risolvendo conflitti standard in: $file"
    
    # Mantieni il contenuto della nostra versione (tra <<<<<<< HEAD e =======)
    # e rimuovi i marker e la versione in conflitto
    
    # Creiamo una copia di backup
    cp "$file" "${file}.conflict.bak"
    
    # Processo in più passaggi per evitare problemi con sed
    local temp_file="${file}.temp"
    
    # 1. Rimuovi le linee ======= e >>>>>>> (versione in conflitto)
    sed '/^=======/,/^>>>>>>> /d' "$file" > "$temp_file"
    
    # 2. Rimuovi i marker <<<<<<< HEAD rimanenti
    sed '/^<<<<<<< HEAD/d' "$temp_file" > "${file}.final"
    
    # 3. Sposta il file finale
    mv "${file}.final" "$file"
    
    # 4. Rimuovi i file temporanei
    rm -f "$temp_file" "${file}.final"
    
    echo "  ✓ Conflitti standard risolti"
}

# Funzione per risolvere i conflitti residui
resolve_residual_conflict() {
    local file="$1"
    echo "Risolvendo conflitti residui in: $file"
    
    # Creiamo una copia di backup
    cp "$file" "${file}.conflict.bak"
    
    # Rimuovi i marker residui >>>>>>> hash
    sed -i '/^>>>>>>> [a-f0-9]* (.*)$/d' "$file"
    sed -i '/^>>>>>>> [a-f0-9]*$/d' "$file"
    
    echo "  ✓ Conflitti residui risolti"
}

# Funzione per risolvere i conflitti complessi
resolve_complex_conflict() {
    local file="$1"
    echo "Risolvendo conflitti complessi in: $file"
    
    # Per i conflitti complessi, creiamo un backup e segnaliamo
    cp "$file" "${file}.complex.manual"
    echo "  ⚠ Conflitto complesso rilevato - richiede revisione manuale"
    echo "  File di backup creato: ${file}.complex.manual"
}

# Funzione principale per processare un file
process_file() {
    local file="$1"
    
    if [[ ! -f "$file" ]]; then
        echo "❌ File non trovato: $file"
        return 1
    fi
    
    echo "Processando: $file"
    
    # Identifica il tipo di conflitto
    local conflict_type=$(identify_conflict_type "$file")
    echo "  Tipo di conflitto: $conflict_type"
    
    case "$conflict_type" in
        "standard")
            resolve_standard_conflict "$file"
            ;;
        "residual")
            resolve_residual_conflict "$file"
            ;;
        "complex")
            resolve_complex_conflict "$file"
            ;;
        "unknown")
            echo "  ℹ Nessun conflitto rilevato o tipo sconosciuto"
            ;;
    esac
    
    # Verifica che il file sia ancora valido (per file PHP)
    if [[ "$file" == *.php ]]; then
        if ! php -l "$file" >/dev/null 2>&1; then
            echo "  ⚠ Errore di sintassi PHP dopo la risoluzione"
            echo "  File di backup disponibile: ${file}.conflict.bak"
        else
            echo "  ✓ File PHP sintatticamente corretto"
        fi
    fi
    
    echo
}

# Funzione per trovare tutti i file con conflitti
find_conflict_files() {
    echo "=== Ricerca file con marker di conflitto ==="
    
    # Trova tutti i file con marker di conflitto (escludendo vendor e .git)
    local conflict_files=$(find . -type f \
        -not -path "./vendor/*" \
        -not -path "./.git/*" \
        -not -path "./node_modules/*" \
        \( -name "*.php" -o -name "*.js" -o -name "*.json" -o -name "*.md" -o -name "*.txt" -o -name "*.xml" -o -name "*.yml" -o -name "*.yaml" -o -name "*.css" -o -name "*.html" -o -name "*.svg" \) \
        -exec grep -l "^<<<<<<<\|^>>>>>>>" {} \; 2>/dev/null || true)
    
    if [[ -z "$conflict_files" ]]; then
        echo "✅ Nessun file con marker di conflitto trovato"
        return 1
    fi
    
    local count=$(echo "$conflict_files" | wc -l)
    echo "Trovati $count file con marker di conflitto:"
    echo "$conflict_files" | sed 's/^/  - /'
    echo
    
    echo "$conflict_files"
}

# Funzione per verificare la risoluzione
verify_resolution() {
    echo "=== Verifica Risoluzione ==="
    
    # Conta i marker rimanenti
    local remaining_markers=$(find . -type f \
        -not -path "./vendor/*" \
        -not -path "./.git/*" \
        -not -path "./node_modules/*" \
        \( -name "*.php" -o -name "*.js" -name "*.json" -o -name "*.md" -o -name "*.txt" -o -name "*.xml" -o -name "*.yml" -o -name "*.yaml" -o -name "*.css" -o -name "*.html" -o -name "*.svg" \) \
        -exec grep -l "^<<<<<<<\|^>>>>>>>" {} \; 2>/dev/null | wc -l || echo 0)
    
    if [[ $remaining_markers -eq 0 ]]; then
        echo "✅ Tutti i marker di conflitto sono stati risolti"
        return 0
    else
        echo "⚠ $remaining_markers file ancora contengono marker di conflitto"
        return 1
    fi
}

# Funzione per test
run_tests() {
    echo "=== Test dello Script ==="
    
    # Crea directory temporanea per i test
    local test_dir="/tmp/git_conflict_test_$$"
    mkdir -p "$test_dir"
    cd "$test_dir"
    
    echo "Directory di test: $test_dir"
    
    # Test 1: File senza conflitti
    echo "Test 1: File senza conflitti"
    echo "<?php echo 'Hello World'; ?>" > test1.php
    process_file "test1.php"
    echo
    
    # Test 2: Conflitti standard
    echo "Test 2: Conflitti standard"
    cat > test2.php << 'EOF'
<?php
echo "Versione loro";
?>
EOF
    process_file "test2.php"
    echo "Contenuto dopo risoluzione:"
    cat test2.php
    echo
    
    # Test 3: Conflitti residui
    echo "Test 3: Conflitti residui"
    echo "Contenuto normale" > test3.md
    echo ">>>>>>> a1b2c3d4e5f6" >> test3.md
    process_file "test3.md"
    echo "Contenuto dopo risoluzione:"
    cat test3.md
    echo
    
    # Pulizia
    cd "$WORK_DIR"
    rm -rf "$test_dir"
    
    echo "✅ Test completati"
}

# Main script
main() {
    local mode="process"
    
    # Parsing argomenti
    while [[ $# -gt 0 ]]; do
        case $1 in
            --test|-t)
                mode="test"
                shift
                ;;
            --find|-f)
                mode="find"
                shift
                ;;
            --verify|-v)
                mode="verify"
                shift
                ;;
            *)
                echo "Uso: $0 [--test|-t] [--find|-f] [--verify|-v]"
                echo "  --test, -t   : Esegui i test dello script"
                echo "  --find, -f   : Trova tutti i file con marker di conflitto"
                echo "  --verify, -v : Verifica che tutti i conflitti siano risolti"
                echo "  (default)    : Processa tutti i file con conflitti"
                return 1
                ;;
        esac
    done
    
    case "$mode" in
        "test")
            run_tests
            ;;
        "find")
            find_conflict_files
            ;;
        "verify")
            verify_resolution
            ;;
        "process")
            echo "=== Processamento File con Conflitti ==="
            local files=$(find_conflict_files)
            if [[ -n "$files" ]]; then
                echo "Processando i file..."
                echo "$files" | while read -r file; do
                    process_file "$file"
                done
                verify_resolution
            fi
            ;;
    esac
}

# Esegui il main script
main "$@"
