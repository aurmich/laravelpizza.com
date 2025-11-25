#!/bin/bash

# Script avanzato per risolvere automaticamente i conflitti Git scegliendo sempre la "current change"
# Autore: AI Assistant migliorato
# Data: $(date +%Y-%m-%d)
# Versione: 4.0 - Enhanced Edition
# 
# Questo script risolve tutti i conflitti Git scegliendo sempre la versione "current change"
# (quella dopo il separatore =======) invece della versione HEAD
# 
# MIGLIORAMENTI:
# - Verifica della sintassi PHP dopo la risoluzione
# - Opzione --dry-run per testare senza modificare
# - Supporto per più tipi di file
# - Logging dettagliato
# - Backup automatico
# - Verifica post-risoluzione

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
PHP_SYNTAX_CHECK=true
VERBOSE=false

# Parse arguments
while [[ $# -gt 0 ]]; do
    case $1 in
        --dry-run)
            DRY_RUN=true
            shift
            ;;
        --no-php-check)
            PHP_SYNTAX_CHECK=false
            shift
            ;;
        --verbose)
            VERBOSE=true
            shift
            ;;
        --help|-h)
            echo "Uso: $0 [opzioni]"
            echo "Opzioni:"
            echo "  --dry-run      Testa senza modificare i file"
            echo "  --no-php-check Disabilita la verifica sintassi PHP"
            echo "  --verbose      Output dettagliato"
            echo "  --help, -h     Mostra questo aiuto"
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
LOG_FILE="${SCRIPT_DIR}/logs/fix_conflicts_enhanced_${TIMESTAMP}.log"
BACKUP_DIR="${SCRIPT_DIR}/backups/conflicts_enhanced_${TIMESTAMP}"

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

echo -e "${BOLD}${BLUE}=== 🐄 SCRIPT ENHANCED - RISOLUZIONE CONFLITTI GIT ===${NC}"
echo -e "${BOLD}${BLUE}=== Sceglie SEMPRE la 'current change' (dopo =======) ===${NC}"
echo -e "${BOLD}${BLUE}=== $(date) ===${NC}"
echo -e "${YELLOW}📁 Directory di lavoro: ${BASE_DIR}${NC}"
echo -e "${YELLOW}📝 Log salvato in: ${LOG_FILE}${NC}"
echo -e "${YELLOW}💾 Backup salvati in: ${BACKUP_DIR}${NC}"
echo -e "${YELLOW}🧪 Dry-run: ${DRY_RUN}${NC}"
echo -e "${YELLOW}🔍 Verifica PHP: ${PHP_SYNTAX_CHECK}${NC}"
echo -e "${YELLOW}📢 Verbose: ${VERBOSE}${NC}\n"

# Inizializza il log
{
    echo "=== SCRIPT ENHANCED - RISOLUZIONE CONFLITTI GIT ==="
    echo "=== $(date) ==="
    echo "=== Sceglie SEMPRE la 'current change' (dopo =======) ==="
    echo "=== Directory: ${BASE_DIR} ==="
    echo "=== Versione: 4.0 - Enhanced Edition ==="
    echo "=== Dry-run: ${DRY_RUN} ==="
    echo "=== PHP syntax check: ${PHP_SYNTAX_CHECK} ==="
    echo ""
} > "$LOG_FILE"

# Contatori globali
TOTAL_FILES=0
RESOLVED_FILES=0
FAILED_FILES=0
SKIPPED_FILES=0
TOTAL_CONFLICTS=0
PHP_SYNTAX_ERRORS=0

# Funzione per verificare la sintassi PHP
check_php_syntax() {
    local file="$1"
    
    # Verifica solo se è un file PHP e la verifica è abilitata
    if [[ "$PHP_SYNTAX_CHECK" = true && "$file" == *.php ]]; then
        if php -l "$file" >/dev/null 2>&1; then
            verbose "${GREEN}✅ Sintassi PHP OK: $file${NC}"
            log_with_timestamp "PHP_SYNTAX_OK: $file"
            return 0
        else
            local error_output
            error_output=$(php -l "$file" 2>&1 || true)
            echo -e "${RED}❌ Errore sintassi PHP in $file:${NC}"
            echo -e "${RED}$error_output${NC}"
            log_with_timestamp "PHP_SYNTAX_ERROR: $file - $error_output"
            ((PHP_SYNTAX_ERRORS++))
            return 1
        fi
    fi
    return 0
}

# Funzione per risolvere i conflitti in un singolo file usando awk
resolve_file_conflicts() {
    local file="$1"
    local temp_file="${file}.tmp.${TIMESTAMP}"
    local conflict_count=0
    
    log_with_timestamp "Elaborazione file: $file"
    verbose "${CYAN}🔍 Analisi file: $file${NC}"
    
    # Verifica se il file esiste ed è accessibile
    if [ ! -f "$file" ] || [ ! -r "$file" ] || [ ! -w "$file" ]; then
        echo -e "${RED}❌ File non accessibile: $file${NC}"
        log_with_timestamp "ERRORE: File non accessibile: $file"
        return 1
    fi
    
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
    awk '
    BEGIN {
        in_conflict = 0
        keep_current = 0
        conflict_count = 0
        lines_before = 0
        lines_after = 0
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
    
    # Conta le linee prima e dopo
    {
        if (!in_conflict || keep_current) {
            lines_after++
            print $0
        }
        lines_before++
    }
    
    END {
        if (conflict_count > 0) {
            print "CONFLICTS_RESOLVED:" conflict_count ":" lines_before ":" lines_after > "/dev/stderr"
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
            local lines_before=$(echo "$stats_line" | cut -d: -f3)
            local lines_after=$(echo "$stats_line" | cut -d: -f4)
            verbose "${CYAN}📊 Statistiche: $lines_before → $lines_after linee${NC}"
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
            # Verifica sintassi PHP se necessario
            if check_php_syntax "$temp_file"; then
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
                echo -e "${RED}❌ Errore sintassi PHP dopo risoluzione in: $file${NC}"
                log_with_timestamp "ERRORE_SINTASSI_PHP: $file"
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

# Funzione per trovare e processare tutti i file con conflitti
find_and_resolve_all_conflicts() {
    local search_dir="$1"
    
    echo -e "${BLUE}🔍 Ricerca file con conflitti in: $search_dir${NC}"
    log_with_timestamp "Inizio ricerca conflitti in: $search_dir"
    
    # Trova tutti i file con conflitti
    local conflict_files=()
    while IFS= read -r -d '' file; do
        # Verifica che il file contenga effettivamente conflitti
        if grep -q "^<<<<<<< " "$file" 2>/dev/null; then
            conflict_files+=("$file")
        fi
    done < <(find "$search_dir" -type f \
        ! -path "*/.git/*" \
        ! -path "*/vendor/*" \
        ! -path "*/node_modules/*" \
        \( -name "*.php" -o -name "*.js" -o -name "*.vue" -o -name "*.ts" \
        -o -name "*.json" -o -name "*.md" -o -name "*.sh" \
        -o -name "*.yml" -o -name "*.yaml" -o -name "*.blade.php" \
        -o -name "*.neon" -o -name "*.xml" \) \
        -print0 2>/dev/null)
    
    TOTAL_FILES=${#conflict_files[@]}
    
    if [ "$TOTAL_FILES" -eq 0 ]; then
        echo -e "${GREEN}🎉 Nessun file con conflitti trovato!${NC}"
        log_with_timestamp "INFO: Nessun file con conflitti trovato"
        return 0
    fi
    
    echo -e "${CYAN}📋 Trovati $TOTAL_FILES file con conflitti${NC}"
    log_with_timestamp "Trovati $TOTAL_FILES file con conflitti"
    
    # Processa ogni file
    local file_count=0
    for file in "${conflict_files[@]}"; do
        ((file_count++))
        echo -e "${YELLOW}[$file_count/$TOTAL_FILES] 🔧 Elaborazione: $file${NC}"
        
        # Risolvi i conflitti nel file
        case $(resolve_file_conflicts "$file") in
            0)
                ((RESOLVED_FILES++))
                ;;
            1)
                ((FAILED_FILES++))
                ;;
            2)
                ((SKIPPED_FILES++))
                ;;
        esac
    done
}

# Funzione per verificare che non ci siano più conflitti
verify_no_conflicts() {
    local search_dir="$1"
    local remaining_conflicts=0
    
    echo -e "${BLUE}🔍 Verifica finale: controllo conflitti rimanenti...${NC}"
    
    local remaining_files=()
    while IFS= read -r -d '' file; do
        if grep -q "^<<<<<<< " "$file" 2>/dev/null; then
            remaining_files+=("$file")
        fi
    done < <(find "$search_dir" -type f \
        ! -path "*/.git/*" \
        ! -path "*/vendor/*" \
        ! -path "*/node_modules/*" \
        \( -name "*.php" -o -name "*.js" -o -name "*.vue" -o -name "*.ts" \
        -o -name "*.json" -o -name "*.md" -o -name "*.sh" \
        -o -name "*.yml" -o -name "*.yaml" -o -name "*.blade.php" \
        -o -name "*.neon" -o -name "*.xml" \) \
        -print0 2>/dev/null)
    
    local remaining_conflicts=${#remaining_files[@]}
    
    if [ "$remaining_conflicts" -eq 0 ]; then
        echo -e "${GREEN}✅ Verifica completata: nessun conflitto rimanente!${NC}"
        log_with_timestamp "SUCCESSO: Verifica completata, nessun conflitto rimanente"
        return 0
    else
        echo -e "${RED}❌ ATTENZIONE: Trovati $remaining_conflicts file con conflitti rimanenti!${NC}"
        log_with_timestamp "ATTENZIONE: Trovati $remaining_conflicts file con conflitti rimanenti"
        return 1
    fi
}

# Funzione principale
main() {
    echo -e "${BOLD}${PURPLE}🚀 Avvio risoluzione conflitti Git...${NC}"
    
    # Trova e risolvi tutti i conflitti
    find_and_resolve_all_conflicts "$BASE_DIR"
    
    # Verifica che non ci siano più conflitti (solo se non è dry-run)
    local verify_result=0
    if [ "$DRY_RUN" = false ]; then
        verify_no_conflicts "$BASE_DIR"
        verify_result=$?
    fi
    
    # Riepilogo finale
    echo -e "\n${BOLD}${BLUE}=== 📊 RIEPILOGO FINALE ===${NC}"
    echo -e "${BLUE}📁 File totali processati: $TOTAL_FILES${NC}"
    echo -e "${GREEN}✅ File risolti con successo: $RESOLVED_FILES${NC}"
    echo -e "${YELLOW}⚠️  File senza conflitti: $SKIPPED_FILES${NC}"
    echo -e "${RED}❌ File con errori: $FAILED_FILES${NC}"
    echo -e "${PURPLE}🔧 Conflitti totali risolti: $TOTAL_CONFLICTS${NC}"
    if [ "$PHP_SYNTAX_CHECK" = true ]; then
        echo -e "${ORANGE}🐘 Errori sintassi PHP: $PHP_SYNTAX_ERRORS${NC}"
    fi
    
    # Salva riepilogo nel log
    {
        echo ""
        echo "=== RIEPILOGO FINALE ==="
        echo "File totali processati: $TOTAL_FILES"
        echo "File risolti con successo: $RESOLVED_FILES"
        echo "File senza conflitti: $SKIPPED_FILES"
        echo "File con errori: $FAILED_FILES"
        echo "Conflitti totali risolti: $TOTAL_CONFLICTS"
        echo "Errori sintassi PHP: $PHP_SYNTAX_ERRORS"
        echo "Dry-run: $DRY_RUN"
        echo "Verifica finale: $([ $verify_result -eq 0 ] && echo "SUCCESSO" || echo "ATTENZIONE")"
    } >> "$LOG_FILE"
    
    if [ "$DRY_RUN" = true ]; then
        echo -e "${YELLOW}🧪 DRY-RUN COMPLETATO: nessuna modifica ai file${NC}"
        echo -e "${YELLOW}💾 I backup non sono stati creati in modalità dry-run${NC}"
        return 0
    elif [ $verify_result -eq 0 ] && [ "$FAILED_FILES" -eq 0 ] && [ "$PHP_SYNTAX_ERRORS" -eq 0 ]; then
        echo -e "${GREEN}🎉 TUTTI I CONFLITTI SONO STATI RISOLTI CON SUCCESSO!${NC}"
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
