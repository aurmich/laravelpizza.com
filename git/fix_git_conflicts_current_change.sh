#!/bin/bash

# Script avanzato per risolvere automaticamente i conflitti Git scegliendo sempre la "INCOMING change"
# ATTENZIONE: Questo script mantiene la versione INCOMING (dopo =======), NON HEAD (prima di =======)
# Autore: AI Assistant con poteri della supermucca
# Versione: 5.0 - Migliorata con parametrizzazione e sicurezza
# 
# Questo script risolve tutti i conflitti Git scegliendo sempre la versione "INCOMING change"
# (contenuto tra ======= e >>>>>>>) invece della versione HEAD (tra <<<<<<< e =======)
#
# USAGE:
#   ./fix_git_conflicts_current_change.sh [DIRECTORY] [--dry-run] [--no-confirm] [--help]
#
# ESEMPI:
#   # Dry-run nella directory corrente
#   DRY_RUN=true ./fix_git_conflicts_current_change.sh
#
#   # Risolvi conflitti in una directory specifica
#   ./fix_git_conflicts_current_change.sh /path/to/repo
#
#   # Risolvi senza conferma interattiva
#   ./fix_git_conflicts_current_change.sh --no-confirm

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

# Parse arguments
BASE_DIR=""
DRY_RUN=${DRY_RUN:-false}
INTERACTIVE=true
SHOW_HELP=false

for arg in "$@"; do
    case $arg in
        --dry-run)
            DRY_RUN=true
            ;;
        --no-confirm)
            INTERACTIVE=false
            ;;
        --help|-h)
            SHOW_HELP=true
            ;;
        *)
            if [ -z "$BASE_DIR" ] && [ -d "$arg" ]; then
                BASE_DIR="$arg"
            fi
            ;;
    esac
done

# Supporta anche variabile d'ambiente DRY_RUN
if [ "${DRY_RUN:-false}" = "true" ]; then
    DRY_RUN=true
fi

# Show help
if [ "$SHOW_HELP" = true ]; then
    cat <<EOF
${BOLD}${BLUE}Script Risoluzione Conflitti Git (INCOMING Change)${NC}

${BOLD}ATTENZIONE:${NC} Questo script mantiene la versione ${RED}INCOMING${NC} (dopo =======), 
${RED}NON${NC} la versione HEAD (prima di =======)!

${BOLD}USAGE:${NC}
    ./fix_git_conflicts_current_change.sh [DIRECTORY] [OPTIONS]

${BOLD}ARGOMENTI:${NC}
    DIRECTORY          Directory del repository git (default: directory corrente)

${BOLD}OPZIONI:${NC}
    --dry-run          Simula senza modificare i file
    --no-confirm       Non chiedere conferma prima di procedere
    --help, -h         Mostra questo messaggio

${BOLD}ESEMPI:${NC}
    # Dry-run nella directory corrente
    DRY_RUN=true ./fix_git_conflicts_current_change.sh

    # Risolvi conflitti in una directory specifica
    ./fix_git_conflicts_current_change.sh /var/www/_bases/base_techplanner_fila4_mono

    # Risolvi senza conferma
    ./fix_git_conflicts_current_change.sh --no-confirm

${BOLD}NOTE:${NC}
    - I backup vengono salvati in: bashscripts/backups/
    - I log vengono salvati in: bashscripts/logs/
    - Lo script verifica automaticamente se sei in un repository git
EOF
    exit 0
fi

# Determina BASE_DIR
if [ -z "$BASE_DIR" ]; then
    # Prova a usare la directory corrente
    BASE_DIR="$(pwd)"
    # Se siamo nella root del progetto, usa laravel/
    if [ -d "$BASE_DIR/laravel" ]; then
        BASE_DIR="$BASE_DIR/laravel"
    elif [ -f "$BASE_DIR/composer.json" ]; then
        BASE_DIR="$BASE_DIR"
    fi
fi

# Verifica che BASE_DIR esista
if [ ! -d "$BASE_DIR" ]; then
    echo -e "${RED}❌ ERRORE: Directory non trovata: $BASE_DIR${NC}"
    exit 1
fi

# Verifica che sia un repository git
if ! git -C "$BASE_DIR" rev-parse --git-dir > /dev/null 2>&1; then
    echo -e "${RED}❌ ERRORE: $BASE_DIR non è un repository git!${NC}"
    echo -e "${YELLOW}💡 Suggerimento: Esegui lo script dalla root del progetto git${NC}"
    exit 1
fi

# Determina SCRIPT_DIR (directory dello script)
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

# Opzioni
BACKUP_DIR="${SCRIPT_DIR}/backups/conflicts_incoming_$(date +%Y%m%d_%H%M%S)"
LOG_DIR="${SCRIPT_DIR}/logs"
mkdir -p "$LOG_DIR" "$BACKUP_DIR"
LOG_FILE="${LOG_DIR}/fix_conflicts_incoming_$(date +%Y%m%d_%H%M%S).log"

# Banner
echo -e "${BOLD}${BLUE}=== 🐄 SCRIPT SUPERMUCCA V5.0 - RISOLUZIONE CONFLITTI GIT ===${NC}"
echo -e "${RED}⚠️  ATTENZIONE: Questo script mantiene la versione ${BOLD}INCOMING${NC}${RED} (dopo =======)${NC}"
echo -e "${RED}⚠️             ${BOLD}NON${NC}${RED} la versione HEAD (prima di =======)${NC}"
echo -e "${YELLOW}📁 Directory di lavoro: ${BASE_DIR}${NC}"
echo -e "${YELLOW}📝 Log: ${LOG_FILE}${NC}"
echo -e "${YELLOW}💾 Backup: ${BACKUP_DIR}${NC}"
echo -e "${YELLOW}🧪 Dry-run: ${DRY_RUN}${NC}"
echo -e "${YELLOW}💬 Interattivo: ${INTERACTIVE}${NC}\n"

# Log helper
log() { echo "[$(date '+%F %T')] $*" >>"$LOG_FILE"; }

log "START incoming-change resolver (dry=$DRY_RUN, dir=$BASE_DIR)"

# Resolver AWK: tiene solo la sezione dopo ======= fino a >>>>>>>
# ATTENZIONE: Questo mantiene INCOMING, non HEAD!
resolve_with_incoming() {
  awk '
    BEGIN{state=0; conflict_count=0}
    /^<<<<<<< /{state=1; conflict_count++; next}
    /^=======/{if(state==1) state=2; next}
    /^>>>>>>> /{if(state>0) state=0; next}
    { if(state==0 || state==2) print $0 }
    END{if(conflict_count>0) print "CONFLICTS:" conflict_count > "/dev/stderr"}
  '
}

process_file() {
  local file="$1"
  
  # Salta binari
  if file --brief --mime "$file" 2>/dev/null | grep -qi "binary"; then
    echo -e "${YELLOW}⏭️  Binario: $file${NC}"
    log "SKIP binary $file"
    return 2
  fi
  
  # Verifica presenza marker
  if ! grep -q "^<<<<<<< " "$file" 2>/dev/null; then
    log "NO-CONFLICT $file"
    return 3
  fi
  
  local tmp conflict_count
  tmp="${file}.tmp.$RANDOM"
  conflict_count=$(resolve_with_incoming <"$file" 2>&1 >"$tmp" | grep -oP 'CONFLICTS:\K\d+' || echo "0")
  
  if [ "$DRY_RUN" = true ]; then
    # Solo verifica conversione
    if [ -f "$tmp" ]; then
      local before after
      before=$(wc -l <"$file" | tr -d ' ')
      after=$(wc -l <"$tmp" | tr -d ' ')
      rm -f "$tmp"
      echo -e "${CYAN}🔎 DRY: $file (${conflict_count} conflitti, righe: ${before}→${after})${NC}"
      log "DRY $file conflicts=$conflict_count ${before}->${after}"
      return 0
    else
      rm -f "$tmp"
      echo -e "${RED}❌ DRY err: $file${NC}"
      log "DRY-ERR $file"
      return 1
    fi
  fi
  
  # Backup e sovrascrittura
  cp "$file" "${BACKUP_DIR}/$(basename "$file").backup.$(date +%s)" 2>/dev/null || {
    echo -e "${RED}❌ Impossibile creare backup: $file${NC}"
    log "ERROR backup failed $file"
    rm -f "$tmp"
    return 1
  }
  
  if [ -f "$tmp" ]; then
    mv "$tmp" "$file"
    echo -e "${GREEN}✅ Risolto: $file (${conflict_count} conflitti)${NC}"
    log "FIXED $file conflicts=$conflict_count"
    return 0
  else
    rm -f "$tmp"
    echo -e "${RED}❌ Errore: $file${NC}"
    log "ERROR $file"
    return 1
  fi
}

main() {
  # Trova file con conflitti
  echo -e "${BLUE}🔍 Ricerca file con conflitti in: $BASE_DIR${NC}"
  log "Searching conflicts in $BASE_DIR"
  
  # Costruisci lista file null-delimitata con filtri migliorati
  local files=()
  while IFS= read -r -d '' file; do
    files+=("$file")
  done < <(find "$BASE_DIR" -type f \
    ! -path "*/.git/*" \
    ! -path "*/node_modules/*" \
    ! -path "*/vendor/*" \
    ! -path "*/storage/*" \
    ! -path "*/bootstrap/cache/*" \
    ! -path "*/backups/*" \
    ! -path "*/logs/*" \
    ! -path "*/tmp/*" \
    ! -path "*/temp/*" \
    ! -path "*/.idea/*" \
    ! -path "*/.vscode/*" \
    ! -path "*/public/build/*" \
    ! -path "*/public/hot/*" \
    ! -name "*.log" \
    ! -name "*.cache" \
    ! -name "*.tmp" \
    -exec grep -IlZ "^<<<<<<< " {} + 2>/dev/null | head -1000 || true)

  local total=${#files[@]} ok=0 err=0 skip=0 none=0
  
  if [ "$total" -eq 0 ]; then
    echo -e "${GREEN}🎉 Nessun file con conflitti trovato!${NC}"
    log "SUCCESS: No conflicts found"
    return 0
  fi
  
  echo -e "${CYAN}📋 Trovati $total file con marker di conflitto${NC}"
  log "Found $total files with conflicts"
  
  # Conferma interattiva
  if [ "$INTERACTIVE" = true ] && [ "$DRY_RUN" != true ]; then
    echo -e "${YELLOW}⚠️  Procedere con la risoluzione di $total file? (y/N)${NC}"
    read -r confirm
    if [[ "$confirm" != "y" && "$confirm" != "Y" ]]; then
      echo -e "${YELLOW}Operazione annullata.${NC}"
      log "CANCELLED by user"
      return 0
    fi
  fi
  
  # Processa ogni file
  local file_count=0
  for f in "${files[@]}"; do
    ((file_count++))
    echo -e "${YELLOW}[$file_count/$total] 🔧 Elaborazione: $f${NC}"
    
    case $(process_file "$f") in
      0) ((ok++)) || true ;;
      1) ((err++)) || true ;;
      2) ((skip++)) || true ;;
      3) ((none++)) || true ;;
    esac
  done

  # Verifica residui
  local remaining
  remaining=$(find "$BASE_DIR" -type f ! -path "*/.git/*" ! -path "*/node_modules/*" ! -path "*/vendor/*" \
    -exec grep -l "^<<<<<<< " {} + 2>/dev/null | wc -l || echo "0")
  
  echo -e "\n${BOLD}${BLUE}=== 📊 Riepilogo ===${NC}"
  echo -e "${GREEN}✅ Risolti: $ok${NC}  ${RED}❌ Errori: $err${NC}  ${YELLOW}⏭️  Skipped: $skip${NC}  ℹ️ No-conflict: $none"
  echo -e "${BLUE}📋 Restanti con conflitti: $remaining${NC}"
  
  log "SUMMARY ok=$ok err=$err skip=$skip none=$none remaining=$remaining"
  
  if [ "$DRY_RUN" = true ]; then
    echo -e "${YELLOW}🧪 DRY-RUN completato: nessuna modifica ai file.${NC}"
  elif [ "$remaining" -eq 0 ]; then
    echo -e "${GREEN}🎉 TUTTI I CONFLITTI SONO STATI RISOLTI!${NC}"
    echo -e "${GREEN}💾 Backup salvati in: ${BACKUP_DIR}${NC}"
    echo -e "${GREEN}📝 Log completo in: ${LOG_FILE}${NC}"
  else
    echo -e "${YELLOW}⚠️  Alcuni conflitti potrebbero essere rimasti.${NC}"
    echo -e "${YELLOW}💡 Esegui nuovamente lo script per risolverli${NC}"
  fi
  
  return $([ "$err" -eq 0 ] && echo 0 || echo 1)
}

main "$@"
