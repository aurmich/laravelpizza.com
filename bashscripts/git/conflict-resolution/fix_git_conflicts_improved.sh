#!/bin/bash

# Script avanzato per risolvere automaticamente i conflitti Git scegliendo sempre la "current change"
# Versione migliorata: 5.0
#
# Questo script risolve tutti i conflitti Git scegliendo sempre la versione "current change"
# (contenuto tra ======= e >>>>>>>) invece della versione HEAD
# Aggiunge verifica sintassi PHP dopo la risoluzione

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

# Directory di base (aggiornata per questo progetto)
BASE_DIR="/var/www/_bases/base_quaeris_fila4_mono"
SCRIPT_DIR="/var/www/_bases/base_quaeris_fila4_mono/bashscripts"

# Opzioni
DRY_RUN=${DRY_RUN:-false}
CHECK_PHP_SYNTAX=${CHECK_PHP_SYNTAX:-true}
BACKUP_DIR="${SCRIPT_DIR}/backups/conflicts_current_change_$(date +%Y%m%d_%H%M%S)"
LOG_DIR="${SCRIPT_DIR}/logs"
mkdir -p "$LOG_DIR" "$BACKUP_DIR"
LOG_FILE="${LOG_DIR}/fix_conflicts_current_change_$(date +%Y%m%d_%H%M%S).log"

# Banner
echo -e "${BOLD}${BLUE}=== 🐄 SCRIPT SUPERMUCCA MIGLIORATO - RISOLUZIONE CONFLITTI GIT ===${NC}"
echo -e "${YELLOW}📁 Directory di lavoro: ${BASE_DIR}${NC}"
echo -e "${YELLOW}📝 Log: ${LOG_FILE}${NC}"
echo -e "${YELLOW}💾 Backup: ${BACKUP_DIR}${NC}"
echo -e "${YELLOW}🧪 Dry-run: ${DRY_RUN}${NC}"
echo -e "${YELLOW}🔍 Check sintassi PHP: ${CHECK_PHP_SYNTAX}${NC}\n"

# Log helper
log() { echo "[$(date '+%F %T')] $*" >>"$LOG_FILE"; }

# Verifica sintassi PHP
check_php_syntax() {
    local file="$1"
    if [[ "$file" == *.php ]] && [ "$CHECK_PHP_SYNTAX" = true ]; then
        if php -l "$file" >/dev/null 2>&1; then
            echo -e "${GREEN}✅ Sintassi PHP OK: $file${NC}"
            log "PHP-SYNTAX-OK $file"
            return 0
        else
            echo -e "${RED}❌ Errore sintassi PHP: $file${NC}"
            log "PHP-SYNTAX-ERROR $file"
            return 1
        fi
    fi
    return 0
}

# Resolver AWK: tiene solo la sezione dopo ======= fino a >>>>>>
resolve_with_current_change() {
  awk '
    BEGIN{state=0}
    /^<<<<<<< /{state=1; next}
    /^=======/{if(state==1) state=2; next}
    /^>>>>>>> /{if(state>0) state=0; next}
    { if(state==0 || state==2) print $0 }
  '
}

process_file() {
  local file="$1"

  # Salta binari
  if file --brief --mime "$file" 2>/dev/null | grep -qi "binary"; then
    echo -e "${YELLOW}⏭️  Binario: $file${NC}"; log "SKIP binary $file"; return 2
  fi

  # Verifica presenza marker
  if ! grep -q "^<<<<<<< " "$file"; then
    log "NO-CONFLICT $file"; return 3
  fi

  local tmp
  tmp="${file}.tmp.$RANDOM"

  if [ "$DRY_RUN" = true ]; then
    # Solo verifica conversione
    if resolve_with_current_change <"$file" >"$tmp"; then
      local before after
      before=$(wc -l <"$file" | tr -d ' ')
      after=$(wc -l <"$tmp" | tr -d ' ')
      rm -f "$tmp"
      echo -e "${CYAN}🔎 DRY: $file (lines: ${before}→${after})${NC}"; log "DRY $file ${before}->${after}"
      return 0
    else
      rm -f "$tmp"; echo -e "${RED}❌ DRY err: $file${NC}"; log "DRY-ERR $file"; return 1
    fi
  fi

  # Backup e sovrascrittura
  cp "$file" "${BACKUP_DIR}/$(basename "$file").backup"

  if resolve_with_current_change <"$file" >"$tmp"; then
    mv "$tmp" "$file"

    # Verifica sintassi PHP dopo la risoluzione
    if ! check_php_syntax "$file"; then
      # Ripristina backup se la sintassi PHP è errata
      cp "${BACKUP_DIR}/$(basename "$file").backup" "$file"
      echo -e "${RED}❌ Ripristinato backup per errore sintassi PHP: $file${NC}"
      log "RESTORED-BACKUP-PHP-ERROR $file"
      return 1
    fi

    echo -e "${GREEN}✅ Risolto: $file${NC}"; log "FIXED $file"
    return 0
  else
    rm -f "$tmp"; echo -e "${RED}❌ Errore: $file${NC}"; log "ERROR $file"; return 1
  fi
}

main() {
  log "START current-change resolver improved (dry=$DRY_RUN, check_php=$CHECK_PHP_SYNTAX)"

  # Costruisci lista file null-delimitata corretta
  mapfile -d '' files < <(find "$BASE_DIR" -type f \
    ! -path "*/.git/*" \
    -exec grep -IlZ "^<<<<<<< " {} + 2>/dev/null)

  local total=${#files[@]} ok=0 err=0 skip=0 none=0 php_err=0
  echo -e "${CYAN}📋 Trovati $total file con marker di conflitto${NC}"

  for f in "${files[@]}"; do
    echo -e "${YELLOW}🔧 $f${NC}"
    if process_file "$f"; then
      ((ok++)) || true
    else
      rc=$?
      case $rc in
        2) ((skip++)) || true;;
        3) ((none++)) || true;;
        4) ((php_err++)) || true;;
        *) ((err++)) || true;;
      esac
    fi
  done

  # Verifica residui
  local remaining
  remaining=$(find "$BASE_DIR" -type f ! -path "*/.git/*" -exec grep -l "^<<<<<<< " {} + 2>/dev/null | wc -l)

  echo -e "\n${BOLD}${BLUE}=== Riepilogo ===${NC}"
  echo -e "${GREEN}✅ Risolti: $ok${NC}  ${RED}❌ Errori: $err${NC}  ${YELLOW}⏭️  Skipped: $skip${NC}  ℹ️ No-conflict: $none"
  echo -e "${RED}🔴 Errori sintassi PHP: $php_err${NC}"
  echo -e "${BLUE}Restanti con conflitti: $remaining${NC}"
  log "SUMMARY ok=$ok err=$err skip=$skip none=$none php_err=$php_err remaining=$remaining"

  [ "$DRY_RUN" = true ] && echo -e "${YELLOW}DRY-RUN completato: nessuna modifica ai file.${NC}"

  if [ "$remaining" -gt 0 ]; then
    echo -e "${YELLOW}⚠️  Ci sono ancora $remaining file con conflitti non risolti${NC}"
  fi
}

main "$@"