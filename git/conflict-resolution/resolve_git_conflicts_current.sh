#!/bin/bash

# Script avanzato per risolvere automaticamente i conflitti Git scegliendo sempre la "current version" (HEAD)
# ATTENZIONE: Questo script mantiene la versione HEAD (prima di =======), NON la versione INCOMING (dopo =======)
# Ispirato a fix_git_conflicts_current_change.sh, ma con logica invertita per tenere HEAD
#
# USAGE:
#   ./resolve_git_conflicts_current.sh [DIRECTORY] [--dry-run] [--no-confirm] [--help]
#
# ESEMPI:
#   # Dry-run nella directory corrente (nessuna modifica ai file)
#   DRY_RUN=true ./resolve_git_conflicts_current.sh
#
#   # Risolvi conflitti nella cartella laravel/ del progetto mono
#   ./resolve_git_conflicts_current.sh /var/www/_bases/base_techplanner_fila4_mono
#
#   # Risolvi senza conferma interattiva
#   ./resolve_git_conflicts_current.sh --no-confirm

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

# Mostra help
if [ "$SHOW_HELP" = true ]; then
    cat <<EOF
${BOLD}${BLUE}Script Risoluzione Conflitti Git (HEAD / current version)${NC}

${BOLD}ATTENZIONE:${NC} Questo script mantiene la versione ${GREEN}HEAD${NC} (prima di =======),
${RED}NON${NC} la versione INCOMING (dopo =======)!

${BOLD}USAGE:${NC}
    ./resolve_git_conflicts_current.sh [DIRECTORY] [OPTIONS]

${BOLD}ARGOMENTI:${NC}
    DIRECTORY          Directory del repository git o root progetto (default: directory corrente)

${BOLD}OPZIONI:${NC}
    --dry-run          Simula senza modificare i file (mostra solo cosa verrebbe cambiato)
    --no-confirm       Non chiedere conferma prima di procedere
    --help, -h         Mostra questo messaggio

${BOLD}ESEMPI:${NC}
    # Dry-run nella directory corrente
    DRY_RUN=true ./resolve_git_conflicts_current.sh

    # Risolvi conflitti in un progetto specifico
    ./resolve_git_conflicts_current.sh /var/www/_bases/base_techplanner_fila4_mono

    # Risolvi senza conferma
    ./resolve_git_conflicts_current.sh --no-confirm

${BOLD}NOTE:${NC}
    - I backup vengono salvati in: bashscripts/backups/
    - I log vengono salvati in: bashscripts/logs/
    - Lo script verifica automaticamente se sei in un repository git
EOF
    exit 0
fi

# Determina BASE_DIR
if [ -z "$BASE_DIR" ]; then
    BASE_DIR="$(pwd)"
    # Se siamo nella root del progetto mono, preferisci la directory laravel/
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

# Verifica che sia un repository git (anche se .git è in una parent directory)
if ! git -C "$BASE_DIR" rev-parse --git-dir > /dev/null 2>&1; then
    echo -e "${RED}❌ ERRORE: $BASE_DIR non è in un repository git!${NC}"
    echo -e "${YELLOW}💡 Suggerimento: Esegui lo script dalla root del progetto git${NC}"
    exit 1
fi

# Directory dello script
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

# Opzioni di logging e backup
BACKUP_DIR="${SCRIPT_DIR}/backups/conflicts_head_$(date +%Y%m%d_%H%M%S)"
LOG_DIR="${SCRIPT_DIR}/logs"
mkdir -p "$LOG_DIR" "$BACKUP_DIR"
LOG_FILE="${LOG_DIR}/resolve_git_conflicts_current_$(date +%Y%m%d_%H%M%S).log"

echo -e "${BOLD}${BLUE}=== 🐄 SCRIPT SUPERMUCCA - RISOLUZIONE CONFLITTI GIT (HEAD) ===${NC}"
echo -e "${GREEN}✅ Questo script mantiene SEMPRE la current version (HEAD)${NC}"
echo -e "${YELLOW}📁 Directory di lavoro: ${BASE_DIR}${NC}"
echo -e "${YELLOW}📝 Log: ${LOG_FILE}${NC}"
echo -e "${YELLOW}💾 Backup: ${BACKUP_DIR}${NC}"
echo -e "${YELLOW}🧪 Dry-run: ${DRY_RUN}${NC}"
echo -e "${YELLOW}💬 Interattivo: ${INTERACTIVE}${NC}\n"

log() { echo "[$(date '+%F %T')] $*" >>"$LOG_FILE"; }

log "START head-resolver (dry=$DRY_RUN, dir=$BASE_DIR)"

# Resolver AWK: tiene solo la sezione HEAD (prima di =======) e scarta la INCOMING
resolve_with_head() {
  awk '
    BEGIN{in_conflict=0; keep_head=0; conflict_count=0}
    /^<<<<<<< /{in_conflict=1; keep_head=1; conflict_count++; next}
    /^=======/{if(in_conflict) keep_head=0; next}
    /^>>>>>>> /{if(in_conflict){in_conflict=0; keep_head=0} next}
    { if(!in_conflict || keep_head) print $0 }
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
  conflict_count=$(resolve_with_head <"$file" 2>&1 >"$tmp" | grep -oP 'CONFLICTS:\\K\d+' || echo "0")

  if [ "$DRY_RUN" = true ]; then
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
    echo -e "${GREEN}✅ Risolto (HEAD): $file (${conflict_count} conflitti)${NC}"
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
  echo -e "${BLUE}🔍 Ricerca file con conflitti in: $BASE_DIR${NC}"
  log "Searching conflicts in $BASE_DIR"

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

  if [ "$INTERACTIVE" = true ] && [ "$DRY_RUN" != true ]; then
    echo -e "${YELLOW}⚠️  Procedere con la risoluzione di $total file mantenendo HEAD? (y/N)${NC}"
    read -r confirm
    if [[ "$confirm" != "y" && "$confirm" != "Y" ]]; then
      echo -e "${YELLOW}Operazione annullata.${NC}"
      log "CANCELLED by user"
      return 0
    fi
  fi

  local file_count=0
  for f in "${files[@]}"; do
    ((file_count++))
    echo -e "${YELLOW}[$file_count/$total] 🔧 Elaborazione (HEAD): $f${NC}"

    case $(process_file "$f") in
      0) ((ok++)) || true ;;
      1) ((err++)) || true ;;
      2) ((skip++)) || true ;;
      3) ((none++)) || true ;;
    esac
  done

  local remaining
  remaining=$(find "$BASE_DIR" -type f ! -path "*/.git/*" ! -path "*/node_modules/*" ! -path "*/vendor/*" \
    -exec grep -l "^<<<<<<< " {} + 2>/dev/null | wc -l || echo "0")

  echo -e "\n${BOLD}${BLUE}=== 📊 Riepilogo (HEAD) ===${NC}"
  echo -e "${GREEN}✅ Risolti: $ok${NC}  ${RED}❌ Errori: $err${NC}  ${YELLOW}⏭️  Skipped: $skip${NC}  ℹ️ No-conflict: $none"
  echo -e "${BLUE}📋 Restanti con conflitti: $remaining${NC}"

  log "SUMMARY ok=$ok err=$err skip=$skip none=$none remaining=$remaining"

  if [ "$DRY_RUN" = true ]; then
    echo -e "${YELLOW}🧪 DRY-RUN completato: nessuna modifica ai file.${NC}"
  elif [ "$remaining" -eq 0 ]; then
    echo -e "${GREEN}🎉 TUTTI I CONFLITTI SONO STATI RISOLTI (HEAD)!${NC}"
    echo -e "${GREEN}💾 Backup salvati in: ${BACKUP_DIR}${NC}"
    echo -e "${GREEN}📝 Log completo in: ${LOG_FILE}${NC}"
  else
    echo -e "${YELLOW}⚠️  Alcuni conflitti potrebbero essere rimasti.${NC}"
    echo -e "${YELLOW}💡 Esegui nuovamente lo script o risolvi manualmente i file rimanenti${NC}"
  fi

  return $([ "$err" -eq 0 ] && echo 0 || echo 1)
}

main "$@"

