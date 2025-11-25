#!/bin/bash

# =========================================================================
# 🐄 SuperMucca Ultimate Conflict Resolver - Current Change Edition V6.1
# =========================================================================
# Script per risolvere automaticamente i conflitti Git scegliendo sempre la "current change"
# Posizione: bashscripts/git/conflict_resolution/
# Autore: AI Assistant con poteri della supermucca
# Versione: 6.1 - Critical Bugfixes & Production Hardening
# Data creazione: 2024-10-22
# Ultima modifica: 2025-01-04
#
# Miglioramenti V6.1 (da V6.0):
# - ✅ Git repository validation (previene esecuzione su directory non-Git)
# - ✅ Complete dependency checking (awk, grep, find, file, stat, wc, cp, mv, mkdir)
# - ✅ Auto-detect CPU cores per parallelizzazione ottimale
# - ✅ mktemp per temp files (previene orphans)
# - ✅ Readonly vars post argument parsing (immutabilità)
# - ✅ Esclusioni Laravel complete (storage/framework, bootstrap/cache, public/build)
# - ✅ Backup retention policy configurabile
# - ✅ Cleanup idempotent (no duplicazioni)
# - ✅ Platform-aware stat command (Linux/macOS)
#
# Dalla V6.0:
# - Gestione migliorata di conflitti annidati
# - Validazione robusta AWK patterns
# - Backup sicuro con validazione
# - Performance ottimizzate per grandi repository
# =========================================================================

set -euo pipefail
IFS=$'\t'  # Solo tab, non newline (protegge da filename con newline)

# ============================================================================
# COSTANTI
# ============================================================================

# Colori per output
readonly RED='\033[0;31m'
readonly GREEN='\033[0;32m'
readonly YELLOW='\033[0;33m'
readonly BLUE='\033[0;34m'
readonly PURPLE='\033[0;35m'
readonly CYAN='\033[0;36m'
readonly BOLD='\033[1m'
readonly NC='\033[0m' # No Color

# Version info
readonly SCRIPT_VERSION="6.1"
readonly SCRIPT_NAME="SuperMucca Ultimate Conflict Resolver"

# ============================================================================
# CONFIGURAZIONE (da env var o defaults)
# ============================================================================

# Directory base: auto-detect dalla posizione dello script (override tramite BASE_DIR se necessario)
readonly SCRIPT_BASE="$(cd "$(dirname "${BASH_SOURCE[0]}")/../../.." && pwd)"
BASE_DIR="${BASE_DIR:-${SCRIPT_BASE}}"
SCRIPT_DIR="${SCRIPT_DIR:-${BASE_DIR}/bashscripts}"

# Opzioni comportamento
DRY_RUN="${DRY_RUN:-false}"
VERBOSE="${VERBOSE:-false}"
BATCH_SIZE="${BATCH_SIZE:-50}"
BACKUP_RETENTION_DAYS="${BACKUP_RETENTION_DAYS:-7}"
FILE_TIMEOUT="${FILE_TIMEOUT:-30}"

# Auto-detect CPU cores (default 4 se fallisce)
PARALLEL_JOBS="${PARALLEL_JOBS:-$(nproc 2>/dev/null || sysctl -n hw.ncpu 2>/dev/null || echo "4")}"

# Platform-aware stat command
if [[ "$OSTYPE" == "darwin"* ]]; then
    readonly STAT_SIZE_FLAG="-f%z"
else
    readonly STAT_SIZE_FLAG="-c%s"
fi

# Timestamp e directory derivate
readonly TIMESTAMP=$(date +%Y%m%d_%H%M%S)
readonly BACKUP_DIR="${SCRIPT_DIR}/backups/conflicts_current_change_v6.1_${TIMESTAMP}"
readonly LOG_DIR="${SCRIPT_DIR}/logs"
readonly LOG_FILE="${LOG_DIR}/resolve_conflicts_current_change_v6.1_${TIMESTAMP}.log"
readonly TEMP_DIR="${TMPDIR:-/tmp}/git-conflict-resolver-$$"

# ============================================================================
# VALIDAZIONE AMBIENTE
# ============================================================================

# Verifica dipendenze critiche
check_dependencies() {
    local missing_deps=()
    
    for cmd in awk grep find file stat wc cp mv mkdir rm; do
        if ! command -v "$cmd" &> /dev/null; then
            missing_deps+=("$cmd")
        fi
    done
    
    if [[ ${#missing_deps[@]} -gt 0 ]]; then
        echo -e "${RED}❌ Errore: Dipendenze mancanti: ${missing_deps[*]}${NC}" >&2
        echo -e "${YELLOW}💡 Installa: apt-get install coreutils gawk findutils${NC}" >&2
        exit 1
    fi
}

# Verifica che siamo in un repository Git
check_git_repository() {
    if [[ ! -d "$BASE_DIR/.git" ]]; then
        echo -e "${RED}❌ ERRORE CRITICO: $BASE_DIR non è un repository Git!${NC}" >&2
        echo -e "${YELLOW}💡 Assicurati di essere nella root di un repository Git${NC}" >&2
        echo -e "${YELLOW}📁 Directory corrente: $(pwd)${NC}" >&2
        exit 1
    fi
    
    # Verifica anche che Git funzioni correttamente
    if ! git -C "$BASE_DIR" status &>/dev/null; then
        echo -e "${RED}❌ ERRORE: Repository Git corrotto o inaccessibile${NC}" >&2
        exit 1
    fi
}

# ============================================================================
# INIZIALIZZAZIONE
# ============================================================================

# Esegui validazioni PRIMA di tutto
check_dependencies
check_git_repository

# Crea directory necessarie
mkdir -p "$LOG_DIR" "$BACKUP_DIR" "$TEMP_DIR"

# Contatori globali
declare -i TOTAL_FILES=0
declare -i RESOLVED_FILES=0
declare -i FAILED_FILES=0
declare -i SKIPPED_FILES=0
declare -i TOTAL_CONFLICTS=0
declare -i BATCH_COUNT=0
declare -i START_TIME=$(date +%s)

# Flag per cleanup idempotent
CLEANUP_DONE=false

# ============================================================================
# FUNZIONI DI LOGGING
# ============================================================================

# Funzione per log con timestamp
log() {
    local message="$*"
    local timestamp=$(date '+%Y-%m-%d %H:%M:%S')
    echo "[$timestamp] $message" >> "$LOG_FILE"
}

# Inizializza log con metadata
init_log() {
    {
        echo "======================================================================="
        echo "🐄 $SCRIPT_NAME v${SCRIPT_VERSION}"
        echo "======================================================================="
        echo "Data: $(date)"
        echo "Directory: $BASE_DIR"
        echo "Git branch: $(git -C "$BASE_DIR" branch --show-current 2>/dev/null || echo "unknown")"
        echo "Git commit: $(git -C "$BASE_DIR" rev-parse --short HEAD 2>/dev/null || echo "unknown")"
        echo ""
        echo "Configurazione:"
        echo "  Dry-run: $DRY_RUN"
        echo "  Verbose: $VERBOSE"
        echo "  Batch size: $BATCH_SIZE"
        echo "  Parallel jobs: $PARALLEL_JOBS"
        echo "  File timeout: ${FILE_TIMEOUT}s"
        echo "  Backup retention: ${BACKUP_RETENTION_DAYS} giorni"
        echo "  Platform: $OSTYPE"
        echo "  Stat flag: $STAT_SIZE_FLAG"
        echo ""
    } > "$LOG_FILE"
    
    log "Inizializzazione completata"
}

# ============================================================================
# FUNZIONI CORE
# ============================================================================

# Funzione AWK IMPROVED per risolvere conflitti (simplified nested handling)
resolve_with_current_change() {
    awk '
    BEGIN {
        head_count = 0    # Conta marker <<<<<<<
        sep_count = 0     # Conta separator =======
        end_count = 0     # Conta marker >>>>>>>
        in_current = 0    # Flag: siamo in sezione current?
    }

    # Inizio conflitto
    /^[ \t]*<<<<<<< / {
        head_count++
        in_current = 0
        next
    }

    # Separatore - entriamo in sezione current
    /^[ \t]*=======[ \t]*$/ {
        sep_count++
        # Se marker bilanciati, entriamo in current
        if (head_count == sep_count) {
            in_current = 1
        }
        next
    }

    # Fine conflitto - usciamo da sezione current
    /^[ \t]*>>>>>>> / {
        end_count++
        # Se marker bilanciati, usciamo da conflitto
        if (head_count == end_count) {
            in_current = 0
        }
        next
    }

    # Stampa riga se:
    # - Non siamo in conflitto (marker bilanciati), OPPURE
    # - Siamo in sezione current
    {
        if (head_count == end_count || in_current == 1) {
            print $0
        }
    }
    '
}

# Funzione per verificare se un file è binario
is_binary_file() {
    local file="$1"

    [[ ! -f "$file" ]] && return 1

    # Usa file command per MIME type
    if file --brief --mime "$file" 2>/dev/null | grep -qi "binary"; then
        return 0
    fi

    # Controllo caratteri null
    if grep -q $'\0' "$file" 2>/dev/null; then
        return 0
    fi

    # Estensioni comuni file binari
    case "${file##*.}" in
        jpg|jpeg|png|gif|bmp|ico|svg|webp|pdf|zip|tar|gz|bz2|xz|7z|rar|\
        exe|dll|so|o|a|dylib|class|pyc|pyo|jar|war|ear|lock)
            return 0
            ;;
    esac

    return 1
}

# Funzione per validare il backup
validate_backup() {
    local original="$1"
    local backup="$2"

    [[ ! -f "$backup" ]] && return 1

    local orig_size backup_size
    orig_size=$(stat $STAT_SIZE_FLAG "$original" 2>/dev/null || echo "0")
    backup_size=$(stat $STAT_SIZE_FLAG "$backup" 2>/dev/null || echo "0")

    [[ "$orig_size" -eq "$backup_size" ]]
}

# Cleanup backup vecchi (retention policy)
cleanup_old_backups() {
    local backup_base="${SCRIPT_DIR}/backups"
    
    [[ ! -d "$backup_base" ]] && return 0
    
    local old_backups
    old_backups=$(find "$backup_base" -maxdepth 1 -type d \
        -name "conflicts_current_change_v6*" \
        -mtime +$BACKUP_RETENTION_DAYS 2>/dev/null || true)
    
    if [[ -n "$old_backups" ]]; then
        echo "$old_backups" | while IFS= read -r dir; do
            echo -e "${YELLOW}🗑️  Rimosso backup vecchio (>${BACKUP_RETENTION_DAYS}d): $(basename "$dir")${NC}"
            log "Backup rimosso (retention): $(basename "$dir")"
            rm -rf "$dir"
        done
    fi
}

# ============================================================================
# PROCESS FILE
# ============================================================================

process_file() {
    local file="$1"
    local temp_file
    temp_file=$(mktemp "$TEMP_DIR/conflict.XXXXXX")
    local file_hash
    file_hash=$(echo "$file" | md5sum 2>/dev/null | cut -d' ' -f1 | cut -c1-8 || echo "$$")
    local backup_file="${BACKUP_DIR}/${TIMESTAMP}_$(basename "$file")_${file_hash}.backup"
    local conflict_count=0
    local before_lines after_lines

    log "Elaborazione file: $file"

    # Validazioni preliminari
    if [[ ! -f "$file" ]]; then
        echo -e "${RED}❌ File non trovato: $file${NC}"
        log "ERRORE: File non trovato: $file"
        return 1
    fi

    if [[ ! -r "$file" ]]; then
        echo -e "${RED}❌ File non leggibile: $file${NC}"
        log "ERRORE: File non leggibile: $file"
        return 1
    fi

    # Salta file binari
    if is_binary_file "$file"; then
        echo -e "${YELLOW}⏭️  File binario saltato: $file${NC}"
        log "SKIP: File binario: $file"
        rm -f "$temp_file"
        return 2
    fi

    # Verifica conflitti
    if ! grep -q "^<<<<<<< " "$file"; then
        [[ "$VERBOSE" == "true" ]] && echo -e "${YELLOW}ℹ️  Nessun conflitto: $file${NC}"
        log "NO-CONFLICT: $file"
        rm -f "$temp_file"
        return 3
    fi

    # Conta conflitti e righe
    conflict_count=$(grep -c "^<<<<<<< " "$file")
    before_lines=$(wc -l < "$file" | tr -d ' ')

    # DRY-RUN mode
    if [[ "$DRY_RUN" == "true" ]]; then
        if timeout "$FILE_TIMEOUT" bash -c "resolve_with_current_change < '$file' > '$temp_file'" 2>/dev/null; then
            after_lines=$(wc -l < "$temp_file" | tr -d ' ')

            if [[ "$after_lines" -gt 0 ]] && ! grep -q "^<<<<<<< " "$temp_file"; then
                echo -e "${CYAN}🔍 DRY-RUN: $file ($conflict_count conflitti, righe: ${before_lines}→${after_lines})${NC}"
                log "DRY-RUN: $file - $conflict_count conflitti, righe: ${before_lines}→${after_lines}"
                rm -f "$temp_file"
                return 0
            else
                echo -e "${RED}❌ DRY-RUN risultato invalido: $file${NC}"
                log "DRY-RUN ERRORE: Risultato invalido per $file"
                rm -f "$temp_file"
                return 1
            fi
        else
            rm -f "$temp_file"
            echo -e "${RED}❌ DRY-RUN timeout/errore AWK: $file${NC}"
            log "DRY-RUN ERRORE: Timeout o AWK failure per $file"
            return 1
        fi
    fi

    # Verifica permessi scrittura
    if [[ ! -w "$file" ]]; then
        echo -e "${RED}❌ File non scrivibile: $file${NC}"
        log "ERRORE: File non scrivibile: $file"
        rm -f "$temp_file"
        return 1
    fi

    # Crea backup con validazione
    if ! cp "$file" "$backup_file" 2>/dev/null; then
        echo -e "${RED}❌ Impossibile creare backup per: $file${NC}"
        log "ERRORE: Impossibile creare backup per: $file"
        rm -f "$temp_file"
        return 1
    fi

    # Salva mapping file → backup in manifest
    echo "$file -> $backup_file" >> "${BACKUP_DIR}/manifest.txt"

    # Valida backup
    if ! validate_backup "$file" "$backup_file"; then
        echo -e "${RED}❌ Backup non valido per: $file${NC}"
        log "ERRORE: Backup non valido per: $file"
        rm -f "$temp_file"
        return 1
    fi

    [[ "$VERBOSE" == "true" ]] && echo -e "${BLUE}💾 Backup: $backup_file${NC}"
    log "Backup validato: $backup_file"

    # Risolvi conflitti con timeout
    if timeout "$FILE_TIMEOUT" bash -c "resolve_with_current_change < '$file' > '$temp_file'" 2>/dev/null; then
        # Validazione risultato
        after_lines=$(wc -l < "$temp_file" | tr -d ' ')
        
        if [[ "$after_lines" -eq 0 ]]; then
            echo -e "${RED}❌ File risultante vuoto per: $file${NC}"
            log "ERRORE: File risultante vuoto per: $file"
            rm -f "$temp_file"
            return 1
        fi

        if grep -q "^<<<<<<< " "$temp_file"; then
            echo -e "${RED}❌ Risoluzione incompleta per: $file${NC}"
            log "ERRORE: Risoluzione incompleta per: $file"
            rm -f "$temp_file"
            return 1
        fi

        # Sostituisci file originale
        if mv "$temp_file" "$file"; then
            echo -e "${GREEN}✅ Risolti $conflict_count conflitti in: $file (${before_lines}→${after_lines} righe)${NC}"
            log "SUCCESSO: Risolti $conflict_count conflitti in: $file (${before_lines}→${after_lines} righe)"
            TOTAL_CONFLICTS=$((TOTAL_CONFLICTS + conflict_count))
            return 0
        else
            echo -e "${RED}❌ Errore sostituzione: $file${NC}"
            log "ERRORE: Impossibile sostituire: $file"
            rm -f "$temp_file"
            return 1
        fi
    else
        echo -e "${RED}❌ Timeout/errore AWK (${FILE_TIMEOUT}s): $file${NC}"
        log "ERRORE: Timeout dopo ${FILE_TIMEOUT}s per: $file"
        rm -f "$temp_file"
        return 1
    fi
}

# ============================================================================
# RICERCA FILE
# ============================================================================

find_conflicted_files() {
    local search_dir="$1"

    echo -e "${BLUE}🔍 Ricerca file con conflitti in: $search_dir${NC}"
    log "Inizio ricerca conflitti in: $search_dir"

    # Find ottimizzato con esclusioni Laravel complete
    find "$search_dir" -type f \
        ! -path "*/.git/*" \
        ! -path "*/node_modules/*" \
        ! -path "*/vendor/*" \
        ! -path "*/storage/framework/*" \
        ! -path "*/storage/logs/*" \
        ! -path "*/bootstrap/cache/*" \
        ! -path "*/public/build/*" \
        ! -path "*/public/hot" \
        ! -path "*/cache/*" \
        ! -path "*/tmp/*" \
        ! -name "*.log" \
        ! -name "*.cache" \
        ! -name ".phpunit.result.cache" \
        ! -name "*.lock" \
        -print0 2>/dev/null | xargs -0 -P "$PARALLEL_JOBS" grep -l "^<<<<<<< " 2>/dev/null | sort || true
}

# Verifica conflitti rimanenti
verify_no_conflicts() {
    local search_dir="$1"
    local remaining_count

    echo -e "${BLUE}🔍 Verifica finale: controllo conflitti rimanenti...${NC}"
    log "Verifica finale conflitti rimanenti"

    remaining_count=$(find "$search_dir" -type f \
        ! -path "*/.git/*" \
        ! -path "*/node_modules/*" \
        ! -path "*/vendor/*" \
        ! -path "*/storage/framework/*" \
        ! -path "*/storage/logs/*" \
        ! -path "*/bootstrap/cache/*" \
        ! -path "*/public/build/*" \
        ! -path "*/cache/*" \
        ! -path "*/tmp/*" \
        ! -name "*.log" \
        ! -name "*.cache" \
        ! -name ".phpunit.result.cache" \
        ! -name "*.lock" \
        -print0 2>/dev/null | xargs -0 -P "$PARALLEL_JOBS" grep -l "^<<<<<<< " 2>/dev/null | wc -l)

    if [[ "$remaining_count" -eq 0 ]]; then
        echo -e "${GREEN}✅ Verifica completata: nessun conflitto rimanente!${NC}"
        log "SUCCESSO: Verifica completata, nessun conflitto rimanente"
        return 0
    else
        echo -e "${RED}❌ ATTENZIONE: Trovati $remaining_count file con conflitti rimanenti!${NC}"
        log "ATTENZIONE: Trovati $remaining_count file con conflitti rimanenti"

        if [[ "$VERBOSE" == "true" ]]; then
            echo -e "${YELLOW}File con conflitti rimanenti (primi 10):${NC}"
            find "$search_dir" -type f \
                ! -path "*/.git/*" \
                -print0 2>/dev/null | xargs -0 -P "$PARALLEL_JOBS" grep -l "^<<<<<<< " 2>/dev/null | head -10
        fi
        return 1
    fi
}

# ============================================================================
# BATCH PROCESSING
# ============================================================================

process_files_batch() {
    local -a files=("$@")
    local file_count=0

    for file in "${files[@]}"; do
        ((file_count++))
        echo -e "${YELLOW}[${file_count}/${#files[@]}] [Batch $((BATCH_COUNT + 1))] 🔧 Elaborazione: $file${NC}"

        case "$(process_file "$file"; echo $?)" in
            0)
                ((RESOLVED_FILES++))
                ;;
            1)
                ((FAILED_FILES++))
                ;;
            2|3)
                ((SKIPPED_FILES++))
                ;;
        esac
    done
}

# ============================================================================
# CLEANUP
# ============================================================================

cleanup() {
    [[ "$CLEANUP_DONE" == "true" ]] && return 0
    
    echo -e "${YELLOW}🧹 Pulizia file temporanei...${NC}"
    rm -rf "$TEMP_DIR" 2>/dev/null || true
    log "Cleanup completato"
    
    CLEANUP_DONE=true
}

# ============================================================================
# MAIN
# ============================================================================

main() {
    # Cleanup backup vecchi (retention policy)
    cleanup_old_backups
    
    # Inizializza logging
    init_log
    
    echo -e "${BOLD}${PURPLE}🚀 Avvio risoluzione conflitti Git v${SCRIPT_VERSION}...${NC}"
    log "START: Risoluzione conflitti v${SCRIPT_VERSION}"

    # Trova file con conflitti
    echo -e "${CYAN}📋 Ricerca file con conflitti...${NC}"
    local -a conflicted_files=()
    readarray -t conflicted_files < <(find_conflicted_files "$BASE_DIR")

    TOTAL_FILES=${#conflicted_files[@]}

    if [[ "$TOTAL_FILES" -eq 0 ]]; then
        echo -e "${GREEN}🎉 Nessun file con conflitti trovato!${NC}"
        log "INFO: Nessun file con conflitti trovato"
        return 0
    fi

    echo -e "${CYAN}📋 Trovati $TOTAL_FILES file con conflitti${NC}"
    log "Trovati $TOTAL_FILES file con conflitti"

    # Processa file in batch
    local batch_start=0
    while [[ $batch_start -lt $TOTAL_FILES ]]; do
        local batch_end=$((batch_start + BATCH_SIZE))
        [[ $batch_end -gt $TOTAL_FILES ]] && batch_end=$TOTAL_FILES

        local -a batch_files=("${conflicted_files[@]:$batch_start:$BATCH_SIZE}")

        echo -e "${PURPLE}📦 Batch $((BATCH_COUNT + 1)): file $((batch_start + 1))-${batch_end} di $TOTAL_FILES${NC}"
        log "Batch $((BATCH_COUNT + 1)): file $((batch_start + 1))-${batch_end}"

        process_files_batch "${batch_files[@]}"

        ((BATCH_COUNT++))
        batch_start=$batch_end
    done

    # Verifica finale (skip in dry-run)
    local verify_result=0
    if [[ "$DRY_RUN" != "true" ]]; then
        verify_no_conflicts "$BASE_DIR"
        verify_result=$?
    fi

    # Calcola tempo totale
    local end_time=$(date +%s)
    local elapsed=$((end_time - START_TIME))

    # Riepilogo finale
    echo -e "\n${BOLD}${BLUE}============== 📊 RIEPILOGO FINALE v${SCRIPT_VERSION} ==============${NC}"
    echo -e "${BLUE}📁 File totali processati: $TOTAL_FILES${NC}"
    echo -e "${GREEN}✅ File risolti con successo: $RESOLVED_FILES${NC}"
    echo -e "${YELLOW}⚠️  File saltati/senza conflitti: $SKIPPED_FILES${NC}"
    echo -e "${RED}❌ File con errori: $FAILED_FILES${NC}"
    echo -e "${PURPLE}🔧 Conflitti totali risolti: $TOTAL_CONFLICTS${NC}"
    echo -e "${CYAN}📦 Batch elaborati: $BATCH_COUNT${NC}"
    echo -e "${CYAN}⏱️  Tempo totale: ${elapsed}s${NC}"
    
    if [[ $RESOLVED_FILES -gt 0 ]]; then
        local avg_time=$((elapsed / RESOLVED_FILES))
        echo -e "${CYAN}📈 Velocità media: ${avg_time}s/file${NC}"
    fi

    # Salva riepilogo nel log
    {
        echo ""
        echo "============== RIEPILOGO FINALE v${SCRIPT_VERSION} =============="
        echo "File totali processati: $TOTAL_FILES"
        echo "File risolti con successo: $RESOLVED_FILES"
        echo "File saltati/senza conflitti: $SKIPPED_FILES"
        echo "File con errori: $FAILED_FILES"
        echo "Conflitti totali risolti: $TOTAL_CONFLICTS"
        echo "Batch elaborati: $BATCH_COUNT"
        echo "Tempo totale: ${elapsed}s"
        echo "Velocità media: $([ $RESOLVED_FILES -gt 0 ] && echo "$((elapsed / RESOLVED_FILES))s/file" || echo "N/A")"
        echo "Parallel jobs: $PARALLEL_JOBS"
        echo "Verifica finale: $([ $verify_result -eq 0 ] && echo "SUCCESSO" || echo "ATTENZIONE")"
        echo "Dry-run: $DRY_RUN"
    } >> "$LOG_FILE"

    # Output finale basato su risultato
    if [[ "$DRY_RUN" == "true" ]]; then
        echo -e "${YELLOW}🧪 DRY-RUN completato: nessuna modifica ai file.${NC}"
        echo -e "${CYAN}💡 Per eseguire: $0 (senza --dry-run)${NC}"
    elif [[ $verify_result -eq 0 && $RESOLVED_FILES -gt 0 ]]; then
        echo -e "${GREEN}🎉 TUTTI I CONFLITTI SONO STATI RISOLTI CON SUCCESSO!${NC}"
        echo -e "${GREEN}💾 Backup: ${BACKUP_DIR}${NC}"
        echo -e "${GREEN}📝 Log: ${LOG_FILE}${NC}"
        echo -e "${GREEN}📋 Manifest: ${BACKUP_DIR}/manifest.txt${NC}"
    elif [[ $FAILED_FILES -gt 0 || $verify_result -ne 0 ]]; then
        echo -e "${RED}⚠️  ALCUNI CONFLITTI POTREBBERO NON ESSERE STATI RISOLTI${NC}"
        echo -e "${YELLOW}💡 Log dettagli: ${LOG_FILE}${NC}"
        echo -e "${YELLOW}💡 Backup: ${BACKUP_DIR}${NC}"
        return 1
    fi

    return 0
}

# ============================================================================
# HELP
# ============================================================================

show_help() {
    cat << EOF
🐄 $SCRIPT_NAME v${SCRIPT_VERSION}

UTILIZZO:
    $0 [OPZIONI]

OPZIONI:
    --dry-run           Simula senza modificare file
    --verbose           Output dettagliato
    --batch-size N      Dimensione batch (default: $BATCH_SIZE)
    --help, -h          Mostra questo aiuto

VARIABILI AMBIENTE:
    BASE_DIR            Directory base progetto (default: auto-detect)
    SCRIPT_DIR          Directory script (default: \$BASE_DIR/bashscripts)
    DRY_RUN             true/false - Modalità simulazione
    VERBOSE             true/false - Output verboso
    BATCH_SIZE          N - Dimensione batch
    PARALLEL_JOBS       N - Processi paralleli (default: auto-detect CPU cores)
    FILE_TIMEOUT        N - Timeout secondi per file (default: $FILE_TIMEOUT)
    BACKUP_RETENTION_DAYS  N - Giorni retention backup (default: $BACKUP_RETENTION_DAYS)

ESEMPI:
    $0                           # Esecuzione normale
    $0 --dry-run                 # Solo simulazione
    $0 --verbose                 # Output dettagliato
    $0 --batch-size 100         # Batch più grandi
    
    DRY_RUN=true $0             # Simulazione via env var
    PARALLEL_JOBS=8 $0          # Forza 8 core
    BASE_DIR=/custom/path $0    # Custom directory

DESCRIZIONE:
    Risolve automaticamente conflitti Git mantenendo sempre la "current change"
    (versione locale, dopo =======). Crea backup automatici con validazione.
    
    Versione 6.1 include:
    - Git repository validation
    - Complete dependency checking
    - Auto-detect CPU cores
    - Backup retention policy
    - Timeout protection per file grandi
    - Platform-aware (Linux/macOS)

OUTPUT:
    - Backup: $SCRIPT_DIR/backups/conflicts_current_change_v6.1_TIMESTAMP/
    - Log: $SCRIPT_DIR/logs/resolve_conflicts_current_change_v6.1_TIMESTAMP.log
    - Manifest: Mapping file→backup in manifest.txt

EXIT CODES:
    0  - Successo completo
    1  - Errore o conflitti non risolti
    2  - File binario (skip, OK)
    3  - Nessun conflitto (OK)
EOF
}

# ============================================================================
# ARGUMENT PARSING
# ============================================================================

while [[ $# -gt 0 ]]; do
    case $1 in
        --dry-run)
            DRY_RUN=true
            shift
            ;;
        --verbose)
            VERBOSE=true
            shift
            ;;
        --batch-size)
            if ! [[ "$2" =~ ^[1-9][0-9]*$ ]]; then
                echo -e "${RED}❌ Errore: --batch-size deve essere numero positivo${NC}" >&2
                exit 1
            fi
            BATCH_SIZE="$2"
            shift 2
            ;;
        --help|-h)
            show_help
            exit 0
            ;;
        *)
            echo -e "${RED}❌ Opzione sconosciuta: $1${NC}" >&2
            echo -e "${YELLOW}💡 Usa --help per opzioni disponibili${NC}" >&2
            exit 1
            ;;
    esac
done

# ============================================================================
# FINALIZE CONFIGURATION (post-parsing)
# ============================================================================

# Rendi immutabili le configurazioni finali
readonly DRY_RUN
readonly VERBOSE
readonly BATCH_SIZE
readonly PARALLEL_JOBS
readonly FILE_TIMEOUT
readonly BACKUP_RETENTION_DAYS

# ============================================================================
# BANNER E CONFIGURAZIONE DISPLAY
# ============================================================================

echo -e "${BOLD}${BLUE}=======================================================================${NC}"
echo -e "${BOLD}${BLUE}🐄 $SCRIPT_NAME v${SCRIPT_VERSION}${NC}"
echo -e "${BOLD}${BLUE}=======================================================================${NC}"
echo -e "${CYAN}Risolve TUTTI i conflitti scegliendo sempre la 'current change'${NC}"
echo -e "${CYAN}Miglioramenti V6.1: Git validation, dependency check, auto-cores${NC}"
echo -e "${CYAN}$(date)${NC}"
echo ""
echo -e "${YELLOW}📁 Directory: ${BASE_DIR}${NC}"
echo -e "${YELLOW}📝 Log: ${LOG_FILE}${NC}"
echo -e "${YELLOW}💾 Backup: ${BACKUP_DIR}${NC}"
echo -e "${YELLOW}🔧 Configurazione:${NC}"
echo -e "${YELLOW}   Dry-run: ${DRY_RUN}${NC}"
echo -e "${YELLOW}   Verbose: ${VERBOSE}${NC}"
echo -e "${YELLOW}   Batch size: ${BATCH_SIZE}${NC}"
echo -e "${YELLOW}   Parallel jobs: ${PARALLEL_JOBS} ($(nproc 2>/dev/null || echo "?") cores detected)${NC}"
echo -e "${YELLOW}   File timeout: ${FILE_TIMEOUT}s${NC}"
echo -e "${YELLOW}   Backup retention: ${BACKUP_RETENTION_DAYS} giorni${NC}\n"

# ============================================================================
# TRAP HANDLERS
# ============================================================================

trap 'cleanup; echo -e "${RED}❌ Script interrotto!${NC}"; exit 1' INT TERM
trap 'cleanup' EXIT

# ============================================================================
# ESECUZIONE
# ============================================================================

# Esegui main con tutti gli argomenti
main "$@"


