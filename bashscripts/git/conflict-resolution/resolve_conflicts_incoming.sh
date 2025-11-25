#!/bin/bash
# ==============================================================================
# Script per Risoluzione Automatica Conflitti Git (INCOMING CHANGE)
# ==============================================================================
# Risolve automaticamente tutti i conflitti Git scegliendo sempre la versione
# "incoming" (la nuova versione in arrivo dal merge/rebase)
#
# Uso: ./resolve_conflicts_incoming.sh [OPTIONS]
#
# Opzioni:
#   --dry-run         Simula senza modificare file
#   --backup-dir DIR  Directory per backup (default: auto)
#   --exclude PATTERN Esclude pattern (es: "*.svg,*.txt")
#   --help            Mostra questo aiuto
#
# Autore: AI Assistant + Laraxot Team
# Versione: 5.0
# ==============================================================================

set -euo pipefail
IFS=$'\n\t'

# ==============================================================================
# CONFIGURAZIONE
# ==============================================================================

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/.." && pwd)"
LIB_DIR="$SCRIPT_DIR/lib"

# Carica libreria
if [ ! -f "$LIB_DIR/git_conflict_resolver.sh" ]; then
    echo "❌ ERRORE: Libreria non trovata in $LIB_DIR/git_conflict_resolver.sh"
    exit 1
fi

source "$LIB_DIR/git_conflict_resolver.sh"

# Configurazione default
DRY_RUN=false
BACKUP_DIR="${SCRIPT_DIR}/backups/conflicts_$(date +%Y%m%d_%H%M%S)"
EXCLUDE_PATTERNS=""
TARGET_DIR="$PROJECT_ROOT"
STRATEGY="incoming"
INCLUDE_EXTENSIONS=""

# ==============================================================================
# PARSING ARGOMENTI
# ==============================================================================

show_help() {
    cat << EOF
$(gcr_version)

Uso: $0 [OPZIONI]

Risolve automaticamente tutti i conflitti Git nel progetto scegliendo sempre
la versione "incoming" (nuova versione in arrivo).

OPZIONI:
    --dry-run              Simula senza modificare file
    --backup-dir DIR       Directory per backup (default: auto-generated)
    --exclude PATTERN      Esclude pattern (comma-separated, es: "*.svg,*.txt")
    --target DIR           Directory target (default: project root)
    --strategy STRATEGY    Strategia: incoming|head|both|remove_markers (default: incoming)
    --extensions LIST      Limita l'azione alle estensioni (es: "md,old")
    --help                 Mostra questo aiuto

ESEMPI:
    # Dry-run per vedere cosa succederebbe
    $0 --dry-run

    # Risolvi escludendo file svg e txt
    $0 --exclude "*.svg,*.txt"

    # Risolvi solo directory laravel/
    $0 --target "$PROJECT_ROOT/laravel"

    # Usa strategia "both" (mantiene entrambe le versioni)
    $0 --strategy both

STRATEGIE DISPONIBILI:
    incoming        Prende la versione nuova (dopo =======)
    head            Prende la versione attuale (prima di =======)
    both            Mantiene entrambe le versioni
    remove_markers  Rimuove solo i marker (mantiene tutto il contenuto)

EOF
}

# Parse arguments
while [[ $# -gt 0 ]]; do
    case "$1" in
        --dry-run)
            DRY_RUN=true
            shift
            ;;
        --backup-dir)
            BACKUP_DIR="$2"
            shift 2
            ;;
        --exclude)
            EXCLUDE_PATTERNS="$2"
            shift 2
            ;;
        --target)
            TARGET_DIR="$2"
            shift 2
            ;;
        --strategy)
            STRATEGY="$2"
            shift 2
            ;;
        --extensions)
            INCLUDE_EXTENSIONS="$2"
            shift 2
            ;;
        --help|-h)
            show_help
            exit 0
            ;;
        *)
            echo "❌ Opzione sconosciuta: $1"
            show_help
            exit 1
            ;;
    esac
done

# ==============================================================================
# BANNER E INFORMAZIONI
# ==============================================================================

clear || true
gcr_log "$GCR_BOLD$GCR_BLUE" "╔══════════════════════════════════════════════════════════════╗"
gcr_log "$GCR_BOLD$GCR_BLUE" "║    🚀 GIT CONFLICT RESOLVER - RISOLUZIONE AUTOMATICA        ║"
gcr_log "$GCR_BOLD$GCR_BLUE" "╚══════════════════════════════════════════════════════════════╝"
echo ""
gcr_log "$GCR_CYAN" "📁 Directory target:  $TARGET_DIR"
gcr_log "$GCR_CYAN" "🎯 Strategia:         $STRATEGY"
gcr_log "$GCR_CYAN" "💾 Directory backup:  $BACKUP_DIR"
gcr_log "$GCR_CYAN" "🧪 Dry-run:           $DRY_RUN"
[ -n "$EXCLUDE_PATTERNS" ] && gcr_log "$GCR_CYAN" "🚫 Esclusi:           $EXCLUDE_PATTERNS"
[ -n "$INCLUDE_EXTENSIONS" ] && gcr_log "$GCR_CYAN" "📄 Solo estensioni:   $INCLUDE_EXTENSIONS"
echo ""
gcr_log "$GCR_BOLD$GCR_YELLOW" "⚠️  Limitazioni:"
gcr_log "$GCR_YELLOW" "   • agisce solo su file di testo; per .svg/.png/.bin usare strumenti manuali"
gcr_log "$GCR_YELLOW" "   • se il file era già invalido (es. doc duplicato), rileggi il risultato prima di committare"
gcr_log "$GCR_YELLOW" "   • per documentazione (Markdown), preferisci sempre una revisione finale dopo la bonifica"
echo ""

# ==============================================================================
# VALIDAZIONE
# ==============================================================================

if [ ! -d "$TARGET_DIR" ]; then
    gcr_log "$GCR_RED" "❌ Directory target non esiste: $TARGET_DIR"
    exit 1
fi

# ==============================================================================
# ESECUZIONE
# ==============================================================================

LOG_FILE="${SCRIPT_DIR}/logs/resolve_conflicts_$(date +%Y%m%d_%H%M%S).log"
mkdir -p "$(dirname "$LOG_FILE")"

{
    echo "=== Git Conflict Resolution Log ==="
    echo "Date: $(date '+%Y-%m-%d %H:%M:%S')"
    echo "Target: $TARGET_DIR"
    echo "Strategy: $STRATEGY"
    echo "Dry-run: $DRY_RUN"
    echo ""
} > "$LOG_FILE"

# Trova e risolvi conflitti
gcr_log "$GCR_YELLOW" "🔍 Ricerca conflitti in corso..."
echo ""

# Usa la funzione batch della libreria
resolved=$(gcr_resolve_directory "$TARGET_DIR" "$STRATEGY" "$BACKUP_DIR" "$DRY_RUN" "$EXCLUDE_PATTERNS" "$INCLUDE_EXTENSIONS")

# ==============================================================================
# VERIFICA POST-RISOLUZIONE
# ==============================================================================

echo ""
gcr_log "$GCR_YELLOW" "🔍 Verifica conflitti rimanenti..."

remaining=$(find "$TARGET_DIR" -type f \
    ! -path "*/.git/*" \
    ! -path "*/node_modules/*" \
    ! -path "*/vendor/*" \
    -exec grep -l "^<<<<<<< HEAD" {} + 2>/dev/null | wc -l)

echo ""
gcr_log "$GCR_BOLD$GCR_BLUE" "╔══════════════════════════════════════════════════════════════╗"
gcr_log "$GCR_BOLD$GCR_BLUE" "║                    RISULTATO FINALE                          ║"
gcr_log "$GCR_BOLD$GCR_BLUE" "╚══════════════════════════════════════════════════════════════╝"
echo ""

if [ "$remaining" -eq 0 ]; then
    gcr_log "$GCR_BOLD$GCR_GREEN" "🎉 SUCCESSO! Tutti i conflitti sono stati risolti!"
    gcr_log "$GCR_GREEN" "✅ File risolti: $resolved"
    gcr_log "$GCR_GREEN" "✅ Conflitti rimanenti: $remaining"
else
    gcr_log "$GCR_YELLOW" "⚠️  Ci sono ancora $remaining file con conflitti"
    gcr_log "$GCR_YELLOW" "💡 Potrebbero essere file binari o con conflitti complessi"
    gcr_log "$GCR_YELLOW" "📝 Controlla il log: $LOG_FILE"
fi

echo ""
gcr_log "$GCR_CYAN" "📝 Log completo:      $LOG_FILE"
[ "$DRY_RUN" = false ] && gcr_log "$GCR_CYAN" "💾 Backup salvati in: $BACKUP_DIR"
echo ""

# ==============================================================================
# CONSIGLI POST-RISOLUZIONE
# ==============================================================================

if [ "$DRY_RUN" = false ] && [ "$resolved" -gt 0 ]; then
    gcr_log "$GCR_BOLD$GCR_PURPLE" "🔔 PROSSIMI PASSI CONSIGLIATI:"
    echo ""
    gcr_log "$GCR_PURPLE" "1️⃣  Verifica le modifiche:"
    gcr_log "$GCR_CYAN" "   git status"
    gcr_log "$GCR_CYAN" "   git diff"
    echo ""
    gcr_log "$GCR_PURPLE" "2️⃣  Testa l'applicazione:"
    gcr_log "$GCR_CYAN" "   php artisan optimize:clear"
    gcr_log "$GCR_CYAN" "   php artisan serve"
    echo ""
    gcr_log "$GCR_PURPLE" "3️⃣  Esegui i test:"
    gcr_log "$GCR_CYAN" "   php artisan test"
    gcr_log "$GCR_CYAN" "   vendor/bin/phpstan analyse --level=max"
    echo ""
    gcr_log "$GCR_PURPLE" "4️⃣  Committa le modifiche:"
    gcr_log "$GCR_CYAN" "   git add ."
    gcr_log "$GCR_CYAN" "   git commit -m \"fix: resolve all git conflicts (incoming)\""
    echo ""
fi

exit 0




