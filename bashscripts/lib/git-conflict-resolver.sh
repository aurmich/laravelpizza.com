#!/usr/bin/env bash
# git-conflict-resolver.sh
# Libreria riutilizzabile per la risoluzione automatica dei conflitti Git
# Autore: AI Assistant
# Versione: 1.0.0
# Data: 2025-10-22
#
# Questa libreria fornisce funzioni modulari per:
# - Rilevare conflitti Git
# - Risolvere conflitti mantenendo incoming/current change
# - Validare i file processati
# - Creare backup sicuri
# - Logging strutturato

set -euo pipefail

# ============================================================================
# COSTANTI
# ============================================================================

# Colori per output (compatibile con terminali senza colore)
declare -gr GCR_RED='\033[0;31m'
declare -gr GCR_GREEN='\033[0;32m'
declare -gr GCR_YELLOW='\033[0;33m'
declare -gr GCR_BLUE='\033[0;34m'
declare -gr GCR_PURPLE='\033[0;35m'
declare -gr GCR_CYAN='\033[0;36m'
declare -gr GCR_BOLD='\033[1m'
declare -gr GCR_NC='\033[0m'

# Pattern per i marker di conflitto Git
declare -gr GCR_MARKER_HEAD='^<<<<<<< '
declare -gr GCR_MARKER_SEP='^=======$'
declare -gr GCR_MARKER_END='^>>>>>>> '

# Directory di default (può essere sovrascritto)
GCR_BASE_DIR="${GCR_BASE_DIR:-$(pwd)}"
GCR_BACKUP_DIR="${GCR_BACKUP_DIR:-${GCR_BASE_DIR}/.git-conflict-backups}"
GCR_LOG_FILE="${GCR_LOG_FILE:-}"

# ============================================================================
# FUNZIONI DI UTILITÀ
# ============================================================================

# Log con timestamp e livelli di severità
# Uso: gcr_log "level" "message"
# Livelli: debug, info, warning, error, success
gcr_log() {
    local level="$1"
    local message="$2"
    local timestamp
    timestamp=$(date '+%Y-%m-%d %H:%M:%S')

    local color=""
    local emoji=""

    case "$level" in
        debug)
            color="$GCR_BLUE"
            emoji="🔍"
            ;;
        info)
            color="$GCR_CYAN"
            emoji="ℹ️"
            ;;
        warning)
            color="$GCR_YELLOW"
            emoji="⚠️"
            ;;
        error)
            color="$GCR_RED"
            emoji="❌"
            ;;
        success)
            color="$GCR_GREEN"
            emoji="✅"
            ;;
        *)
            color="$GCR_NC"
            emoji="📝"
            ;;
    esac

    local log_line="[$timestamp] [$level] $message"

    # Output colorato su stdout/stderr
    if [[ "$level" == "error" ]]; then
        echo -e "${color}${emoji} ${log_line}${GCR_NC}" >&2
    else
        echo -e "${color}${emoji} ${log_line}${GCR_NC}"
    fi

    # Append al file di log se definito
    if [[ -n "$GCR_LOG_FILE" ]]; then
        echo "$log_line" >> "$GCR_LOG_FILE"
    fi
}

# Verifica se un comando esiste
# Uso: gcr_command_exists "comando"
gcr_command_exists() {
    command -v "$1" >/dev/null 2>&1
}

# Verifica dipendenze necessarie
gcr_check_dependencies() {
    local missing_deps=()

    for cmd in awk grep find file stat; do
        if ! gcr_command_exists "$cmd"; then
            missing_deps+=("$cmd")
        fi
    done

    if [[ ${#missing_deps[@]} -gt 0 ]]; then
        gcr_log "error" "Dipendenze mancanti: ${missing_deps[*]}"
        return 1
    fi

    return 0
}

# ============================================================================
# FUNZIONI DI VALIDAZIONE FILE
# ============================================================================

# Verifica se un file è binario
# Uso: gcr_is_binary_file "/path/to/file"
gcr_is_binary_file() {
    local file="$1"

    [[ ! -f "$file" ]] && return 1

    # Usa il comando file per verificare tipo MIME
    if file --brief --mime "$file" 2>/dev/null | grep -qi "binary"; then
        return 0
    fi

    # Controllo per caratteri null
    if grep -q $'\0' "$file" 2>/dev/null; then
        return 0
    fi

    # Estensioni comuni di file binari
    case "${file##*.}" in
        jpg|jpeg|png|gif|bmp|ico|svg|webp|pdf|zip|tar|gz|bz2|xz|7z|rar|\
        exe|dll|so|o|a|dylib|class|pyc|pyo|jar|war|ear)
            return 0
            ;;
    esac

    return 1
}

# Verifica se un file contiene marker di conflitto
# Uso: gcr_has_conflict_markers "/path/to/file"
gcr_has_conflict_markers() {
    local file="$1"

    [[ ! -f "$file" ]] && return 1
    [[ ! -r "$file" ]] && return 1

    grep -q "$GCR_MARKER_HEAD" "$file" 2>/dev/null
}

# Conta i conflitti in un file
# Uso: count=$(gcr_count_conflicts "/path/to/file")
gcr_count_conflicts() {
    local file="$1"

    [[ ! -f "$file" ]] && echo "0" && return

    grep -c "$GCR_MARKER_HEAD" "$file" 2>/dev/null || echo "0"
}

# Verifica permessi di lettura/scrittura
# Uso: gcr_check_file_permissions "/path/to/file"
gcr_check_file_permissions() {
    local file="$1"

    if [[ ! -f "$file" ]]; then
        gcr_log "error" "File non trovato: $file"
        return 1
    fi

    if [[ ! -r "$file" ]]; then
        gcr_log "error" "File non leggibile: $file"
        return 1
    fi

    if [[ ! -w "$file" ]]; then
        gcr_log "error" "File non scrivibile: $file"
        return 1
    fi

    return 0
}

# ============================================================================
# FUNZIONI DI BACKUP
# ============================================================================

# Crea directory di backup se non esiste
gcr_init_backup_dir() {
    if [[ ! -d "$GCR_BACKUP_DIR" ]]; then
        mkdir -p "$GCR_BACKUP_DIR" || {
            gcr_log "error" "Impossibile creare directory backup: $GCR_BACKUP_DIR"
            return 1
        }
        gcr_log "info" "Directory backup creata: $GCR_BACKUP_DIR"
    fi
    return 0
}

# Crea backup di un file
# Uso: gcr_create_backup "/path/to/file"
# Output: percorso del file di backup
gcr_create_backup() {
    local file="$1"
    local timestamp
    timestamp=$(date +%Y%m%d_%H%M%S)

    # Genera nome backup univoco
    local filename
    filename=$(basename "$file")
    local backup_name="${timestamp}_${filename}.backup"
    local backup_path="${GCR_BACKUP_DIR}/${backup_name}"

    # Crea backup
    if ! cp "$file" "$backup_path" 2>/dev/null; then
        gcr_log "error" "Impossibile creare backup: $file -> $backup_path"
        return 1
    fi

    # Valida il backup (confronta dimensioni)
    local orig_size backup_size
    orig_size=$(stat -c%s "$file" 2>/dev/null || stat -f%z "$file" 2>/dev/null || echo "0")
    backup_size=$(stat -c%s "$backup_path" 2>/dev/null || stat -f%z "$backup_path" 2>/dev/null || echo "0")

    if [[ "$orig_size" -ne "$backup_size" ]]; then
        gcr_log "error" "Backup non valido (dimensioni diverse): $backup_path"
        rm -f "$backup_path"
        return 1
    fi

    gcr_log "debug" "Backup creato: $backup_path"
    echo "$backup_path"
    return 0
}

# ============================================================================
# FUNZIONI DI RISOLUZIONE CONFLITTI
# ============================================================================

# Risolve conflitti mantenendo la "incoming change" (parte dopo =======)
# Uso: gcr_resolve_keep_incoming "/path/to/file" > output
gcr_resolve_keep_incoming() {
    local file="$1"

    awk '
    BEGIN {
        in_conflict = 0
        keep = 0
    }

    # Inizio conflitto - scarta tutto fino a =======
    /^<<<<<<< / {
        in_conflict = 1
        keep = 0
        next
    }

    # Separatore - da qui inizia incoming change (da mantenere)
    /^=======/ {
        if (in_conflict) {
            keep = 1
        }
        next
    }

    # Fine conflitto - torna a modalità normale
    /^>>>>>>> / {
        in_conflict = 0
        keep = 0
        next
    }

    # Stampa la riga se:
    # - Non siamo in conflitto, OPPURE
    # - Siamo nella sezione incoming (keep=1)
    {
        if (!in_conflict || keep) {
            print $0
        }
    }
    ' "$file"
}

# Risolve conflitti mantenendo la "current change" (parte prima di =======)
# Uso: gcr_resolve_keep_current "/path/to/file" > output
gcr_resolve_keep_current() {
    local file="$1"

    awk '
    BEGIN {
        in_conflict = 0
        in_head = 0
    }

    # Inizio conflitto - mantieni questa sezione (current/HEAD)
    /^<<<<<<< / {
        in_conflict = 1
        in_head = 1
        next
    }

    # Separatore - da qui scarta fino a fine conflitto
    /^=======/ {
        if (in_conflict) {
            in_head = 0
        }
        next
    }

    # Fine conflitto - torna a modalità normale
    /^>>>>>>> / {
        in_conflict = 0
        in_head = 0
        next
    }

    # Stampa la riga se:
    # - Non siamo in conflitto, OPPURE
    # - Siamo nella sezione current/HEAD (in_head=1)
    {
        if (!in_conflict || in_head) {
            print $0
        }
    }
    ' "$file"
}

# Risolve conflitti in un file (con backup automatico)
# Uso: gcr_resolve_file "/path/to/file" "incoming|current"
gcr_resolve_file() {
    local file="$1"
    local strategy="${2:-incoming}"  # default: incoming
    local temp_file="${file}.tmp.$$"

    # Validazioni preliminari
    if ! gcr_check_file_permissions "$file"; then
        return 1
    fi

    if gcr_is_binary_file "$file"; then
        gcr_log "warning" "File binario ignorato: $file"
        return 2
    fi

    if ! gcr_has_conflict_markers "$file"; then
        gcr_log "debug" "Nessun conflitto in: $file"
        return 0
    fi

    local conflict_count
    conflict_count=$(gcr_count_conflicts "$file")

    # Crea backup
    gcr_init_backup_dir || return 1
    local backup_path
    backup_path=$(gcr_create_backup "$file") || return 1

    # Risolvi conflitti
    local resolver_func
    if [[ "$strategy" == "incoming" ]]; then
        resolver_func="gcr_resolve_keep_incoming"
    else
        resolver_func="gcr_resolve_keep_current"
    fi

    if ! "$resolver_func" "$file" > "$temp_file" 2>/dev/null; then
        gcr_log "error" "Errore durante risoluzione: $file"
        rm -f "$temp_file"
        return 1
    fi

    # Validazioni del risultato
    if [[ ! -s "$temp_file" ]]; then
        gcr_log "error" "File risultante vuoto: $file"
        rm -f "$temp_file"
        return 1
    fi

    if gcr_has_conflict_markers "$temp_file"; then
        gcr_log "error" "Conflitti rimanenti dopo risoluzione: $file"
        rm -f "$temp_file"
        return 1
    fi

    # Sostituisci il file originale
    if ! mv "$temp_file" "$file"; then
        gcr_log "error" "Impossibile sostituire file: $file"
        rm -f "$temp_file"
        return 1
    fi

    gcr_log "success" "Risolti $conflict_count conflitti in: $file (strategy: $strategy)"
    return 0
}

# ============================================================================
# FUNZIONI DI RICERCA
# ============================================================================

# Trova tutti i file con conflitti in una directory
# Uso: gcr_find_conflicted_files "/path/to/search" ["*.ext"]
# Output: lista di file (uno per riga)
gcr_find_conflicted_files() {
    local search_dir="${1:-.}"
    local pattern="${2:-*}"

    find "$search_dir" -type f -name "$pattern" \
        ! -path "*/.git/*" \
        ! -path "*/node_modules/*" \
        ! -path "*/vendor/*" \
        ! -path "*/storage/logs/*" \
        ! -path "*/cache/*" \
        ! -path "*/tmp/*" \
        ! -name "*.log" \
        ! -name "*.cache" \
        -print0 2>/dev/null | \
        xargs -0 -r grep -l "$GCR_MARKER_HEAD" 2>/dev/null | \
        sort || true
}

# Verifica se ci sono ancora conflitti
# Uso: gcr_verify_no_conflicts "/path/to/search"
gcr_verify_no_conflicts() {
    local search_dir="${1:-.}"
    local remaining

    remaining=$(gcr_find_conflicted_files "$search_dir" | wc -l)

    if [[ "$remaining" -eq 0 ]]; then
        gcr_log "success" "Nessun conflitto rimanente in: $search_dir"
        return 0
    else
        gcr_log "warning" "Trovati $remaining file con conflitti in: $search_dir"
        return 1
    fi
}

# ============================================================================
# FUNZIONI BATCH
# ============================================================================

# Risolve conflitti in batch
# Uso: gcr_resolve_batch "/path/to/search" "incoming|current" [dry_run]
gcr_resolve_batch() {
    local search_dir="${1:-.}"
    local strategy="${2:-incoming}"
    local dry_run="${3:-false}"

    local -a files=()
    local total_files=0
    local resolved=0
    local failed=0
    local skipped=0

    gcr_log "info" "Ricerca file con conflitti in: $search_dir"

    readarray -t files < <(gcr_find_conflicted_files "$search_dir")
    total_files=${#files[@]}

    if [[ $total_files -eq 0 ]]; then
        gcr_log "info" "Nessun file con conflitti trovato"
        return 0
    fi

    gcr_log "info" "Trovati $total_files file con conflitti"

    if [[ "$dry_run" == "true" ]]; then
        gcr_log "info" "Modalità DRY-RUN - nessuna modifica sarà applicata"
        for file in "${files[@]}"; do
            local count
            count=$(gcr_count_conflicts "$file")
            gcr_log "info" "[DRY-RUN] $file ($count conflitti)"
        done
        return 0
    fi

    # Processa file
    local index=0
    for file in "${files[@]}"; do
        ((index++))
        gcr_log "info" "[$index/$total_files] Elaborazione: $file"

        case "$(gcr_resolve_file "$file" "$strategy"; echo $?)" in
            0)
                ((resolved++))
                ;;
            1)
                ((failed++))
                ;;
            2)
                ((skipped++))
                ;;
        esac
    done

    # Riepilogo
    gcr_log "info" "============= RIEPILOGO ============="
    gcr_log "info" "File processati: $total_files"
    gcr_log "success" "Risolti: $resolved"
    gcr_log "warning" "Saltati: $skipped"
    gcr_log "error" "Falliti: $failed"

    # Verifica finale
    gcr_verify_no_conflicts "$search_dir"

    return 0
}

# ============================================================================
# INIZIALIZZAZIONE
# ============================================================================

# Verifica dipendenze all'import della libreria
if ! gcr_check_dependencies; then
    gcr_log "error" "Libreria git-conflict-resolver.sh: dipendenze mancanti"
    return 1 2>/dev/null || exit 1
fi

gcr_log "debug" "Libreria git-conflict-resolver.sh caricata (v1.0.0)"
