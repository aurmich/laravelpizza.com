#!/bin/bash

# Script finale per risolvere conflitti Git in file .md e .old
# Versione: 4.0 - Hybrid Resolution Strategy
# Gestisce tutti i pattern di conflitto inclusi quelli incompleti

set -euo pipefail
IFS=$'\n\t'

# Colori per output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[0;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
CYAN='\033[0;36m'
ORANGE='\033[0;33m'
BOLD='\033[1m'
NC='\033[0m'

# Directory di base
BASE_DIR="/var/www/_bases/base_quaeris_fila4_mono/laravel"
SCRIPT_DIR="/var/www/_bases/base_quaeris_fila4_mono/bashscripts"

# Opzioni
DRY_RUN=false
VERBOSE=false
DELETE_OLD_FILES=true
BATCH_SIZE=15

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
        --batch-size)
            BATCH_SIZE="$2"
            shift 2
            ;;
        --help|-h)
            echo "Uso: $0 [opzioni]"
            echo "Opzioni:"
            echo "  --dry-run          Testa senza modificare i file"
            echo "  --verbose          Output dettagliato"
            echo "  --keep-old         Mantiene i file .old invece di eliminarli"
            echo "  --batch-size N     Processa N file alla volta (default: 15)"
            echo "  --help, -h         Mostra questo aiuto"
            exit 0
            ;;
        *)
            echo "Opzione sconosciuta: $1"
            exit 1
            ;;
    esac
done

# Log file con timestamp
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
LOG_FILE="${SCRIPT_DIR}/logs/fix_docs_old_final_${TIMESTAMP}.log"
BACKUP_DIR="${SCRIPT_DIR}/backups/docs_old_final_${TIMESTAMP}"

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

echo -e "${BOLD}${BLUE}=== 📚 SCRIPT DOCS & OLD FINAL - RISOLUZIONE CONFLITTI GIT ===${NC}"
echo -e "${BOLD}${BLUE}=== Versione Finale con strategia ibrida ===${NC}"
echo -e "${BOLD}${BLUE}=== $(date) ===${NC}"
echo -e "${YELLOW}📁 Directory di lavoro: ${BASE_DIR}${NC}"
echo -e "${YELLOW}📝 Log salvato in: ${LOG_FILE}${NC}"
echo -e "${YELLOW}💾 Backup salvati in: ${BACKUP_DIR}${NC}"
echo -e "${YELLOW}🧪 Dry-run: ${DRY_RUN}${NC}"
echo -e "${YELLOW}📢 Verbose: ${VERBOSE}${NC}"
echo -e "${YELLOW}🗑️  Delete .old files: ${DELETE_OLD_FILES}${NC}"
echo -e "${YELLOW}📦 Batch size: ${BATCH_SIZE}${NC}\n"

# Inizializza il log
{
    echo "=== SCRIPT DOCS & OLD FINAL - RISOLUZIONE CONFLITTI GIT ==="
    echo "=== $(date) ==="
    echo "=== Versione Finale con strategia ibrida ==="
    echo "=== Directory: ${BASE_DIR} ==="
    echo "=== Batch size: ${BATCH_SIZE} ==="
    echo "=== Dry-run: ${DRY_RUN} ==="
    echo "=== Delete .old files: ${DELETE_OLD_FILES} ==="
    echo ""
} > "$LOG_FILE"

# Contatori globali
TOTAL_FILES=0
RESOLVED_FILES=0
FAILED_FILES=0
DELETED_OLD_FILES=0
TOTAL_CONFLICTS=0

# Funzione finale ibrida per risolvere conflitti in file .md
resolve_md_conflicts_hybrid() {
    local file="$1"
    
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
    
    if [ "$DRY_RUN" = true ]; then
        echo -e "${CYAN}🔍 DRY-RUN: $file${NC}"
        log_with_timestamp "DRY_RUN: $file"
        return 0
    fi
    
    # Conta i conflitti prima della risoluzione
    local conflict_count
    conflict_count=$(grep -c "^<<<<<<< " "$file" 2>/dev/null || echo "0")
    
    # Strategia ibrida: prima prova awk, se fallisce usa sed fallback
    local temp_file="${file}.tmp.${TIMESTAMP}"
    local resolution_success=false
    
    # Metodo 1: AWK intelligente che sceglie il contenuto migliore
    awk '
    BEGIN {
        in_conflict = 0
        conflict_count = 0
        head_content = ""
        current_content = ""
        has_current = false
    }
    
    # Rileva inizio conflitto
    /^<<<<<<< / {
        in_conflict = 1
        conflict_count++
        head_content = ""
        current_content = ""
        has_current = false
        next
    }
    
    # Rileva separatore
    /^=======/ {
        if (in_conflict) {
            has_current = true
        }
        next
    }
    
    # Rileva fine conflitto
    /^>>>>>>> / {
        if (in_conflict) {
            in_conflict = 0
            # Scegli il contenuto migliore
            if (length(current_content) > length(head_content)) {
                printf "%s", current_content
            } else if (length(head_content) > 0) {
                printf "%s", head_content
            }
            head_content = ""
            current_content = ""
        }
        next
    }
    
    # Raccogli il contenuto
    {
        if (!in_conflict) {
            print $0
        } else if (has_current) {
            current_content = current_content $0 "\n"
        } else {
            head_content = head_content $0 "\n"
        }
    }
    
    END {
        print "CONFLICTS_PROCESSED:" conflict_count > "/dev/stderr"
    }
    ' "$file" > "$temp_file" 2> "${temp_file}.stats"
    
    # Verifica se il risultato awk è valido
    if [[ -s "$temp_file" ]] && ! grep -q "^<<<<<<< " "$temp_file" 2>/dev/null && ! grep -q "^>>>>>>> " "$temp_file" 2>/dev/null; then
        resolution_success=true
        verbose "${GREEN}✅ Risoluzione AWK riuscita per: $file${NC}"
    else
        verbose "${YELLOW}⚠️  AWK fallito, provo sed fallback per: $file${NC}"
        rm -f "$temp_file"
        
        # Metodo 2: Sed fallback - rimuovi marcatori e mantieni HEAD
        sed -e '/^<<<<<<< /,/^=======/d' -e '/^>>>>>>> /d' "$file" > "$temp_file"
        
        if [[ -s "$temp_file" ]] && ! grep -q "^<<<<<<< " "$temp_file" 2>/dev/null && ! grep -q "^>>>>>>> " "$temp_file" 2>/dev/null; then
            resolution_success=true
            verbose "${GREEN}✅ Risoluzione Sed fallback riuscita per: $file${NC}"
        else
            verbose "${RED}❌ Anche sed fallback fallito per: $file${NC}"
            rm -f "$temp_file"
        fi
    fi
    
    # Leggi le statistiche se disponibili
    local processed_conflicts="$conflict_count"
    if [ -f "${temp_file}.stats" ]; then
        local stats_line
        stats_line=$(grep "CONFLICTS_PROCESSED:" "${temp_file}.stats" || true)
        rm -f "${temp_file}.stats"
        
        if [ -n "$stats_line" ]; then
            processed_conflicts=$(echo "$stats_line" | cut -d: -f2)
        fi
    fi
    
    # Verifica finale e sposta il file
    if [ "$resolution_success" = true ]; then
        if mv "$temp_file" "$file"; then
            echo -e "${GREEN}✅ Risolti $processed_conflicts conflitti in: $file${NC}"
            log_with_timestamp "SUCCESSO: Risolti $processed_conflicts conflitti in $file"
            TOTAL_CONFLICTS=$((TOTAL_CONFLICTS + processed_conflicts))
            return 0
        else
            echo -e "${RED}❌ Errore durante la sostituzione di: $file${NC}"
            log_with_timestamp "ERRORE: Impossibile sostituire $file"
            rm -f "$temp_file"
            return 1
        fi
    else
        echo -e "${RED}❌ Tutti i metodi di risoluzione falliti per: $file${NC}"
        log_with_timestamp "ERRORE_COMPLETO: $file - nessun metodo ha funzionato"
        return 1
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

# Funzione per processare file in batch
process_batch() {
    local files=("$@")
    local batch_size=${#files[@]}
    
    for ((i=0; i<batch_size; i++)); do
        local file="${files[$i]}"
        
        if [[ "$file" == *.md ]]; then
            case $(resolve_md_conflicts_hybrid "$file") in
                0)
                    ((RESOLVED_FILES++))
                    ;;
                1)
                    ((FAILED_FILES++))
                    ;;
                2)
                    # Nessun conflitto, non contare
                    ;;
            esac
        elif [[ "$file" == *.old ]]; then
            if handle_old_files "$file"; then
                ((RESOLVED_FILES++))
            else
                ((FAILED_FILES++))
            fi
        fi
        
        # Mostra progress
        local progress=$((i + 1))
        echo -e "${YELLOW}[$progress/$batch_size] Processato: $(basename "$file")${NC}"
    done
}

# Funzione principale
main() {
    echo -e "${BOLD}${PURPLE}🚀 Avvio risoluzione conflitti Git per .md e .old files (FINAL)...${NC}"
    
    # Trova tutti i file .md con conflitti
    echo -e "${BLUE}🔍 Ricerca file .md con conflitti...${NC}"
    local md_files=()
    while IFS= read -r -d '' file; do
        if grep -q "^<<<<<<< " "$file" 2>/dev/null; then
            md_files+=("$file")
        fi
    done < <(find "$BASE_DIR" -type f -name "*.md" ! -path "*/.git/*" ! -path "*/vendor/*" ! -path "*/node_modules/*" -print0 2>/dev/null)
    
    # Trova tutti i file .old
    echo -e "${BLUE}🔍 Ricerca file .old...${NC}"
    local old_files=()
    while IFS= read -r -d '' file; do
        old_files+=("$file")
    done < <(find "$BASE_DIR" -type f -name "*.old" ! -path "*/.git/*" ! -path "*/vendor/*" ! -path "*/node_modules/*" -print0 2>/dev/null)
    
    TOTAL_FILES=$((${#md_files[@]} + ${#old_files[@]}))
    
    if [ "$TOTAL_FILES" -eq 0 ]; then
        echo -e "${GREEN}🎉 Nessun file .md/.old con conflitti trovato!${NC}"
        log_with_timestamp "INFO: Nessun file .md/.old con conflitti trovato"
        return 0
    fi
    
    echo -e "${CYAN}📋 Trovati ${#md_files[@]} file .md e ${#old_files[@]} file .old${NC}"
    log_with_timestamp "Trovati ${#md_files[@]} file .md e ${#old_files[@]} file .old"
    
    # Combina tutti i file
    local all_files=("${md_files[@]}" "${old_files[@]}")
    
    # Processa in batch
    local total_batches=$(( (TOTAL_FILES + BATCH_SIZE - 1) / BATCH_SIZE ))
    for ((batch_num=0; batch_num<total_batches; batch_num++)); do
        local start_idx=$((batch_num * BATCH_SIZE))
        local end_idx=$(( (batch_num + 1) * BATCH_SIZE ))
        if [ "$end_idx" -gt "$TOTAL_FILES" ]; then
            end_idx="$TOTAL_FILES"
        fi
        
        echo -e "${BLUE}📦 Processando batch $((batch_num + 1))/$total_batches (file $((start_idx + 1))-$end_idx)...${NC}"
        
        # Estrai il subset di file per questo batch
        local batch_files=()
        for ((i=start_idx; i<end_idx; i++)); do
            batch_files+=("${all_files[$i]}")
        done
        
        # Processa il batch
        process_batch "${batch_files[@]}"
        
        # Pausa breve tra i batch per non sovraccaricare il sistema
        if [ "$batch_num" -lt "$((total_batches - 1))" ]; then
            sleep 1
        fi
    done
    
    # Riepilogo finale
    echo -e "\n${BOLD}${BLUE}=== 📊 RIEPILOGO FINALE ===${NC}"
    echo -e "${BLUE}📁 File totali processati: $TOTAL_FILES${NC}"
    echo -e "${GREEN}✅ File risolti con successo: $RESOLVED_FILES${NC}"
    echo -e "${RED}❌ File con errori: $FAILED_FILES${NC}"
    echo -e "${PURPLE}🔧 Conflitti totali risolti: $TOTAL_CONFLICTS${NC}"
    echo -e "${ORANGE}🗑️  File .old eliminati: $DELETED_OLD_FILES${NC}"
    
    # Salva riepilogo nel log
    {
        echo ""
        echo "=== RIEPILOGO FINALE ==="
        echo "File totali processati: $TOTAL_FILES"
        echo "File risolti con successo: $RESOLVED_FILES"
        echo "File con errori: $FAILED_FILES"
        echo "Conflitti totali risolti: $TOTAL_CONFLICTS"
        echo "File .old eliminati: $DELETED_OLD_FILES"
        echo "Dry-run: $DRY_RUN"
    } >> "$LOG_FILE"
    
    if [ "$DRY_RUN" = true ]; then
        echo -e "${YELLOW}🧪 DRY-RUN COMPLETATO: nessuna modifica ai file${NC}"
        return 0
    elif [ "$FAILED_FILES" -eq 0 ]; then
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
