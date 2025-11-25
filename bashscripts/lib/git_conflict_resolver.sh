#!/bin/bash
# ==============================================================================
# Git Conflict Resolver Library
# ==============================================================================
# Libreria riutilizzabile per la risoluzione automatica dei conflitti Git
# 
# Autore: AI Assistant + Laraxot Team
# Versione: 5.0
# Licenza: MIT
# 
# Questa libreria fornisce funzioni per risolvere conflitti Git in modo 
# programmatico, scegliendo automaticamente una delle versioni (HEAD, INCOMING, 
# o una strategia custom).
#
# Uso:
#   source lib/git_conflict_resolver.sh
#   gcr_resolve_file "path/to/file.php" "incoming"
# ==============================================================================

set -euo pipefail

# ==============================================================================
# CONFIGURAZIONE E COSTANTI
# ==============================================================================

# Versione libreria
readonly GCR_VERSION="5.0.0"

# Marker Git standard
readonly GCR_MARKER_HEAD="<<<<<<< HEAD"
readonly GCR_MARKER_SEP="======="
readonly GCR_MARKER_END=">>>>>>>"

# Codici di ritorno
readonly GCR_SUCCESS=0
readonly GCR_ERROR_NO_CONFLICT=1
readonly GCR_ERROR_BINARY=2
readonly GCR_ERROR_PROCESSING=3
readonly GCR_ERROR_INVALID_STRATEGY=4

# Colori ANSI
readonly GCR_RED='\033[0;31m'
readonly GCR_GREEN='\033[0;32m'
readonly GCR_YELLOW='\033[0;33m'
readonly GCR_BLUE='\033[0;34m'
readonly GCR_PURPLE='\033[0;35m'
readonly GCR_CYAN='\033[0;36m'
readonly GCR_BOLD='\033[1m'
readonly GCR_NC='\033[0m' # No Color

# ==============================================================================
# FUNZIONI UTILITY
# ==============================================================================

# Stampa messaggio con colore
# Args: $1=color, $2=message
gcr_log() {
    local color="${1:-$GCR_NC}"
    local message="${2:-}"
    echo -e "${color}${message}${GCR_NC}"
}

# Verifica se un file è binario
# Args: $1=file_path
# Return: 0=text, 1=binary
gcr_is_binary() {
    local file="$1"
    if file --brief --mime "$file" | grep -qi "binary"; then
        return 0
    fi
    return 1
}

# Verifica se un file ha conflitti Git
# Args: $1=file_path
# Return: 0=has_conflicts, 1=no_conflicts
gcr_has_conflicts() {
    local file="$1"
    grep -q "^${GCR_MARKER_HEAD}" "$file" 2>/dev/null
}

# Conta il numero di conflitti in un file
# Args: $1=file_path
# Output: numero di conflitti
gcr_count_conflicts() {
    local file="$1"
    grep -c "^${GCR_MARKER_HEAD}" "$file" 2>/dev/null || echo "0"
}

# ==============================================================================
# STRATEGIE DI RISOLUZIONE
# ==============================================================================

# Risolve conflitto prendendo la versione HEAD (current)
# Input: stdin con conflitto
# Output: stdout con risoluzione
gcr_resolve_head() {
    awk -v head="^${GCR_MARKER_HEAD}" -v sep="^${GCR_MARKER_SEP}" -v end="^${GCR_MARKER_END}" '
        BEGIN { state=0 }
        $0 ~ head { state=1; next }
        $0 ~ sep  { if(state==1) state=2; next }
        $0 ~ end  { if(state>0) state=0; next }
        { if(state==0 || state==1) print $0 }
    '
}

# Risolve conflitto prendendo la versione INCOMING (theirs)
# Input: stdin con conflitto
# Output: stdout con risoluzione
gcr_resolve_incoming() {
    awk -v head="^${GCR_MARKER_HEAD}" -v sep="^${GCR_MARKER_SEP}" -v end="^${GCR_MARKER_END}" '
        BEGIN { state=0 }
        $0 ~ head { state=1; next }
        $0 ~ sep  { if(state==1) state=2; next }
        $0 ~ end  { if(state>0) state=0; next }
        { if(state==0 || state==2) print $0 }
    '
}

# Risolve conflitto unendo entrambe le versioni
# Input: stdin con conflitto
# Output: stdout con risoluzione
gcr_resolve_both() {
    awk -v head="^${GCR_MARKER_HEAD}" -v sep="^${GCR_MARKER_SEP}" -v end="^${GCR_MARKER_END}" '
        BEGIN { state=0 }
        $0 ~ head { state=1; print "# BEGIN: HEAD version"; next }
        $0 ~ sep  { if(state==1) { print "# BEGIN: INCOMING version"; state=2; next } }
        $0 ~ end  { if(state>0) { print "# END: merged content"; state=0; next } }
        { print $0 }
    '
}

# Risolve conflitto rimuovendo solo i marker (lascia tutto il contenuto)
# Input: stdin con conflitto
# Output: stdout con risoluzione
gcr_resolve_remove_markers() {
    grep -v "^${GCR_MARKER_HEAD}" | \
    grep -v "^${GCR_MARKER_SEP}" | \
    grep -v "^${GCR_MARKER_END}"
}

# ==============================================================================
# FUNZIONE PRINCIPALE
# ==============================================================================

# Risolve i conflitti in un file
# Args: 
#   $1 = file_path
#   $2 = strategy (head|incoming|both|remove_markers) [default: incoming]
#   $3 = backup_dir (optional)
#   $4 = dry_run (true|false) [default: false]
# Return: 
#   0 = success
#   1 = no conflicts found
#   2 = binary file
#   3 = processing error
#   4 = invalid strategy
gcr_resolve_file() {
    local file="$1"
    local strategy="${2:-incoming}"
    local backup_dir="${3:-}"
    local dry_run="${4:-false}"
    
    # Validazione input
    if [ ! -f "$file" ]; then
        gcr_log "$GCR_RED" "❌ File non trovato: $file"
        return $GCR_ERROR_PROCESSING
    fi
    
    # Verifica binario
    if gcr_is_binary "$file"; then
        gcr_log "$GCR_YELLOW" "⏭️  File binario, skipped: $file"
        return $GCR_ERROR_BINARY
    fi
    
    # Verifica conflitti
    if ! gcr_has_conflicts "$file"; then
        gcr_log "$GCR_BLUE" "ℹ️  Nessun conflitto: $file"
        return $GCR_ERROR_NO_CONFLICT
    fi
    
    # Seleziona strategia
    local resolver_func
    case "$strategy" in
        "head"|"current")
            resolver_func="gcr_resolve_head"
            ;;
        "incoming"|"theirs")
            resolver_func="gcr_resolve_incoming"
            ;;
        "both"|"merge")
            resolver_func="gcr_resolve_both"
            ;;
        "remove_markers"|"keep_all")
            resolver_func="gcr_resolve_remove_markers"
            ;;
        *)
            gcr_log "$GCR_RED" "❌ Strategia non valida: $strategy"
            return $GCR_ERROR_INVALID_STRATEGY
            ;;
    esac
    
    # Genera file temporaneo
    local tmp_file="${file}.tmp.$$"
    
    # Esegui risoluzione
    if ! $resolver_func < "$file" > "$tmp_file"; then
        rm -f "$tmp_file"
        gcr_log "$GCR_RED" "❌ Errore durante risoluzione: $file"
        return $GCR_ERROR_PROCESSING
    fi
    
    # Dry-run: mostra statistiche
    if [ "$dry_run" = "true" ]; then
        local before after conflicts
        before=$(wc -l < "$file" | tr -d ' ')
        after=$(wc -l < "$tmp_file" | tr -d ' ')
        conflicts=$(gcr_count_conflicts "$file")
        rm -f "$tmp_file"
        gcr_log "$GCR_CYAN" "🔎 DRY: $file | Conflitti: $conflicts | Righe: ${before}→${after}"
        return $GCR_SUCCESS
    fi
    
    # Backup se richiesto
    if [ -n "$backup_dir" ]; then
        mkdir -p "$backup_dir"
        cp "$file" "${backup_dir}/$(basename "$file").backup"
    fi
    
    # Applica risoluzione
    mv "$tmp_file" "$file"
    gcr_log "$GCR_GREEN" "✅ Risolto ($strategy): $file"
    
    return $GCR_SUCCESS
}

# ==============================================================================
# FUNZIONI BATCH
# ==============================================================================

# Risolve conflitti in una directory (ricorsivo)
# Args:
#   $1 = base_dir
#   $2 = strategy (head|incoming|both|remove_markers)
#   $3 = backup_dir (optional)
#   $4 = dry_run (true|false) [default: false]
#   $5 = exclude_patterns (comma-separated, optional)
#   $6 = include_extensions (comma-separated, optional)
# Return: numero di file risolti
gcr_resolve_directory() {
    local base_dir="$1"
    local strategy="${2:-incoming}"
    local backup_dir="${3:-}"
    local dry_run="${4:-false}"
    local exclude_patterns="${5:-}"
    local include_extensions="${6:-}"
    
    # Trova tutti i file con conflitti
    local -a files=()
    while IFS= read -r -d '' file; do
        # Applica esclusioni
        local skip=false
        if [ -n "$exclude_patterns" ]; then
            IFS=',' read -ra PATTERNS <<< "$exclude_patterns"
            for pattern in "${PATTERNS[@]}"; do
                if [[ "$file" == *"$pattern"* ]]; then
                    skip=true
                    break
                fi
            done
        fi
        
        [ "$skip" = true ] && continue

        # Applica inclusioni (estensioni)
        if [ -n "$include_extensions" ]; then
            local match=false
            IFS=',' read -ra EXTENSIONS <<< "$include_extensions"
            for ext in "${EXTENSIONS[@]}"; do
                ext="${ext// /}"
                ext="${ext#.}"
                [ -z "$ext" ] && continue
                if [[ "${file,,}" == *".${ext,,}" ]]; then
                    match=true
                    break
                fi
            done
            [ "$match" = false ] && continue
        fi

        files+=("$file")
    done < <((grep -IlrZ "^${GCR_MARKER_HEAD}" "$base_dir" \
        --exclude-dir=".git" \
        --exclude-dir="node_modules" \
        --exclude-dir="vendor" 2>/dev/null) || true)
    
    local total=${#files[@]}
    local resolved=0
    local errors=0
    local skipped=0
    
    gcr_log "$GCR_BOLD$GCR_BLUE" "📋 Trovati $total file con conflitti"
    
    for file in "${files[@]}"; do
        if gcr_resolve_file "$file" "$strategy" "$backup_dir" "$dry_run"; then
            ((resolved++)) || true
        else
            local rc=$?
            if [ $rc -eq $GCR_ERROR_BINARY ]; then
                ((skipped++)) || true
            else
                ((errors++)) || true
            fi
        fi
    done
    
    # Riepilogo
    gcr_log "$GCR_BOLD$GCR_BLUE" "\n=== Riepilogo ==="
    gcr_log "$GCR_GREEN" "✅ Risolti: $resolved"
    gcr_log "$GCR_RED" "❌ Errori: $errors"
    gcr_log "$GCR_YELLOW" "⏭️  Skipped: $skipped"
    
    return $resolved
}

# ==============================================================================
# FUNZIONI DI ANALISI
# ==============================================================================

# Analizza conflitti in un file e restituisce info strutturate
# Args: $1=file_path
# Output: JSON con statistiche
gcr_analyze_file() {
    local file="$1"
    
    if ! gcr_has_conflicts "$file"; then
        echo "{\"has_conflicts\": false, \"count\": 0}"
        return
    fi
    
    local count
    count=$(gcr_count_conflicts "$file")
    
    # Conta righe per sezione
    local head_lines incoming_lines
    head_lines=$(awk -v head="^${GCR_MARKER_HEAD}" -v sep="^${GCR_MARKER_SEP}" '
        BEGIN { state=0; count=0 }
        $0 ~ head { state=1; next }
        $0 ~ sep  { state=0; next }
        { if(state==1) count++ }
        END { print count }
    ' "$file")
    
    incoming_lines=$(awk -v sep="^${GCR_MARKER_SEP}" -v end="^${GCR_MARKER_END}" '
        BEGIN { state=0; count=0 }
        $0 ~ sep { state=1; next }
        $0 ~ end { state=0; next }
        { if(state==1) count++ }
        END { print count }
    ' "$file")
    
    echo "{\"has_conflicts\": true, \"count\": $count, \"head_lines\": $head_lines, \"incoming_lines\": $incoming_lines}"
}

# ==============================================================================
# ESPORTAZIONE FUNZIONI (per uso esterno)
# ==============================================================================

export -f gcr_log
export -f gcr_is_binary
export -f gcr_has_conflicts
export -f gcr_count_conflicts
export -f gcr_resolve_head
export -f gcr_resolve_incoming
export -f gcr_resolve_both
export -f gcr_resolve_remove_markers
export -f gcr_resolve_file
export -f gcr_resolve_directory
export -f gcr_analyze_file

# ==============================================================================
# INFORMAZIONI VERSIONE
# ==============================================================================

gcr_version() {
    echo "Git Conflict Resolver Library v${GCR_VERSION}"
}

export -f gcr_version




