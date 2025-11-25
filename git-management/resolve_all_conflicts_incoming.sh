#!/bin/bash
# ==============================================================================
# Script per Risoluzione Conflitti Git - Strategia INCOMING (Supermucca Edition)
# ==============================================================================
# Risolve TUTTI i conflitti Git scegliendo sempre la versione "incoming" 
# (la nuova versione in arrivo dopo il separatore =======)
#
# Autore: AI Assistant + Laraxot Team
# Versione: 6.0 - Supermucca Edition per Quaeris
# Data: 2025-10-22
# ==============================================================================

set -euo pipefail
IFS=$'\n\t'

# Colori
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[0;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
CYAN='\033[0;36m'
BOLD='\033[1m'
NC='\033[0m' # No Color

# Configurazione
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/../.." && pwd)"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
LOG_FILE="${SCRIPT_DIR}/../logs/resolve_conflicts_${TIMESTAMP}.log"
BACKUP_DIR="${SCRIPT_DIR}/../backups/conflicts_${TIMESTAMP}"
TARGET_DIR="${1:-${PROJECT_ROOT}/laravel/Modules}"

# Crea directory
mkdir -p "$(dirname "$LOG_FILE")" "$BACKUP_DIR"

# Banner
clear
echo -e "${BOLD}${BLUE}╔══════════════════════════════════════════════════════════════╗${NC}"
echo -e "${BOLD}${BLUE}║   🐄 SUPERMUCCA GIT CONFLICT RESOLVER v6.0                  ║${NC}"
echo -e "${BOLD}${BLUE}║   Strategia: INCOMING (prende sempre la nuova versione)     ║${NC}"
echo -e "${BOLD}${BLUE}╚══════════════════════════════════════════════════════════════╝${NC}"
echo ""
echo -e "${CYAN}📁 Directory target:  $TARGET_DIR${NC}"
echo -e "${CYAN}💾 Backup directory:  $BACKUP_DIR${NC}"
echo -e "${CYAN}📝 Log file:          $LOG_FILE${NC}"
echo ""

# Inizializza log
{
    echo "=== SUPERMUCCA GIT CONFLICT RESOLVER v6.0 ==="
    echo "Date: $(date '+%Y-%m-%d %H:%M:%S')"
    echo "Target: $TARGET_DIR"
    echo "Strategy: INCOMING (prende nuova versione dopo =======)"
    echo ""
} > "$LOG_FILE"

# Contatori
TOTAL_FILES=0
RESOLVED_FILES=0
FAILED_FILES=0
TOTAL_CONFLICTS=0

# Funzione per risolvere conflitti in un file (strategia INCOMING)
resolve_file_incoming() {
    local file="$1"
    local temp_file="${file}.tmp.$$"
    
    # Backup
    mkdir -p "$BACKUP_DIR/$(dirname "$file")"
    cp "$file" "$BACKUP_DIR/$file" 2>/dev/null || true
    
    # Risolvi usando awk (prende solo la parte DOPO =======)
    awk '
    BEGIN { 
        in_conflict = 0
        keep_line = 1
    }
    
    /^<<<<<<< / {
        in_conflict = 1
        keep_line = 0
        next
    }
    
    /^=======/ {
        if (in_conflict) {
            keep_line = 1
        }
        next
    }
    
    /^>>>>>>> / {
        if (in_conflict) {
            in_conflict = 0
            keep_line = 1
        }
        next
    }
    
    {
        if (keep_line || in_conflict == 0) {
            print $0
        }
    }
    ' "$file" > "$temp_file"
    
    # Sostituisci file
    if [ -s "$temp_file" ]; then
        mv "$temp_file" "$file"
        return 0
    else
        rm -f "$temp_file"
        return 1
    fi
}

# Trova e risolvi tutti i file
echo -e "${YELLOW}🔍 Ricerca file con conflitti...${NC}"
echo ""

while IFS= read -r -d '' file; do
    ((TOTAL_FILES++))
    relative_path="${file#${TARGET_DIR}/}"
    
    echo -e "${YELLOW}[$TOTAL_FILES] 🔧 Elaborazione: $relative_path${NC}"
    
    conflicts_before=$(grep -c "^<<<<<<< " "$file" 2>/dev/null || echo "0")
    
    if resolve_file_incoming "$file"; then
        conflicts_after=$(grep -c "^<<<<<<< " "$file" 2>/dev/null || echo "0")
        
        if [ "$conflicts_after" -eq 0 ]; then
            echo -e "${GREEN}   ✅ Risolti $conflicts_before conflitti${NC}"
            ((RESOLVED_FILES++))
            TOTAL_CONFLICTS=$((TOTAL_CONFLICTS + conflicts_before))
            echo "$(date '+%H:%M:%S') ✅ RISOLTO: $file ($conflicts_before conflitti)" >> "$LOG_FILE"
        else
            echo -e "${YELLOW}   ⚠️  Alcuni conflitti rimanenti: $conflicts_after${NC}"
            echo "$(date '+%H:%M:%S') ⚠️  PARZIALE: $file (rimanenti: $conflicts_after)" >> "$LOG_FILE"
        fi
    else
        ((FAILED_FILES++))
        echo -e "${RED}   ❌ Errore durante risoluzione${NC}"
        echo "$(date '+%H:%M:%S') ❌ ERRORE: $file" >> "$LOG_FILE"
    fi
done < <(find "$TARGET_DIR" -type f -name "*.php" \
    ! -path "*/vendor/*" \
    ! -path "*/node_modules/*" \
    ! -path "*/.git/*" \
    -exec grep -lZ "^<<<<<<< " {} + 2>/dev/null)

# Riepilogo
echo ""
echo -e "${BOLD}${BLUE}╔══════════════════════════════════════════════════════════════╗${NC}"
echo -e "${BOLD}${BLUE}║                  RISULTATO FINALE                            ║${NC}"
echo -e "${BOLD}${BLUE}╚══════════════════════════════════════════════════════════════╝${NC}"
echo ""
echo -e "${BLUE}📁 File totali processati:    ${BOLD}$TOTAL_FILES${NC}"
echo -e "${GREEN}✅ File risolti con successo:  ${BOLD}$RESOLVED_FILES${NC}"
echo -e "${RED}❌ File con errori:            ${BOLD}$FAILED_FILES${NC}"
echo -e "${PURPLE}🔧 Conflitti totali risolti:   ${BOLD}$TOTAL_CONFLICTS${NC}"
echo ""

# Verifica finale
remaining=$(find "$TARGET_DIR" -type f -name "*.php" \
    ! -path "*/vendor/*" \
    ! -path "*/node_modules/*" \
    -exec grep -l "^<<<<<<< " {} + 2>/dev/null | wc -l)

if [ "$remaining" -eq 0 ]; then
    echo -e "${BOLD}${GREEN}🎉 SUCCESSO! Tutti i conflitti PHP sono stati risolti!${NC}"
else
    echo -e "${BOLD}${YELLOW}⚠️  Rimangono $remaining file PHP con conflitti${NC}"
fi

echo ""
echo -e "${CYAN}💾 Backup salvati in: $BACKUP_DIR${NC}"
echo -e "${CYAN}📝 Log completo:      $LOG_FILE${NC}"
echo ""

# Riepilogo nel log
{
    echo ""
    echo "=== RIEPILOGO FINALE ==="
    echo "File processati: $TOTAL_FILES"
    echo "File risolti: $RESOLVED_FILES"
    echo "File con errori: $FAILED_FILES"
    echo "Conflitti risolti: $TOTAL_CONFLICTS"
    echo "Conflitti rimanenti: $remaining"
} >> "$LOG_FILE"

[ "$remaining" -eq 0 ] && exit 0 || exit 1







