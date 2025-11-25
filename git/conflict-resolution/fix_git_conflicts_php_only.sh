#!/bin/bash

# Script per risolvere automaticamente i conflitti Git nei file PHP
# Mantiene solo la "current change" (la versione dopo =======)

RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[0;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color

BASE_DIR="/var/www/_bases/base_techplanner_fila4_mono"
SCRIPT_DIR="${BASE_DIR}/bashscripts"

TIMESTAMP=$(date +%Y%m%d_%H%M%S)
LOG_FILE="${SCRIPT_DIR}/logs/fix_conflicts_php_${TIMESTAMP}.log"
BACKUP_DIR="${SCRIPT_DIR}/backups/conflicts_php_${TIMESTAMP}"

mkdir -p "${SCRIPT_DIR}/logs"
mkdir -p "${BACKUP_DIR}"

echo -e "${BLUE}=== 🐄 SCRIPT SUPERMUCCA PHP - RISOLUZIONE CONFLITTI GIT ===${NC}"
echo -e "${BLUE}=== Sceglie SEMPRE la 'current change' (dopo =======) ===${NC}"
echo -e "${BLUE}=== $(date) ===${NC}"
echo -e "${YELLOW}📁 Directory di lavoro: ${BASE_DIR}${NC}"
echo -e "${YELLOW}📝 Log salvato in: ${LOG_FILE}${NC}"
echo -e "${YELLOW}💾 Backup salvati in: ${BACKUP_DIR}${NC}\n"

{
    echo "=== SCRIPT SUPERMUCCA PHP - RISOLUZIONE CONFLITTI GIT ==="
    echo "=== $(date) ==="
    echo "=== Sceglie sempre la 'current change' (dopo =======) ==="
    echo "=== Directory: ${BASE_DIR} ==="
    echo ""
} > "$LOG_FILE"

log_with_timestamp() {
    local message="$1"
    local timestamp=$(date '+%Y-%m-%d %H:%M:%S')
    echo "[$timestamp] $message" >> "$LOG_FILE"
}

resolve_file_conflicts() {
    local file="$1"
    local conflict_found=0

    # Check if the file exists and is writable
    if [ ! -f "$file" ]; then
        log_with_timestamp "ERRORE: File non trovato: $file"
        return 1
    fi
    if [ ! -w "$file" ]; then
        log_with_timestamp "ERRORE: File non scrivibile: $file"
        return 1
    fi

    # Check for conflict markers
    if grep -qE '<<<<<<< HEAD|=======|>>>>>>> ' "$file"; then
        conflict_found=1
        log_with_timestamp "Conflitti rilevati in: $file"
        cp "$file" "${BACKUP_DIR}/$(basename "$file").backup"
        log_with_timestamp "Backup creato: ${BACKUP_DIR}/$(basename "$file").backup"

        # Use sed to keep the "current change" (after =======)
        # This command deletes lines from "<<<<<<< HEAD" up to "=======" (inclusive)
        # and then deletes lines starting with ">>>>>>> "
        sed -i '/<<<<<<< HEAD/,/=======/d' "$file"
        sed -i '/^>>>>>>> /d' "$file"

        if grep -qE '<<<<<<< HEAD|=======|>>>>>>> ' "$file"; then
            echo -e "${RED}❌ ATTENZIONE: Conflitti rimanenti in: $file${NC}"
            log_with_timestamp "ERRORE: Conflitti rimanenti dopo la risoluzione in $file"
            return 1
        else
            echo -e "${GREEN}✅ Risolti conflitti in: $file${NC}"
            log_with_timestamp "SUCCESSO: Conflitti risolti in $file"
            return 0
        fi
    else
        log_with_timestamp "INFO: Nessun conflitto trovato in $file"
        return 2 # No conflicts found
    fi
}

TOTAL_FILES=0
RESOLVED_FILES=0
NO_CONFLICT_FILES=0
FAILED_FILES=0
TOTAL_CONFLICTS_RESOLVED=0

find_and_resolve_php_conflicts() {
    local search_dir="$1"

    echo -e "${BLUE}🔍 Ricerca file PHP con conflitti in: $search_dir${NC}"
    log_with_timestamp "Inizio ricerca conflitti PHP in: $search_dir"

    local conflict_files=()
    # Find only PHP files containing conflict markers
    while IFS= read -r -d '' file; do
        if [[ "$file" =~ \.php$ ]] && 
           [[ ! "$file" =~ \.git/ ]] &&
           [[ ! "$file" =~ vendor/ ]] &&
           [[ ! "$file" =~ node_modules/ ]] &&
           [[ ! "$file" =~ storage/ ]] &&
           [[ ! "$file" =~ public/build/ ]] &&
           [[ ! "$file" =~ bootstrap/cache/ ]] &&
           [[ ! "$file" =~ .env ]] &&
           [[ ! "$file" =~ .log ]] &&
           [[ ! "$file" =~ .bak ]] &&
           [[ ! "$file" =~ .tmp ]] &&
           [[ ! "$file" =~ .sqlite ]] &&
           [[ ! "$file" =~ .editorconfig ]] &&
           [[ ! "$file" =~ .prettierrc ]] &&
           [[ ! "$file" =~ .stylelintrc ]] &&
           [[ ! "$file" =~ .babelrc ]] &&
           [[ ! "$file" =~ .eslintrc ]] &&
           [[ ! "$file" =~ .gitignore ]] &&
           [[ ! "$file" =~ .gitattributes ]] &&
           [[ ! "$file" =~ .gitmodules ]] &&
           [[ ! "$file" =~ composer.lock ]] &&
           [[ ! "$file" =~ package-lock.json ]] &&
           [[ ! "$file" =~ yarn.lock ]] &&
           [[ ! "$file" =~ phpstan-baseline.neon ]] &&
           [[ ! "$file" =~ phpunit.xml ]] &&
           [[ ! "$file" =~ phpunit.xml.dist ]] &&
           [[ ! "$file" =~ psalm.xml ]] &&
           [[ ! "$file" =~ rector.php ]] &&
           [[ ! "$file" =~ pint.json ]] &&
           [[ ! "$file" =~ grumphp.yml ]] &&
           [[ ! "$file" =~ tailwind.config.js ]] &&
           [[ ! "$file" =~ postcss.config.js ]] &&
           [[ ! "$file" =~ vite.config.js ]] &&
           [[ ! "$file" =~ webpack.mix.js ]] &&
           [[ ! "$file" =~ .idea/ ]] &&
           [[ ! "$file" =~ .DS_Store ]] &&
           [[ ! "$file" =~ .vagrant/ ]] &&
           [[ ! "$file" =~ .terraform/ ]] &&
           [[ ! "$file" =~ .docker/ ]] &&
           [[ ! "$file" =~ .ssh/ ]] &&
           [[ ! "$file" =~ .gnupg/ ]] &&
           [[ ! "$file" =~ .npm/ ]] &&
           [[ ! "$file" =~ .composer/ ]] &&
           [[ ! "$file" =~ .config/ ]] &&
           [[ ! "$file" =~ .local/ ]] &&
           [[ ! "$file" =~ .cache/ ]] &&
           [[ ! "$file" =~ .bundle/ ]] &&
           [[ ! "$file" =~ .gem/ ]] &&
           [[ ! "$file" =~ .rvm/ ]] &&
           [[ ! "$file" =~ .nvm/ ]] &&
           [[ ! "$file" =~ .pyenv/ ]] &&
           [[ ! "$file" =~ .rbenv/ ]] &&
           [[ ! "$file" =~ .phpbrew/ ]] &&
           [[ ! "$file" =~ .bash_history ]] &&
           [[ ! "$file" =~ .zsh_history ]] &&
           [[ ! "$file" =~ .mysql_history ]] &&
           [[ ! "$file" =~ .psql_history ]] &&
           [[ ! "$file" =~ .viminfo ]] &&
           [[ ! "$file" =~ .bashrc ]] &&
           [[ ! "$file" =~ .zshrc ]] &&
           [[ ! "$file" =~ .profile ]] &&
           [[ ! "$file" =~ .gitconfig ]] &&
           [[ ! "$file" =~ .bash_profile ]] &&
           [[ ! "$file" =~ .bash_logout ]] &&
           [[ ! "$file" =~ .inputrc ]] &&
           [[ ! "$file" =~ .wget-hsts ]] &&
           [[ ! "$file" =~ .lesshst ]] &&
           [[ ! "$file" =~ bashscripts/ ]] &&
           [[ ! "$file" =~ resolve_merge_conflicts.sh ]] &&
           [[ ! "$file" =~ fix_helper_conflicts.sh ]] &&
           [[ ! "$file" =~ fix_git_conflicts ]] &&
           [[ ! "$file" =~ resolve_conflicts ]] &&
           [[ ! "$file" =~ fix_merge_conflicts ]] &&
           [[ ! "$file" =~ conflict_backup_ ]]; then
            conflict_files+=("$file")
        fi
    done < <(find "$search_dir" -type f -name "*.php" -print0 2>/dev/null)

    echo -e "${CYAN}📋 Trovati ${#conflict_files[@]} file PHP con conflitti${NC}"
    log_with_timestamp "Trovati ${#conflict_files[@]} file PHP con conflitti"

    for file in "${conflict_files[@]}"; do
        TOTAL_FILES=$((TOTAL_FILES + 1))
        echo -e "${YELLOW}[$TOTAL_FILES/${#conflict_files[@]}] 🔧 Elaborazione: $file${NC}"
        
        resolve_file_conflicts "$file"
        local result=$?
        
        case $result in
            0)
                RESOLVED_FILES=$((RESOLVED_FILES + 1))
                TOTAL_CONFLICTS_RESOLVED=$((TOTAL_CONFLICTS_RESOLVED + 1))
                ;;
            1)
                FAILED_FILES=$((FAILED_FILES + 1))
                ;;
            2)
                NO_CONFLICT_FILES=$((NO_CONFLICT_FILES + 1))
                ;;
        esac
    done
}

# Main execution
echo -e "${PURPLE}🚀 Avvio risoluzione conflitti Git...${NC}"
log_with_timestamp "Avvio risoluzione conflitti Git"

# Process Modules directory
find_and_resolve_php_conflicts "${BASE_DIR}/laravel/Modules"

# Process Themes directory
find_and_resolve_php_conflicts "${BASE_DIR}/laravel/Themes"

# Process other PHP files in laravel directory
find_and_resolve_php_conflicts "${BASE_DIR}/laravel"

# Final verification
echo -e "${BLUE}🔍 Verifica finale: controllo conflitti rimanenti...${NC}"
log_with_timestamp "Verifica finale conflitti rimanenti"

remaining_conflicts=$(find "${BASE_DIR}/laravel" -name "*.php" -type f -exec grep -l '<<<<<<< HEAD\|=======\|>>>>>>> ' {} \; 2>/dev/null | wc -l)

if [ "$remaining_conflicts" -gt 0 ]; then
    echo -e "${RED}❌ ATTENZIONE: Trovati $remaining_conflicts file con conflitti rimanenti!${NC}"
    log_with_timestamp "ATTENZIONE: Trovati $remaining_conflicts file con conflitti rimanenti"
else
    echo -e "${GREEN}✅ Tutti i conflitti sono stati risolti!${NC}"
    log_with_timestamp "SUCCESSO: Tutti i conflitti sono stati risolti"
fi

# Summary
echo -e "\n${BLUE}=== 📊 RIEPILOGO FINALE ===${NC}"
echo -e "${BLUE}📁 File totali processati: $TOTAL_FILES${NC}"
echo -e "${GREEN}✅ File risolti con successo: $RESOLVED_FILES${NC}"
echo -e "${YELLOW}⚠️  File senza conflitti: $NO_CONFLICT_FILES${NC}"
echo -e "${RED}❌ File con errori: $FAILED_FILES${NC}"
echo -e "${PURPLE}🔧 Conflitti totali risolti: $TOTAL_CONFLICTS_RESOLVED${NC}"

if [ "$remaining_conflicts" -gt 0 ]; then
    echo -e "${RED}⚠️  ALCUNI CONFLITTI POTREBBERO ESSERE RIMASTI${NC}"
    echo -e "${YELLOW}💡 Esegui nuovamente lo script per risolverli${NC}"
fi

log_with_timestamp "Script completato - File processati: $TOTAL_FILES, Risolti: $RESOLVED_FILES, Errori: $FAILED_FILES"

echo -e "\n${GREEN}🎉 Script completato!${NC}"
echo -e "${BLUE}📝 Log salvato in: $LOG_FILE${NC}"
echo -e "${BLUE}💾 Backup salvati in: $BACKUP_DIR${NC}"
