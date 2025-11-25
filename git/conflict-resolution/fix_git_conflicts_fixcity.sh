#!/bin/bash

# Script avanzato per risolvere automaticamente i conflitti Git scegliendo sempre la "current change"
# Progetto: FixCity
# Versione: 4.1 - Optimized Edition
#
# Questo script risolve tutti i conflitti Git scegliendo sempre la versione "current change"
# (contenuto tra ======= e >>>>>>>) invece della versione HEAD

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

# Directory di base - aggiornata per FixCity
BASE_DIR="/var/www/_bases/base_fixcity_fila4_mono"
SCRIPT_DIR="${BASE_DIR}/bashscripts"

# Opzioni
DRY_RUN=${DRY_RUN:-false}
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="${SCRIPT_DIR}/backup/conflicts_${TIMESTAMP}"
LOG_DIR="${SCRIPT_DIR}/logs"
mkdir -p "$LOG_DIR" "$BACKUP_DIR"
LOG_FILE="${LOG_DIR}/fix_conflicts_${TIMESTAMP}.log"

# Banner
echo -e "${BOLD}${BLUE}=== 🚀 FIXCITY - RISOLUZIONE AUTOMATICA CONFLITTI GIT ===${NC}"
echo -e "${BOLD}${BLUE}=== Strategia: CURRENT CHANGE (dopo =======) ===${NC}"
echo -e "${YELLOW}📁 Directory: ${BASE_DIR}${NC}"
echo -e "${YELLOW}📝 Log: ${LOG_FILE}${NC}"
echo -e "${YELLOW}💾 Backup: ${BACKUP_DIR}${NC}"
echo -e "${YELLOW}🧪 Dry-run: ${DRY_RUN}${NC}\n"

# Log helper
log() {
    echo "[$(date '+%F %T')] $*" >>"$LOG_FILE"
}

# Resolver AWK: tiene solo la sezione dopo ======= fino a >>>>>>>
resolve_with_current_change() {
    awk '
        BEGIN { state=0 }
        /^<<<<<<< / { state=1; next }
        /^=======/ { if(state==1) state=2; next }
        /^>>>>>>> / { if(state>0) state=0; next }
        { if(state==0 || state==2) print $0 }
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

    # Verifica presenza marker di conflitto
    if ! grep -q "^<<<<<<< " "$file" 2>/dev/null; then
        log "NO-CONFLICT $file"
        return 3
    fi

    local tmp="${file}.tmp.${RANDOM}"

    if [ "$DRY_RUN" = true ]; then
        # Solo verifica conversione
        if resolve_with_current_change <"$file" >"$tmp" 2>/dev/null; then
            local before after
            before=$(wc -l <"$file" 2>/dev/null | tr -d ' ')
            after=$(wc -l <"$tmp" 2>/dev/null | tr -d ' ')
            rm -f "$tmp"
            echo -e "${CYAN}🔎 DRY: $file (lines: ${before}→${after})${NC}"
            log "DRY $file ${before}->${after}"
            return 0
        else
            rm -f "$tmp"
            echo -e "${RED}❌ DRY err: $file${NC}"
            log "DRY-ERR $file"
            return 1
        fi
    fi

    # Backup e sovrascrittura
    local backup_file="${BACKUP_DIR}/$(basename "$file").backup"
    cp "$file" "$backup_file" 2>/dev/null || {
        echo -e "${RED}❌ Impossibile creare backup: $file${NC}"
        log "BACKUP-ERR $file"
        return 1
    }

    if resolve_with_current_change <"$file" >"$tmp" 2>/dev/null; then
        if mv "$tmp" "$file" 2>/dev/null; then
            echo -e "${GREEN}✅ Risolto: $file${NC}"
            log "FIXED $file"
            return 0
        else
            rm -f "$tmp"
            echo -e "${RED}❌ Errore sostituzione: $file${NC}"
            log "REPLACE-ERR $file"
            return 1
        fi
    else
        rm -f "$tmp"
        echo -e "${RED}❌ Errore processamento: $file${NC}"
        log "PROCESS-ERR $file"
        return 1
    fi
}

main() {
    log "START conflict resolver (dry=$DRY_RUN, base=$BASE_DIR)"

    # Trova tutti i file con marker di conflitto
    echo -e "${CYAN}🔍 Ricerca file con conflitti...${NC}"
    local files=()

    # Usa mapfile per popolare l'array in modo sicuro
    mapfile -d '' files < <(find "$BASE_DIR" -type f \
        ! -path "*/.git/*" \
        ! -path "*/vendor/*" \
        ! -path "*/node_modules/*" \
        ! -path "*/storage/*" \
        ! -path "*/bootstrap/cache/*" \
        -exec grep -IlZ "^<<<<<<< " {} + 2>/dev/null || true)

    local total=${#files[@]}
    local ok=0 err=0 skip=0 none=0

    if [ "$total" -eq 0 ]; then
        echo -e "${GREEN}🎉 Nessun file con conflitti trovato!${NC}"
        log "NO-CONFLICTS-FOUND"
        return 0
    fi

    echo -e "${CYAN}📋 Trovati $total file con marker di conflitto${NC}\n"

    for f in "${files[@]}"; do
        [ -z "$f" ] && continue

        echo -e "${YELLOW}🔧 $f${NC}"

        if process_file "$f"; then
            ((ok++)) || true
        else
            rc=$?
            case $rc in
                2) ((skip++)) || true;;
                3) ((none++)) || true;;
                *) ((err++)) || true;;
            esac
        fi
    done

    # Verifica residui
    echo -e "\n${BLUE}🔍 Verifica finale...${NC}"
    local remaining
    remaining=$(find "$BASE_DIR" -type f \
        ! -path "*/.git/*" \
        ! -path "*/vendor/*" \
        ! -path "*/node_modules/*" \
        -exec grep -l "^<<<<<<< " {} + 2>/dev/null | wc -l)

    # Riepilogo
    echo -e "\n${BOLD}${BLUE}=== 📊 RIEPILOGO ===${NC}"
    echo -e "${GREEN}✅ Risolti: $ok${NC}"
    echo -e "${RED}❌ Errori: $err${NC}"
    echo -e "${YELLOW}⏭️  Saltati (binari): $skip${NC}"
    echo -e "ℹ️  Senza conflitti: $none"
    echo -e "${BLUE}📋 Restanti con conflitti: $remaining${NC}"

    log "SUMMARY ok=$ok err=$err skip=$skip none=$none remaining=$remaining"

    if [ "$DRY_RUN" = true ]; then
        echo -e "\n${YELLOW}🧪 DRY-RUN completato: nessuna modifica ai file.${NC}"
        echo -e "${CYAN}💡 Rimuovi DRY_RUN=true per applicare le modifiche.${NC}"
    else
        echo -e "\n${GREEN}💾 Backup salvati in: ${BACKUP_DIR}${NC}"
        echo -e "${GREEN}📝 Log completo: ${LOG_FILE}${NC}"

        if [ "$remaining" -eq 0 ]; then
            echo -e "${GREEN}🎉 TUTTI I CONFLITTI SONO STATI RISOLTI!${NC}"
        else
            echo -e "${YELLOW}⚠️  Alcuni conflitti potrebbero richiedere risoluzione manuale${NC}"
        fi
    fi
}

main "$@"
