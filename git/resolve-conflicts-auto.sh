#!/usr/bin/env bash
# resolve-conflicts-auto.sh
# Script automatico per risolvere conflitti Git usando la libreria git-conflict-resolver
# Versione: 2.0.0
# Data: 2025-10-22
#
# Migliorie rispetto alle versioni precedenti:
# - Usa libreria modulare riutilizzabile
# - Supporto per dry-run
# - Logging strutturato
# - Backup automatici
# - Validazioni robuste
# - Gestione errori migliorata
# - Compatibile con CI/CD

set -euo pipefail

# ============================================================================
# CONFIGURAZIONE
# ============================================================================

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
LIB_DIR="${SCRIPT_DIR}/../lib"

# Importa la libreria di risoluzione conflitti
if [[ -f "${LIB_DIR}/git-conflict-resolver.sh" ]]; then
    # shellcheck source=../lib/git-conflict-resolver.sh
    source "${LIB_DIR}/git-conflict-resolver.sh"
else
    echo "❌ ERRORE: Libreria non trovata: ${LIB_DIR}/git-conflict-resolver.sh" >&2
    exit 1
fi

# Configurazione di default
DEFAULT_STRATEGY="incoming"
DEFAULT_BASE_DIR="$(git rev-parse --show-toplevel 2>/dev/null || pwd)"
DEFAULT_DRY_RUN="false"
DEFAULT_VERBOSE="false"

# ============================================================================
# FUNZIONI
# ============================================================================

show_help() {
    cat << 'EOF'
🔧 Resolve Git Conflicts Auto v2.0.0

DESCRIZIONE:
    Risolve automaticamente i conflitti Git in un repository usando
    strategie configurabili (incoming o current change).

UTILIZZO:
    resolve-conflicts-auto.sh [OPZIONI]

OPZIONI:
    --strategy <incoming|current>
                        Strategia di risoluzione (default: incoming)
                        - incoming: mantiene la versione in arrivo (dopo =======)
                        - current: mantiene la versione corrente (prima di =======)

    --dir <path>        Directory da processare (default: git root)

    --pattern <glob>    Pattern file da includere (default: tutti)
                        Esempi: "*.php", "*.{php,md,sh}"

    --dry-run           Esegui in modalità simulazione (nessuna modifica)

    --verbose           Output dettagliato

    --log-file <path>   Salva log in un file

    --help, -h          Mostra questo help

ESEMPI:
    # Risolvi tutti i conflitti mantenendo incoming change
    ./resolve-conflicts-auto.sh

    # Risolvi solo file PHP mantenendo current change
    ./resolve-conflicts-auto.sh --strategy current --pattern "*.php"

    # Simulazione (dry-run)
    ./resolve-conflicts-auto.sh --dry-run

    # Con log su file
    ./resolve-conflicts-auto.sh --log-file /tmp/conflicts.log --verbose

VARIABILI AMBIENTE:
    GCR_BASE_DIR        Directory di base (sovrascrive --dir)
    GCR_BACKUP_DIR      Directory per backup (default: .git-conflict-backups)
    GCR_LOG_FILE        File di log (sovrascrive --log-file)

NOTE:
    - Crea backup automatici prima di modificare file
    - Salta file binari automaticamente
    - Valida il risultato di ogni operazione
    - Exit code: 0 = successo, 1 = errore, 2 = warning

LIBRERIA:
    Usa la libreria modulare: ../lib/git-conflict-resolver.sh
    Funzioni disponibili: gcr_resolve_file, gcr_resolve_batch, etc.

EOF
}

show_version() {
    echo "resolve-conflicts-auto.sh v2.0.0"
    echo "Libreria: git-conflict-resolver.sh v1.0.0"
}

# ============================================================================
# PARSING ARGOMENTI
# ============================================================================

STRATEGY="$DEFAULT_STRATEGY"
BASE_DIR="$DEFAULT_BASE_DIR"
DRY_RUN="$DEFAULT_DRY_RUN"
VERBOSE="$DEFAULT_VERBOSE"
PATTERN="*"
LOG_FILE=""

while [[ $# -gt 0 ]]; do
    case "$1" in
        --strategy)
            STRATEGY="$2"
            if [[ "$STRATEGY" != "incoming" && "$STRATEGY" != "current" ]]; then
                echo "❌ Strategia non valida: $STRATEGY (usa: incoming o current)" >&2
                exit 1
            fi
            shift 2
            ;;
        --dir)
            BASE_DIR="$2"
            if [[ ! -d "$BASE_DIR" ]]; then
                echo "❌ Directory non trovata: $BASE_DIR" >&2
                exit 1
            fi
            shift 2
            ;;
        --pattern)
            PATTERN="$2"
            shift 2
            ;;
        --dry-run)
            DRY_RUN="true"
            shift
            ;;
        --verbose)
            VERBOSE="true"
            shift
            ;;
        --log-file)
            LOG_FILE="$2"
            shift 2
            ;;
        --version|-v)
            show_version
            exit 0
            ;;
        --help|-h)
            show_help
            exit 0
            ;;
        *)
            echo "❌ Opzione sconosciuta: $1" >&2
            echo "Usa --help per vedere le opzioni disponibili" >&2
            exit 1
            ;;
    esac
done

# ============================================================================
# VALIDAZIONE E SETUP
# ============================================================================

# Setup variabili ambiente per la libreria
export GCR_BASE_DIR="$BASE_DIR"

if [[ -n "$LOG_FILE" ]]; then
    # Crea directory per log file se non esiste
    LOG_DIR=$(dirname "$LOG_FILE")
    mkdir -p "$LOG_DIR" 2>/dev/null || {
        echo "❌ Impossibile creare directory log: $LOG_DIR" >&2
        exit 1
    }
    export GCR_LOG_FILE="$LOG_FILE"
fi

# Verifica che siamo in un repository git (se applicabile)
if [[ ! -d "${BASE_DIR}/.git" ]] && command -v git &>/dev/null; then
    gcr_log "warning" "Directory non sembra essere un repository git: $BASE_DIR"
fi

# ============================================================================
# ESECUZIONE PRINCIPALE
# ============================================================================

main() {
    local start_time
    start_time=$(date +%s)

    gcr_log "info" "========================================="
    gcr_log "info" "  Resolve Git Conflicts Auto v2.0.0"
    gcr_log "info" "========================================="
    gcr_log "info" "Configurazione:"
    gcr_log "info" "  - Strategia: $STRATEGY"
    gcr_log "info" "  - Directory: $BASE_DIR"
    gcr_log "info" "  - Pattern: $PATTERN"
    gcr_log "info" "  - Dry-run: $DRY_RUN"
    gcr_log "info" "  - Verbose: $VERBOSE"
    [[ -n "$LOG_FILE" ]] && gcr_log "info" "  - Log file: $LOG_FILE"
    gcr_log "info" "========================================="

    # Esegui risoluzione batch
    if ! gcr_resolve_batch "$BASE_DIR" "$STRATEGY" "$DRY_RUN"; then
        gcr_log "error" "Errore durante la risoluzione batch"
        return 1
    fi

    local end_time
    end_time=$(date +%s)
    local duration=$((end_time - start_time))

    gcr_log "success" "Operazione completata in ${duration}s"

    if [[ "$DRY_RUN" == "true" ]]; then
        gcr_log "info" "Modalità DRY-RUN: nessuna modifica applicata"
        gcr_log "info" "Esegui senza --dry-run per applicare le modifiche"
    else
        gcr_log "success" "Backup salvati in: ${GCR_BACKUP_DIR}"
        [[ -n "$LOG_FILE" ]] && gcr_log "success" "Log salvato in: $LOG_FILE"
    fi

    return 0
}

# ============================================================================
# GESTIONE ERRORI E CLEANUP
# ============================================================================

cleanup() {
    # Cleanup file temporanei
    find /tmp -name "*.tmp.$$" -delete 2>/dev/null || true
}

trap cleanup EXIT
trap 'gcr_log "error" "Script interrotto!"; exit 130' INT TERM

# Esegui main
if ! main; then
    gcr_log "error" "Script terminato con errori"
    exit 1
fi

exit 0
