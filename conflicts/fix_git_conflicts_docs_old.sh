#!/bin/bash

# Script specializzato per risolvere conflitti Git in file .md e .old
# Autore: AI Assistant migliorato
# Data: $(date +%Y-%m-%d)
# Versione: 1.0 - Documentation & Old Files Edition
# 
# Questo script risolve i conflitti Git in:
# - File .md (documentazione) - scegliendo la versione più completa
# - File .old (backup temporanei) - rimuovendoli dopo backup
# 
# MIGLIORAMENTI:
# - Gestione specifica per file markdown
# - Rimozione sicura dei file .old
# - Validazione base markdown
# - Backup automatico
# - Logging dettagliato
# - Opzione --dry-run per testare senza modificare

set -euo pipefail
IFS=$'\n\t'

# Colori per output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[0;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
CYAN='\033[0;36m'
BOLD='\033[1m'
NC='\033[0m' # No Color

# Directory di base - aggiornata per il progetto corrente
BASE_DIR="/var/www/_bases/base_quaeris_fila4_mono/laravel"
SCRIPT_DIR="/var/www/_bases/base_quaeris_fila4_mono/bashscripts"

# Opzioni
DRY_RUN=false
VERBOSE=false
DELETE_OLD_FILES=true
MARKDOWN_VALIDATION=true

# Parse arguments
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
        --keep-old)
            DELETE_OLD_FILES=false
            shift
            ;;
        --no-markdown-check)
            MARKDOWN_VALIDATION=false
            shift
            ;;
        --help|-h)
            echo "Uso: $0 [opzioni]"
            echo "Opzioni:"
            echo "  --dry-run          Testa senza modificare i file"
            echo "  --verbose          Output dettagliato"
            echo "  --keep-old         Mantiene i file .old invece di eliminarli"
            echo "  --no-markdown-check Disabilita la validazione markdown"
            echo "  --help, -h         Mostra questo aiuto"
            exit 0
            ;;
        *)
            echo "Opzione sconosciuta: $1"
            echo "Usa --help per vedere le opzioni disponibili"
            exit 1
            ;;
    esac
done

# Log file con timestamp
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
LOG_FILE="${SCRIPT_DIR}/logs/fix_docs_old_conflicts_${TIMESTAMP}.log"
BACKUP_DIR="${SCRIPT_DIR}/backups/docs_old_conflicts_${TIMESTAMP}"

# Crea directory se non esistono
mkdir -p "${SCRIPT_DIR}/logs"
mkdir -p "${BACKUP_DIR}"

# Funzione per output dettagliato
verbose() {
    if [ "$VERBOSE" = true ]; then
        echo -e "$@"
    fi
}

# Funzione per log con timestamp
log_with_timestamp() {
    local message="$1"
    local timestamp=$(date '+%Y-%m-%d %H:%M:%S')
    echo "[$timestamp] $message" >> "$LOG_FILE"
}

echo -e "${BOLD}${BLUE}=== 📚 SCRIPT DOCS & OLD - RISOLUZIONE CONFLITTI GIT ===${NC}"
echo -e "${BOLD}${BLUE}=== Specializzato per .md e .old files ===${NC}"
echo -e "${BOLD}${BLUE}=== $(date) ===${NC}"
echo -e "${YELLOW}📁 Directory di lavoro: ${BASE_DIR}${NC}"
echo -e "${YELLOW}📝 Log salvato in: ${LOG_FILE}${NC}"
echo -e "${YELLOW}💾 Backup salvati in: ${BACKUP_DIR}${NC}"
echo -e "${YELLOW}🧪 Dry-run: ${DRY_RUN}${NC}"
echo -e "${YELLOW}📢 Verbose: ${VERBOSE}${NC}"
echo -e "${YELLOW}🗑️  Delete .old files: ${DELETE_OLD_FILES}${NC}"
echo -e "${YELLOW}📋 Markdown validation: ${MARKDOWN_VALIDATION}${NC}\n"

# Inizializza il log
{
    echo "=== SCRIPT DOCS & OLD - RISOLUZIONE CONFLITTI GIT ==="
    echo "=== $(date) ==="
    echo "=== Specializzato per .md e .old files ==="
    echo "=== Directory: ${BASE_DIR} ==="
    echo "=== Versione: 1.0 - Documentation & Old Files Edition ==="
    echo "=== Dry-run: ${DRY_RUN} ==="
    echo "=== Delete .old files: ${DELETE_OLD_FILES} ==="
    echo "=== Markdown validation: ${MARKDOWN_VALIDATION} ==="
    echo ""
} > "$LOG_FILE"

# Contatori globali
TOTAL_FILES=0
RESOLVED_FILES=0
FAILED_FILES=0
DELETED_OLD_FILES=0
TOTAL_CONFLICTS=0
MARKDOWN_ERRORS=0

# Funzione per validazione base markdown
check_markdown_syntax() {
    local file="$1"
    
    if [[ "$MARKDOWN_VALIDATION" = false ]]; then
        return 0
    fi
    
    # Verifica base: il file non deve essere vuoto e deve avere contenuti validi
    if [[ ! -s "$file" ]]; then
        verbose "${RED}❌ File markdown vuoto: $file${NC}"
        log_with_timestamp "MARKDOWN_ERROR: File vuoto - $file"
        ((MARKDOWN_ERRORS++))
        return 1
    fi
    
    # Verifica che non ci siano marker conflitto residui
    if grep -q "^<<<<<<< " "$file" 2>/dev/null || grep -q "^>>>>>>> " "$file" 2>/dev/null; then
        verbose "${RED}❌ Marker conflitto residui in: $file${NC}"
        log_with_timestamp "MARKDOWN_ERROR: Marker residui - $file"
        ((MARKDOWN_ERRORS++))
        return 1
    fi
    
    verbose "${GREEN}✅ Validazione markdown OK: $file${NC}"
    log_with_timestamp "MARKDOWN_OK: $file"
    return 0
}

# Funzione per risolvere conflitti in file .md
resolve_md_conflicts() {
    local file="$1"
    local temp_file="${file}.tmp.${TIMESTAMP}"
    local conflict_count=0
    
    log_with_timestamp "Elaborazione file MD: $file"
    verbose "${CYAN}📄 Analisi file MD: $file${NC}"
    
    # Verifica se ci sono conflitti nel file
    if ! grep -q "^<<<<<<< " "$file" 2>/dev/null; then
        verbose "${YELLOW}⚠️  Nessun conflitto trovato in: $file${NC}"
        log_with_timestamp "NO_CONFLICTS: $file"
        return 2
    fi
    
    # Crea backup del file originale
    if [ "$DRY_RUN" = false ]; then
        local backup_file="${BACKUP_DIR}/$(basename "$file").backup.${TIMESTAMP}"
        cp "$file" "$backup_file"
        log_with_timestamp "Backup creato: $backup_file"
        verbose "${BLUE}💾 Backup creato: $backup_file${NC}"
    fi
    
    # Usa awk per processare il file e risolvere i conflitti
    # Per i file .md, scegliamo la versione più completa (solitamente quella dopo =======)
    awk '
    BEGIN {
        in_conflict = 0
        keep_current = 0
        conflict_count = 0
        head_content = ""
        current_content = ""
    }
    
    # Rileva inizio conflitto (<<<<<<< HEAD)
    /^<<<<<<< / {
        in_conflict = 1
        keep_current = 0
        conflict_count++
        next
    }
    
    # Rileva separatore (=======)
    /^=======/ {
        if (in_conflict) {
            keep_current = 1
        }
        next
    }
    
    # Rileva fine conflitto (>>>>>>> commit_hash)
    /^>>>>>>> / {
        if (in_conflict) {
            in_conflict = 0
            keep_current = 0
        }
        next
    }
    
    # Gestisci il contenuto
    {
        if (!in_conflict) {
            print $0
        } else if (keep_current) {
            current_content = current_content $0 "\n"
        } else {
            head_content = head_content $0 "\n"
        }
    }
    
    END {
        if (conflict_count > 0) {
            # Per markdown, preferiamo la versione più lunga/completa
            if (length(current_content) > length(head_content)) {
                printf "%s", current_content
            } else {
                printf "%s", head_content
            }
            print "CONFLICTS_RESOLVED:" conflict_count > "/dev/stderr"
        }
    }
    ' "$file" > "$temp_file" 2> "${temp_file}.stats"
    
    # Leggi le statistiche
    local stats_line
    if [ -f "${temp_file}.stats" ]; then
        stats_line=$(grep "CONFLICTS_RESOLVED:" "${temp_file}.stats" || true)
        rm -f "${temp_file}.stats"
        
        if [ -n "$stats_line" ]; then
            conflict_count=$(echo "$stats_line" | cut -d: -f2)
            verbose "${CYAN}📊 Conflitti risolti: $conflict_count${NC}"
        fi
    fi
    
    # Se abbiamo risolto conflitti
    if [ "$conflict_count" -gt 0 ]; then
        if [ "$DRY_RUN" = true ]; then
            echo -e "${CYAN}🔍 DRY-RUN: $file (conflitti: $conflict_count)${NC}"
            log_with_timestamp "DRY_RUN: $file (conflitti: $conflict_count)"
            rm -f "$temp_file"
            return 0
        else
            # Verifica validazione markdown
            if check_markdown_syntax "$temp_file"; then
                if mv "$temp_file" "$file"; then
                    echo -e "${GREEN}✅ Risolti $conflict_count conflitti in: $file${NC}"
                    log_with_timestamp "SUCCESSO: Risolti $conflict_count conflitti in $file"
                    TOTAL_CONFLICTS=$((TOTAL_CONFLICTS + conflict_count))
                    return 0
                else
                    echo -e "${RED}❌ Errore durante la sostituzione di: $file${NC}"
                    log_with_timestamp "ERRORE: Impossibile sostituire $file"
                    rm -f "$temp_file"
                    return 1
                fi
            else
                echo -e "${RED}❌ Errore validazione markdown dopo risoluzione in: $file${NC}"
                log_with_timestamp "ERRORE_VALIDAZIONE_MD: $file"
                rm -f "$temp_file"
                return 1
            fi
        fi
    else
        # Nessun conflitto trovato
        rm -f "$temp_file"
        return 2
    fi
}

# Funzione per gestire file .old
handle_old_files() {
    local file="$1"
    
    log_with_timestamp "Gestione file OLD: $file"
    verbose "${ORANGE}🗂️  Analisi file OLD: $file${NC}"
    
    if [ "$DRY_RUN" = true ]; then
        echo -e "${CYAN}🔍 DRY-RUN: $file (verrebbe eliminato)${NC}"
        log_with_timestamp "DRY_RUN: $file (verrebbe eliminato)"
        return 0
    fi
    
    # Crea backup prima di eliminare
    local backup_file="${BACKUP_DIR}/$(basename "$file").backup.${TIMESTAMP}"
    cp "$file" "$backup_file"
    log_with_timestamp "Backup creato prima eliminazione: $backup_file"
    
    if [ "$DELETE_OLD_FILES" = true ]; then
        if rm "$file"; then
            echo -e "${ORANGE}🗑️  File .old eliminato: $file${NC}"
            log_with_timestamp "SUCCESSO: File .old eliminato $file"
            ((DELETED_OLD_FILES++))
            return 0
        else
            echo -e "${RED}❌ Errore eliminazione file .old: $file${NC}"
            log_with_timestamp "ERRORE: Impossibile eliminare $file"
            return 1
        fi
    else
        echo -e "${YELLOW}⚠️  File .old mantenuto: $file${NC}"
        log_with_timestamp "INFO: File .old mantenuto $file"
        return 0
    fi
}

# Funzione principale per trovare e processare tutti i file
find_and_process_all_files() {
    local search_dir="$1"
    
    echo -e "${BLUE}🔍 Ricerca file .md e .old con conflitti in: $search_dir${NC}"
    log_with_timestamp "Inizio ricerca conflitti in: $search_dir"
    
    # Trova tutti i file .md con conflitti
    local md_files=()
    while IFS= read -r -d '' file; do
        if grep -q "^<<<<<<< " "$file" 2>/dev/null; then
            md_files+=("$file")
        fi
    done < <(find "$search_dir" -type f -name "*.md" ! -path "*/.git/*" ! -path "*/vendor/*" ! -path "*/node_modules/*" -print0 2>/dev/null)
    
    # Trova tutti i file .old
    local old_files=()
    while IFS= read -r -d '' file; do
        old_files+=("$file")
    done < <(find "$search_dir" -type f -name "*.old" ! -path "*/.git/*" ! -path "*/vendor/*" ! -path "*/node_modules/*" -print0 2>/dev/null)
    
    TOTAL_FILES=$((${#md_files[@]} + ${#old_files[@]}))
    
    if [ "$TOTAL_FILES" -eq 0 ]; then
        echo -e "${GREEN}🎉 Nessun file .md/.old con conflitti trovato!${NC}"
        log_with_timestamp "INFO: Nessun file .md/.old con conflitti trovato"
        return 0
    fi
    
    echo -e "${CYAN}📋 Trovati ${#md_files[@]} file .md e ${#old_files[@]} file .old${NC}"
    log_with_timestamp "Trovati ${#md_files[@]} file .md e ${#old_files[@]} file .old"
    
    # Processa file .md
    local file_count=0
    for file in "${md_files[@]}"; do
        ((file_count++))
        echo -e "${YELLOW}[$file_count/$TOTAL_FILES] 📄 Elaborazione MD: $file${NC}"
        
        case $(resolve_md_conflicts "$file") in
            0)
                ((RESOLVED_FILES++))
                ;;
            1)
                ((FAILED_FILES++))
                ;;
            2)
                ((file_count--)) # Non era un conflitto, non contare
                ;;
        esac
    done
    
    # Processa file .old
    for file in "${old_files[@]}"; do
        ((file_count++))
        echo -e "${YELLOW}[$file_count/$TOTAL_FILES] 🗂️  Gestione OLD: $file${NC}"
        
        if handle_old_files "$file"; then
            ((RESOLVED_FILES++))
        else
            ((FAILED_FILES++))
        fi
    done
}

# Funzione principale
main() {
    echo -e "${BOLD}${PURPLE}🚀 Avvio risoluzione conflitti Git per .md e .old files...${NC}"
    
    # Trova e risolvi tutti i conflitti
    find_and_process_all_files "$BASE_DIR"
    
    # Riepilogo finale
    echo -e "\n${BOLD}${BLUE}=== 📊 RIEPILOGO FINALE ===${NC}"
    echo -e "${BLUE}📁 File totali processati: $TOTAL_FILES${NC}"
    echo -e "${GREEN}✅ File risolti con successo: $RESOLVED_FILES${NC}"
    echo -e "${RED}❌ File con errori: $FAILED_FILES${NC}"
    echo -e "${PURPLE}🔧 Conflitti totali risolti: $TOTAL_CONFLICTS${NC}"
    echo -e "${ORANGE}🗑️  File .old eliminati: $DELETED_OLD_FILES${NC}"
    if [ "$MARKDOWN_VALIDATION" = true ]; then
        echo -e "${ORANGE}📋 Errori validazione markdown: $MARKDOWN_ERRORS${NC}"
    fi
    
    # Salva riepilogo nel log
    {
        echo ""
        echo "=== RIEPILOGO FINALE ==="
        echo "File totali processati: $TOTAL_FILES"
        echo "File risolti con successo: $RESOLVED_FILES"
        echo "File con errori: $FAILED_FILES"
        echo "Conflitti totali risolti: $TOTAL_CONFLICTS"
        echo "File .old eliminati: $DELETED_OLD_FILES"
        echo "Errori validazione markdown: $MARKDOWN_ERRORS"
        echo "Dry-run: $DRY_RUN"
    } >> "$LOG_FILE"
    
    if [ "$DRY_RUN" = true ]; then
        echo -e "${YELLOW}🧪 DRY-RUN COMPLETATO: nessuna modifica ai file${NC}"
        echo -e "${YELLOW}💾 I backup non sono stati creati in modalità dry-run${NC}"
        return 0
    elif [ "$FAILED_FILES" -eq 0 ] && [ "$MARKDOWN_ERRORS" -eq 0 ]; then
        echo -e "${GREEN}🎉 TUTTI I CONFLITTI .md/.old SONO STATI RISOLTI CON SUCCESSO!${NC}"
        echo -e "${GREEN}💾 Backup salvati in: ${BACKUP_DIR}${NC}"
        echo -e "${GREEN}📝 Log completo in: ${LOG_FILE}${NC}"
        return 0
    else
        echo -e "${RED}⚠️  ALCUNI PROBLEMI RIMANGONO${NC}"
        echo -e "${YELLOW}💡 Controlla il log per i dettagli${NC}"
        return 1
    fi
}

# Esegui la funzione principale
main "$@"
