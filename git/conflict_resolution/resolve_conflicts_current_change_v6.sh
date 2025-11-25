#!/bin/bash

# =========================================================================
# 🐄 SuperMucca Ultimate Conflict Resolver - Current Change Edition V6.1
# =========================================================================
# Script per risolvere automaticamente i conflitti Git scegliendo sempre la "current change"
# Posizione: bashscripts/git/conflict_resolution/
# Autore: AI Assistant con poteri della supermucca
# Versione: 6.1 - Bug fix critici (2025-06-04)
# Data: $(date +%Y-%m-%d)
# Miglioramenti V6.0:
# - Gestione migliorata di conflitti annidati
# - Validazione più robusta degli AWK pattern
# - Migliore gestione dei caratteri speciali
# - Backup più sicuro con validazione
# - Performance ottimizzate per grandi quantità di file
# Bug Fix V6.1 (2025-06-04):
# - P0: Fix cleanup file temporanei (cercava in /tmp invece di BASE_DIR)
# - P1: Ottimizzazione stat (detection una volta sola, no fallback ripetuti)
# - P1: Cattura exit code robusta (no command substitution fragile)
# =========================================================================

set -euo pipefail
IFS=$'\n\t'

# Colori per output
readonly RED='\033[0;31m'
readonly GREEN='\033[0;32m'
readonly YELLOW='\033[0;33m'
readonly BLUE='\033[0;34m'
readonly PURPLE='\033[0;35m'
readonly CYAN='\033[0;36m'
readonly BOLD='\033[1m'
readonly NC='\033[0m' # No Color

# Directory di base (configurabile via env var)
readonly BASE_DIR="${BASE_DIR:-/var/www/_bases/base_ptvx_fila4_mono}"
readonly SCRIPT_DIR="${SCRIPT_DIR:-${BASE_DIR}/bashscripts}"

# Configurazione
DRY_RUN=${DRY_RUN:-false}
VERBOSE=${VERBOSE:-false}
BATCH_SIZE=${BATCH_SIZE:-50}  # Processa file in batch per performance
readonly TIMESTAMP=$(date +%Y%m%d_%H%M%S)
readonly BACKUP_DIR="${SCRIPT_DIR}/backups/conflicts_current_change_v6_${TIMESTAMP}"
readonly LOG_DIR="${SCRIPT_DIR}/logs"
readonly LOG_FILE="${LOG_DIR}/resolve_conflicts_current_change_v6_${TIMESTAMP}.log"

# Crea directory necessarie
mkdir -p "$LOG_DIR" "$BACKUP_DIR"

# Contatori globali
declare -i TOTAL_FILES=0
declare -i RESOLVED_FILES=0
declare -i FAILED_FILES=0
declare -i SKIPPED_FILES=0
declare -i TOTAL_CONFLICTS=0
declare -i BATCH_COUNT=0

# FIX P1: Detection comando stat (GNU vs BSD) una volta sola
if stat -c%s /dev/null >/dev/null 2>&1; then
    # GNU stat (Linux)
    readonly STAT_SIZE_CMD="stat -c%s"
elif stat -f%z /dev/null >/dev/null 2>&1; then
    # BSD stat (macOS)
    readonly STAT_SIZE_CMD="stat -f%z"
else
    echo -e "${RED}❌ Errore: comando stat non supportato su questo sistema${NC}" >&2
    exit 1
fi

# Banner
echo -e "${BOLD}${BLUE}=======================================================================${NC}"
echo -e "${BOLD}${BLUE}🐄 SuperMucca Ultimate Conflict Resolver - Current Change Edition V6.1${NC}"
echo -e "${BOLD}${BLUE}=======================================================================${NC}"
echo -e "${CYAN}Risolve TUTTI i conflitti scegliendo sempre la 'current change'${NC}"
echo -e "${CYAN}V6.1: Bug fix critici P0+P1 (cleanup temp, stat optimization)${NC}"
echo -e "${CYAN}$(date)${NC}"
echo -e "${YELLOW}📁 Directory: ${BASE_DIR}${NC}"
echo -e "${YELLOW}📝 Log: ${LOG_FILE}${NC}"
echo -e "${YELLOW}💾 Backup: ${BACKUP_DIR}${NC}"
echo -e "${YELLOW}🧪 Dry-run: ${DRY_RUN}${NC}"
echo -e "${YELLOW}🔍 Verbose: ${VERBOSE}${NC}"
echo -e "${YELLOW}📦 Batch size: ${BATCH_SIZE}${NC}\n"

# Funzione per log con timestamp
log() {
    local message="$*"
    local timestamp=$(date '+%Y-%m-%d %H:%M:%S')
    echo "[$timestamp] $message" >> "$LOG_FILE"
}

# Inizializza log
{
    echo "======================================================================="
    echo "🐄 SuperMucca Ultimate Conflict Resolver - Current Change Edition V6.1"
    echo "======================================================================="
    echo "Data: $(date)"
    echo "Version: 6.1 (Bug fix P0+P1)"
    echo "Dry-run: $DRY_RUN"
    echo "Verbose: $VERBOSE"
    echo "Batch size: $BATCH_SIZE"
    echo "Directory: $BASE_DIR"
    echo ""
} > "$LOG_FILE"

# Funzione AWK migliorata per risolvere conflitti
resolve_with_current_change() {
    awk '
    BEGIN {
        state = 0
        conflict_depth = 0
        # state 0: normale
        # state 1: dentro conflitto HEAD (da scartare)
        # state 2: dentro conflitto CURRENT (da mantenere)
    }

    # Inizio conflitto - gestisce anche conflitti annidati
    /^<<<<<<< / {
        if (state == 0) {
            state = 1
            conflict_depth = 1
        } else {
            conflict_depth++
        }
        next
    }

    # Separatore - solo per il livello di conflitto corrente
    /^=======/ {
        if (state == 1 && conflict_depth == 1) {
            state = 2
        }
        next
    }

    # Fine conflitto - gestisce anche conflitti annidati
    /^>>>>>>> / {
        if (conflict_depth == 1) {
            state = 0
            conflict_depth = 0
        } else {
            conflict_depth--
        }
        next
    }

    # Stampa la riga se:
    # - Non siamo in conflitto (state 0), OPPURE
    # - Siamo nella sezione current change (state 2)
    {
        if (state == 0 || state == 2) {
            print $0
        }
    }
    '
}

# Funzione per verificare se un file è binario (migliorata)
is_binary_file() {
    local file="$1"

    # Prima verifica se il file esiste
    [[ ! -f "$file" ]] && return 1

    # Usa il comando file per verificare se è binario
    if file --brief --mime "$file" 2>/dev/null | grep -qi "binary"; then
        return 0  # È binario
    fi

    # Controllo aggiuntivo: se contiene caratteri null
    if grep -q $'\0' "$file" 2>/dev/null; then
        return 0  # È binario
    fi

    # Controllo per estensioni comuni di file binari
    case "${file##*.}" in
        jpg|jpeg|png|gif|bmp|ico|pdf|zip|tar|gz|bz2|xz|7z|rar|exe|dll|so|o|a|class|pyc)
            return 0  # È binario
            ;;
    esac

    return 1  # Non è binario
}

# Funzione per validare il backup
validate_backup() {
    local original="$1"
    local backup="$2"

    # Verifica che il backup esista e abbia la stessa dimensione
    if [[ ! -f "$backup" ]]; then
        return 1
    fi

    # FIX P1: Usa variabile stat rilevata all'init (no fallback ripetuto)
    local orig_size backup_size
    orig_size=$($STAT_SIZE_CMD "$original" 2>/dev/null || echo "0")
    backup_size=$($STAT_SIZE_CMD "$backup" 2>/dev/null || echo "0")

    [[ "$orig_size" -eq "$backup_size" ]]
}

# Funzione per processare un singolo file (migliorata)
process_file() {
    local file="$1"
    local temp_file="${file}.tmp.${TIMESTAMP}.$$"
    local backup_file="${BACKUP_DIR}/$(basename "$file").$(echo "$file" | tr '/' '_').backup"
    local conflict_count=0
    local before_lines after_lines

    log "Elaborazione file: $file"

    # Verifica completa del file
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
        return 2
    fi

    # Verifica se ci sono conflitti
    if ! grep -q "^<<<<<<< " "$file"; then
        [[ "$VERBOSE" == "true" ]] && echo -e "${YELLOW}ℹ️  Nessun conflitto: $file${NC}"
        log "NO-CONFLICT: $file"
        return 3
    fi

    # Conta i conflitti
    conflict_count=$(grep -c "^<<<<<<< " "$file")
    before_lines=$(wc -l < "$file" | tr -d ' ')

    if [[ "$DRY_RUN" == "true" ]]; then
        # Modalità dry-run: solo simulazione
        if resolve_with_current_change < "$file" > "$temp_file" 2>/dev/null; then
            after_lines=$(wc -l < "$temp_file" | tr -d ' ')

            # Verifica che il risultato sia valido
            if [[ -s "$temp_file" ]] && ! grep -q "^<<<<<<< " "$temp_file"; then
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
            echo -e "${RED}❌ DRY-RUN errore AWK: $file${NC}"
            log "DRY-RUN ERRORE AWK: $file"
            return 1
        fi
    fi

    # Verifica permessi di scrittura
    if [[ ! -w "$file" ]]; then
        echo -e "${RED}❌ File non scrivibile: $file${NC}"
        log "ERRORE: File non scrivibile: $file"
        return 1
    fi

    # Crea backup con validazione
    if ! cp "$file" "$backup_file"; then
        echo -e "${RED}❌ Impossibile creare backup per: $file${NC}"
        log "ERRORE: Impossibile creare backup per: $file"
        return 1
    fi

    # Valida il backup
    if ! validate_backup "$file" "$backup_file"; then
        echo -e "${RED}❌ Backup non valido per: $file${NC}"
        log "ERRORE: Backup non valido per: $file"
        return 1
    fi

    [[ "$VERBOSE" == "true" ]] && echo -e "${BLUE}💾 Backup creato e validato: $backup_file${NC}"
    log "Backup creato e validato: $backup_file"

    # Risolvi conflitti
    if resolve_with_current_change < "$file" > "$temp_file" 2>/dev/null; then
        # Verifica che il file temporaneo sia valido
        if [[ ! -s "$temp_file" ]]; then
            echo -e "${RED}❌ File risultante vuoto per: $file${NC}"
            log "ERRORE: File risultante vuoto per: $file"
            rm -f "$temp_file"
            return 1
        fi

        # Verifica che non ci siano più conflitti nel file risultante
        if grep -q "^<<<<<<< " "$temp_file"; then
            echo -e "${RED}❌ Risoluzione incompleta per: $file${NC}"
            log "ERRORE: Risoluzione incompleta per: $file"
            rm -f "$temp_file"
            return 1
        fi

        # Confronta dimensioni per sicurezza aggiuntiva
        after_lines=$(wc -l < "$temp_file" | tr -d ' ')
        if [[ "$after_lines" -eq 0 ]]; then
            echo -e "${RED}❌ File risultante vuoto (0 righe) per: $file${NC}"
            log "ERRORE: File risultante vuoto per: $file"
            rm -f "$temp_file"
            return 1
        fi

        # Sostituisci il file originale
        if mv "$temp_file" "$file"; then
            echo -e "${GREEN}✅ Risolti $conflict_count conflitti in: $file (${before_lines}→${after_lines} righe)${NC}"
            log "SUCCESSO: Risolti $conflict_count conflitti in: $file (${before_lines}→${after_lines} righe)"
            TOTAL_CONFLICTS=$((TOTAL_CONFLICTS + conflict_count))
            return 0
        else
            echo -e "${RED}❌ Errore durante la sostituzione di: $file${NC}"
            log "ERRORE: Impossibile sostituire: $file"
            rm -f "$temp_file"
            return 1
        fi
    else
        echo -e "${RED}❌ Errore AWK nella risoluzione di: $file${NC}"
        log "ERRORE: Errore AWK nella risoluzione di: $file"
        rm -f "$temp_file"
        return 1
    fi
}

# Funzione per trovare tutti i file con conflitti (ottimizzata)
find_conflicted_files() {
    local search_dir="$1"

    echo -e "${BLUE}🔍 Ricerca file con conflitti in: $search_dir${NC}"
    log "Inizio ricerca conflitti in: $search_dir"

    # Usa find ottimizzato con xargs per performance migliori
    find "$search_dir" -type f \
        ! -path "*/.git/*" \
        ! -path "*/node_modules/*" \
        ! -path "*/vendor/*" \
        ! -path "*/storage/logs/*" \
        ! -path "*/cache/*" \
        ! -path "*/tmp/*" \
        ! -name "*.log" \
        ! -name "*.cache" \
        -print0 | xargs -0 -P 4 grep -l "^<<<<<<< " 2>/dev/null | sort || true
}

# Funzione per verificare conflitti rimanenti (ottimizzata)
verify_no_conflicts() {
    local search_dir="$1"
    local remaining_count

    echo -e "${BLUE}🔍 Verifica finale: controllo conflitti rimanenti...${NC}"
    log "Verifica finale conflitti rimanenti"

    remaining_count=$(find "$search_dir" -type f \
        ! -path "*/.git/*" \
        ! -path "*/node_modules/*" \
        ! -path "*/vendor/*" \
        ! -path "*/storage/logs/*" \
        ! -path "*/cache/*" \
        ! -path "*/tmp/*" \
        ! -name "*.log" \
        ! -name "*.cache" \
        -print0 | xargs -0 -P 4 grep -l "^<<<<<<< " 2>/dev/null | wc -l)

    if [[ "$remaining_count" -eq 0 ]]; then
        echo -e "${GREEN}✅ Verifica completata: nessun conflitto rimanente!${NC}"
        log "SUCCESSO: Verifica completata, nessun conflitto rimanente"
        return 0
    else
        echo -e "${RED}❌ ATTENZIONE: Trovati $remaining_count file con conflitti rimanenti!${NC}"
        log "ATTENZIONE: Trovati $remaining_count file con conflitti rimanenti"

        # Mostra i file rimanenti se in modalità verbose
        if [[ "$VERBOSE" == "true" ]]; then
            echo -e "${YELLOW}File con conflitti rimanenti (primi 10):${NC}"
            find "$search_dir" -type f \
                ! -path "*/.git/*" \
                ! -path "*/node_modules/*" \
                ! -path "*/vendor/*" \
                ! -path "*/storage/logs/*" \
                ! -path "*/cache/*" \
                ! -path "*/tmp/*" \
                ! -name "*.log" \
                ! -name "*.cache" \
                -print0 | xargs -0 -P 4 grep -l "^<<<<<<< " 2>/dev/null | head -10
        fi
        return 1
    fi
}

# Funzione per processare file in batch
process_files_batch() {
    local -a files=("$@")
    local file_count=0

    for file in "${files[@]}"; do
        ((file_count++))
        echo -e "${YELLOW}[${file_count}/${#files[@]}] [Batch $((BATCH_COUNT + 1))] 🔧 Elaborazione: $file${NC}"

        # FIX P1: Cattura exit code in modo robusto (no command substitution)
        process_file "$file"
        local exit_code=$?
        
        case $exit_code in
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

# Funzione principale migliorata
main() {
    echo -e "${BOLD}${PURPLE}🚀 Avvio risoluzione conflitti Git V6.1...${NC}"
    log "START: Risoluzione conflitti V6.1 (dry=$DRY_RUN, verbose=$VERBOSE, batch=$BATCH_SIZE)"

    # Trova tutti i file con conflitti
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

    # Processa file in batch per performance
    local batch_start=0
    while [[ $batch_start -lt $TOTAL_FILES ]]; do
        local batch_end=$((batch_start + BATCH_SIZE))
        [[ $batch_end -gt $TOTAL_FILES ]] && batch_end=$TOTAL_FILES

        local -a batch_files=("${conflicted_files[@]:$batch_start:$BATCH_SIZE}")

        echo -e "${PURPLE}📦 Batch $((BATCH_COUNT + 1)): elaborazione file $((batch_start + 1))-${batch_end} di $TOTAL_FILES${NC}"
        log "Inizio batch $((BATCH_COUNT + 1)): file $((batch_start + 1))-${batch_end}"

        process_files_batch "${batch_files[@]}"

        ((BATCH_COUNT++))
        batch_start=$batch_end

        # Piccola pausa tra batch per non sovraccaricare il sistema
        [[ $BATCH_COUNT -gt 1 ]] && sleep 0.1
    done

    # Verifica finale solo se non è dry-run
    local verify_result=0
    if [[ "$DRY_RUN" != "true" ]]; then
        verify_no_conflicts "$BASE_DIR"
        verify_result=$?
    fi

    # Riepilogo finale
    echo -e "\n${BOLD}${BLUE}============== 📊 RIEPILOGO FINALE V6.1 ==============${NC}"
    echo -e "${BLUE}📁 File totali processati: $TOTAL_FILES${NC}"
    echo -e "${GREEN}✅ File risolti con successo: $RESOLVED_FILES${NC}"
    echo -e "${YELLOW}⚠️  File saltati/senza conflitti: $SKIPPED_FILES${NC}"
    echo -e "${RED}❌ File con errori: $FAILED_FILES${NC}"
    echo -e "${PURPLE}🔧 Conflitti totali risolti: $TOTAL_CONFLICTS${NC}"
    echo -e "${CYAN}📦 Batch elaborati: $BATCH_COUNT${NC}"

    # Salva riepilogo nel log
    {
        echo ""
        echo "============== RIEPILOGO FINALE V6.1 =============="
        echo "File totali processati: $TOTAL_FILES"
        echo "File risolti con successo: $RESOLVED_FILES"
        echo "File saltati/senza conflitti: $SKIPPED_FILES"
        echo "File con errori: $FAILED_FILES"
        echo "Conflitti totali risolti: $TOTAL_CONFLICTS"
        echo "Batch elaborati: $BATCH_COUNT"
        echo "Verifica finale: $([ $verify_result -eq 0 ] && echo "SUCCESSO" || echo "ATTENZIONE")"
        echo "Dry-run: $DRY_RUN"
    } >> "$LOG_FILE"

    if [[ "$DRY_RUN" == "true" ]]; then
        echo -e "${YELLOW}🧪 DRY-RUN completato: nessuna modifica ai file.${NC}"
        echo -e "${CYAN}💡 Per eseguire realmente: DRY_RUN=false $0${NC}"
    elif [[ $verify_result -eq 0 && $RESOLVED_FILES -gt 0 ]]; then
        echo -e "${GREEN}🎉 TUTTI I CONFLITTI SONO STATI RISOLTI CON SUCCESSO!${NC}"
        echo -e "${GREEN}💾 Backup salvati in: ${BACKUP_DIR}${NC}"
        echo -e "${GREEN}📝 Log completo in: ${LOG_FILE}${NC}"
    elif [[ $FAILED_FILES -gt 0 || $verify_result -ne 0 ]]; then
        echo -e "${RED}⚠️  ALCUNI CONFLITTI POTREBBERO NON ESSERE STATI RISOLTI${NC}"
        echo -e "${YELLOW}💡 Controlla il log per dettagli: ${LOG_FILE}${NC}"
        echo -e "${YELLOW}💡 Backup disponibili in: ${BACKUP_DIR}${NC}"
        return 1
    fi

    return 0
}

# Gestione degli errori migliorata
cleanup() {
    echo -e "${YELLOW}🧹 Pulizia file temporanei...${NC}"
    # FIX P0: Cerca file temporanei nella directory corretta (BASE_DIR, non /tmp)
    find "$BASE_DIR" -name "*.tmp.${TIMESTAMP}.$$" -delete 2>/dev/null || true
    log "Cleanup completato"
}

trap 'cleanup; echo -e "${RED}Script interrotto!${NC}"; exit 1' INT TERM
trap 'cleanup' EXIT

# Parsing argomenti esteso
show_help() {
    cat << EOF
🐄 SuperMucca Ultimate Conflict Resolver V6.1

UTILIZZO:
    $0 [OPZIONI]

OPZIONI:
    --dry-run           Simula senza modificare file
    --verbose           Output dettagliato
    --batch-size N      Dimensione batch (default: 50)
    --help              Mostra questo aiuto

VARIABILI AMBIENTE:
    DRY_RUN=true/false  Modalità simulazione
    VERBOSE=true/false  Output verboso
    BATCH_SIZE=N        Dimensione batch

ESEMPI:
    $0                           # Esecuzione normale
    $0 --dry-run                 # Solo simulazione
    $0 --verbose                 # Output dettagliato
    $0 --batch-size 100         # Batch più grandi
    DRY_RUN=true $0             # Simulazione via variabile

NOTA:
    Lo script risolve conflitti Git mantenendo sempre la "current change"
    (la versione locale, non quella da HEAD). Crea backup automatici.
EOF
}

while [[ $# -gt 0 ]]; do
    case $1 in
        --dry-run)
            export DRY_RUN=true
            shift
            ;;
        --verbose)
            export VERBOSE=true
            shift
            ;;
        --batch-size)
            BATCH_SIZE="$2"
            # Valida che sia un numero positivo
            if ! [[ "$BATCH_SIZE" =~ ^[1-9][0-9]*$ ]]; then
                echo "Errore: --batch-size deve essere un numero positivo" >&2
                exit 1
            fi
            shift 2
            ;;
        --help|-h)
            show_help
            exit 0
            ;;
        *)
            echo "Opzione sconosciuta: $1" >&2
            echo "Usa --help per vedere le opzioni disponibili" >&2
            exit 1
            ;;
    esac
done

# Validazione ambiente
if ! command -v awk &> /dev/null; then
    echo -e "${RED}❌ Errore: AWK non trovato${NC}" >&2
    exit 1
fi

if ! command -v find &> /dev/null; then
    echo -e "${RED}❌ Errore: find non trovato${NC}" >&2
    exit 1
fi

# Esegui la funzione principale
main "$@"