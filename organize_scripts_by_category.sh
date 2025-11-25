#!/bin/bash

# Script per categorizzare e spostare tutti gli script .sh dalla root di bashscripts/ nelle sottocartelle appropriate
# Se lo script esiste già nella destinazione, cancella quello nella root
# Autore: AI Assistant
# Versione: 1.0

set -euo pipefail
IFS=$'\n\t'

# Colori
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[0;33m'
BLUE='\033[0;34m'
CYAN='\033[0;36m'
BOLD='\033[1m'
NC='\033[0m'

# Directory base
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
BASE_DIR="$SCRIPT_DIR"

# Log file
LOG_FILE="${BASE_DIR}/logs/organize_scripts_$(date +%Y%m%d_%H%M%S).log"
mkdir -p "${BASE_DIR}/logs"

log() {
    echo "[$(date '+%F %T')] $*" | tee -a "$LOG_FILE"
}

echo -e "${BOLD}${BLUE}=== 📁 Organizzazione Script per Categoria ===${NC}"
echo -e "${YELLOW}📝 Log: ${LOG_FILE}${NC}\n"

log "START script organization"

# Funzione per determinare la categoria di uno script
get_category() {
    local script="$1"
    local basename_script=$(basename "$script")
    
    # Usa pattern matching con if/elif per maggiore flessibilità
    # Conflict resolution (molto specifici - PRIMA di git per catturare fix_git_conflicts)
    if [[ "$basename_script" =~ conflict ]] || \
       [[ "$basename_script" =~ ^fix.*conflict ]] || \
       [[ "$basename_script" =~ ^resolve.*conflict ]] || \
       [[ "$basename_script" =~ merge.*conflict ]] || \
       [[ "$basename_script" =~ fix_git_conflicts ]] || \
       [[ "$basename_script" =~ resolve_git_conflicts ]] || \
       [[ "$basename_script" =~ resolve_conflicts ]] || \
       [[ "$basename_script" =~ resolve_git_conflict ]] || \
       [[ "$basename_script" =~ fix_remaining_conflicts ]] || \
       [[ "$basename_script" =~ resolve_conflicts_incoming ]]; then
        echo "conflicts"
        return
    fi
    
    # Git scripts (dopo conflicts)
    if [[ "$basename_script" =~ ^git_ ]] || \
       [[ "$basename_script" =~ ^git[^_] ]] || \
       [[ "$basename_script" =~ _git_ ]] || \
       [[ "$basename_script" =~ subtree ]] || \
       [[ "$basename_script" =~ submodule ]] || \
       [[ "$basename_script" =~ gitmodules ]] || \
       [[ "$basename_script" =~ git.*push ]] || \
       [[ "$basename_script" =~ git.*pull ]] || \
       [[ "$basename_script" =~ git.*sync ]] || \
       [[ "$basename_script" =~ git.*rebase ]] || \
       [[ "$basename_script" =~ git.*up ]] || \
       [[ "$basename_script" =~ git.*change ]] || \
       [[ "$basename_script" =~ git.*delete ]] || \
       [[ "$basename_script" =~ git.*init ]] || \
       [[ "$basename_script" =~ git.*reset ]] || \
       [[ "$basename_script" =~ git.*prune ]] || \
       [[ "$basename_script" =~ git.*remote ]] || \
       [[ "$basename_script" =~ reset_subtrees ]] || \
       [[ "$basename_script" =~ sync_submodules ]] || \
       [[ "$basename_script" =~ parse_gitmodules ]] || \
       [[ "$basename_script" =~ parse_gitmodules_ini ]]; then
        echo "git"
        return
    fi
    
    # Documentation (molto specifici)
    if [[ "$basename_script" =~ docs ]] || \
       [[ "$basename_script" =~ ^analyze_docs ]] || \
       [[ "$basename_script" =~ ^cleanup_docs ]] || \
       [[ "$basename_script" =~ ^migrate_docs ]] || \
       [[ "$basename_script" =~ ^organize_docs ]] || \
       [[ "$basename_script" =~ ^normalize_docs ]] || \
       [[ "$basename_script" =~ ^docs- ]] || \
       [[ "$basename_script" =~ ^docs_ ]] || \
       [[ "$basename_script" =~ update_docs ]] || \
       [[ "$basename_script" =~ refactor-docs ]]; then
        echo "docs"
        return
    fi
    
    # Translations (molto specifici)
    if [[ "$basename_script" =~ translation ]] || \
       [[ "$basename_script" =~ ^fix.*translation ]] || \
       [[ "$basename_script" =~ ^manage.*translation ]] || \
       [[ "$basename_script" =~ ^check.*translation ]] || \
       [[ "$basename_script" =~ fix_navigation_translations ]] || \
       [[ "$basename_script" =~ fix_translations ]] || \
       [[ "$basename_script" =~ manage_translations ]]; then
        echo "translations"
        return
    fi
    
    # MySQL (molto specifici)
    if [[ "$basename_script" =~ mysql ]]; then
        echo "mysql"
        return
    fi
    
    # MCP (molto specifici)
    if [[ "$basename_script" =~ ^mcp- ]] || \
       [[ "$basename_script" =~ mcp ]] || \
       [[ "$basename_script" =~ start-mysql-mcp ]] || \
       [[ "$basename_script" =~ mcp-manager ]]; then
        echo "mcp"
        return
    fi
    
    # Composer (molto specifici)
    if [[ "$basename_script" =~ ^composer_ ]] || \
       [[ "$basename_script" =~ ^get_composer ]] || \
       [[ "$basename_script" =~ composer_init ]]; then
        echo "composer"
        return
    fi
    
    # Backup (molto specifici)
    if [[ "$basename_script" =~ ^backup ]] || \
       [[ "$basename_script" =~ sync_to_disk ]] || \
       [[ "$basename_script" =~ sync_to_disk ]]; then
        echo "backup"
        return
    fi
    
    # Analysis (dopo docs/translations)
    if [[ "$basename_script" =~ ^analyze_ ]] || \
       [[ "$basename_script" =~ ^find_ ]]; then
        echo "analysis"
        return
    fi
    
    # Testing (dopo analysis)
    if [[ "$basename_script" =~ ^check_ ]] || \
       [[ "$basename_script" =~ ^test_ ]] || \
       [[ "$basename_script" =~ ^validate_ ]] || \
       [[ "$basename_script" =~ validate-shared ]]; then
        echo "testing"
        return
    fi
    
    # Fix scripts (generici ma dopo conflicts)
    if [[ "$basename_script" =~ ^fix_ ]]; then
        echo "fix"
        return
    fi
    
    # Refactoring
    if [[ "$basename_script" =~ ^refactor ]] || \
       [[ "$basename_script" =~ ^migrate_ ]]; then
        echo "refactor"
        return
    fi
    
    # Update
    if [[ "$basename_script" =~ ^update_ ]]; then
        echo "utilities"
        return
    fi
    
    # Utilities (generici)
    if [[ "$basename_script" =~ ^organize_ ]] || \
       [[ "$basename_script" =~ ^create_ ]] || \
       [[ "$basename_script" =~ ^verify_ ]] || \
       [[ "$basename_script" =~ ^sync_ ]] || \
       [[ "$basename_script" =~ ^normalize_ ]] || \
       [[ "$basename_script" =~ dual_push ]] || \
       [[ "$basename_script" =~ parse_ ]]; then
        echo "utilities"
        return
    fi
    
    # Default: utilities
    echo "utilities"
}

# Trova tutti gli script .sh nella root
mapfile -t root_scripts < <(find "$BASE_DIR" -maxdepth 1 -name "*.sh" -type f | sort)

total=${#root_scripts[@]}

if [ "$total" -eq 0 ]; then
    echo -e "${GREEN}✅ Nessuno script trovato nella root${NC}"
    log "No scripts found in root"
    exit 0
fi

echo -e "${CYAN}📋 Trovati $total script nella root${NC}"
log "Found $total scripts in root"

# Contatori
moved=0
skipped=0
deleted=0
errors=0

# Processa ogni script
for script in "${root_scripts[@]}"; do
    script_name=$(basename "$script")
    category=$(get_category "$script")
    dest_dir="${BASE_DIR}/${category}"
    dest_file="${dest_dir}/${script_name}"
    
    # Crea directory se non esiste
    mkdir -p "$dest_dir"
    
    echo -e "${YELLOW}🔧 $script_name → $category/${script_name}${NC}"
    log "Processing: $script_name → $category/"
    
    # Se il file esiste già nella destinazione, cancella quello nella root
    if [ -f "$dest_file" ]; then
        echo -e "${CYAN}  ⚠️  File già esistente in $category/, elimino dalla root${NC}"
        rm -f "$script"
        ((deleted++))
        log "  DELETED (exists in dest): $script_name → $dest_file"
    else
        # Sposta il file
        if mv "$script" "$dest_file" 2>/dev/null; then
            echo -e "${GREEN}  ✅ Spostato${NC}"
            log "  MOVED: $script_name → $dest_file"
            ((moved++))
        else
            echo -e "${RED}  ❌ Errore durante lo spostamento${NC}"
            log "  ERROR: Failed to move $script_name"
            ((errors++))
        fi
    fi
done

# Riepilogo
echo -e "\n${BOLD}${BLUE}=== 📊 Riepilogo ===${NC}"
echo -e "${GREEN}✅ Spostati: $moved${NC}"
echo -e "${CYAN}🗑️  Eliminati (identici): $deleted${NC}"
echo -e "${YELLOW}⏭️  Saltati (diversi): $skipped${NC}"
echo -e "${RED}❌ Errori: $errors${NC}"

log "SUMMARY: moved=$moved deleted=$deleted skipped=$skipped errors=$errors"

# Verifica script rimasti nella root
remaining=$(find "$BASE_DIR" -maxdepth 1 -name "*.sh" -type f | wc -l)

if [ "$remaining" -eq 0 ]; then
    echo -e "${GREEN}🎉 Tutti gli script sono stati organizzati!${NC}"
    log "SUCCESS: All scripts organized"
else
    echo -e "${YELLOW}⚠️  Rimangono $remaining script nella root${NC}"
    log "WARNING: $remaining scripts remaining in root"
fi

echo -e "${YELLOW}📝 Log completo: ${LOG_FILE}${NC}"

exit $([ "$errors" -eq 0 ] && echo 0 || echo 1)

