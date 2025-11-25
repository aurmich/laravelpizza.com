#!/bin/bash

# =========================================================================
# Script per risolvere TUTTI i conflitti Git mantenendo HEAD (current version)
# Cerca direttamente i marker <<<<<<< HEAD in tutti i file
# =========================================================================

set -euo pipefail

# Colori
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[0;33m'
BLUE='\033[0;34m'
CYAN='\033[0;36m'
NC='\033[0m'

# Configurazione
BASE_DIR="${1:-/var/www/_bases/base_techplanner_fila4_mono/laravel}"
DRY_RUN="${DRY_RUN:-false}"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
LOG_FILE="${BASE_DIR}/../../bashscripts/logs/resolve_all_head_conflicts_${TIMESTAMP}.log"
BACKUP_DIR="${BASE_DIR}/../../bashscripts/backups/conflicts_head_${TIMESTAMP}"

mkdir -p "$(dirname "$LOG_FILE")"
mkdir -p "$BACKUP_DIR"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "$LOG_FILE"
}

echo -e "${BLUE}=== 🔧 Risoluzione Conflitti Git (HEAD Version) ===${NC}"
echo -e "${YELLOW}📁 Directory: ${BASE_DIR}${NC}"
echo -e "${YELLOW}📝 Log: ${LOG_FILE}${NC}"
echo -e "${YELLOW}💾 Backup: ${BACKUP_DIR}${NC}"
[ "$DRY_RUN" = "true" ] && echo -e "${CYAN}🧪 DRY-RUN MODE${NC}"
echo ""

log "START: Risoluzione conflitti HEAD in ${BASE_DIR}"

# Trova tutti i file con marker di conflitto
echo -e "${BLUE}🔍 Ricerca file con conflitti...${NC}"
mapfile -t conflicted_files < <(
    find "$BASE_DIR" -type f \( \
        -name "*.php" -o \
        -name "*.js" -o \
        -name "*.ts" -o \
        -name "*.blade.php" -o \
        -name "*.json" -o \
        -name "*.md" -o \
        -name "*.yml" -o \
        -name "*.yaml" -o \
        -name "*.sh" -o \
        -name "*.txt" \
    \) -exec grep -l "^<<<<<<< HEAD" {} + 2>/dev/null | sort
)

total=${#conflicted_files[@]}

if [ "$total" -eq 0 ]; then
    echo -e "${GREEN}✅ Nessun file con conflitti trovato!${NC}"
    log "SUCCESS: Nessun conflitto trovato"
    exit 0
fi

echo -e "${CYAN}📋 Trovati $total file con conflitti${NC}"
log "Found $total files with conflicts"

# Contatori
resolved=0
failed=0
skipped=0

# Processa ogni file
for i in "${!conflicted_files[@]}"; do
    file="${conflicted_files[$i]}"
    file_num=$((i + 1))
    rel_path="${file#$BASE_DIR/}"
    
    echo -e "${YELLOW}[$file_num/$total] 🔧 $rel_path${NC}"
    log "Processing: $rel_path"
    
    # Verifica file
    if [ ! -f "$file" ] || [ ! -r "$file" ]; then
        echo -e "${RED}  ❌ File non accessibile${NC}"
        ((skipped++))
        continue
    fi
    
    # Salta file binari
    if file --brief --mime "$file" 2>/dev/null | grep -qi "binary"; then
        echo -e "${YELLOW}  ⏭️  File binario saltato${NC}"
        ((skipped++))
        continue
    fi
    
    # Conta conflitti
    conflicts=$(grep -c "^<<<<<<< HEAD" "$file" 2>/dev/null || echo "0")
    
    if [ "$conflicts" -eq 0 ]; then
        echo -e "${CYAN}  ℹ️  Nessun conflitto${NC}"
        ((skipped++))
        continue
    fi
    
    echo -e "${CYAN}  📊 Conflitti trovati: $conflicts${NC}"
    
    # Backup
    backup_file="${BACKUP_DIR}/${rel_path//\//_}"
    mkdir -p "$(dirname "$backup_file")"
    cp "$file" "$backup_file" 2>/dev/null || true
    
    if [ "$DRY_RUN" = "true" ]; then
        echo -e "${CYAN}  🧪 DRY-RUN: sarebbe risolto${NC}"
        ((resolved++))
        continue
    fi
    
    # Risolvi conflitti mantenendo HEAD (prima di =======)
    # Gestisce conflitti annidati processando iterativamente
    temp_file="${file}.tmp.$$"
    max_iterations=50
    iteration=0
    current_file="$file"
    
    # Processa iterativamente fino a quando non ci sono più conflitti
    while [ $iteration -lt $max_iterations ]; do
        awk '
        BEGIN { 
            in_head = 0;
            in_incoming = 0;
        }
        /^<<<<<<< HEAD/ { 
            in_head = 1;
            in_incoming = 0;
            next;
        }
        /^=======/ {
            in_head = 0;
            in_incoming = 1;
            next;
        }
        /^>>>>>>> / {
            in_head = 0;
            in_incoming = 0;
            next;
        }
        {
            if (in_head == 1) {
                print;
            } else if (in_incoming == 0 && in_head == 0) {
                print;
            }
        }
        ' "$current_file" > "$temp_file"
        
        # Verifica se ci sono ancora conflitti
        if ! grep -q "^<<<<<<< HEAD" "$temp_file" 2>/dev/null; then
            break
        fi
        
        # Se ci sono ancora conflitti, continua con l'iterazione successiva
        if [ "$current_file" != "$file" ]; then
            rm -f "$current_file"
        fi
        mv "$temp_file" "${temp_file}.iter"
        current_file="${temp_file}.iter"
        iteration=$((iteration + 1))
    done
    
    # Usa il file finale
    if [ -f "${temp_file}.iter" ]; then
        mv "${temp_file}.iter" "$temp_file"
    elif [ -f "$temp_file" ]; then
        # File già corretto
        :
    else
        # Nessun file prodotto, errore
        temp_file=""
    fi
    
    # Pulisci file temporanei
    rm -f "${file}.tmp.iter"* 2>/dev/null || true
    
    # Verifica risultato
    if [ -s "$temp_file" ]; then
        # Verifica che non ci siano più marker
        if grep -q "^<<<<<<< HEAD" "$temp_file" 2>/dev/null; then
            remaining=1
        else
            remaining=0
        fi
        
        if [ "$remaining" -eq 0 ]; then
            mv "$temp_file" "$file"
            echo -e "${GREEN}  ✅ Risolti $conflicts conflitti${NC}"
            log "SUCCESS: Resolved $conflicts conflicts in $rel_path"
            ((resolved++))
        else
            rm -f "$temp_file"
            echo -e "${RED}  ❌ Conflitti rimanenti dopo risoluzione${NC}"
            log "ERROR: Remaining conflicts in $rel_path"
            ((failed++))
        fi
    else
        rm -f "$temp_file"
        echo -e "${RED}  ❌ File vuoto dopo risoluzione${NC}"
        log "ERROR: Empty file after resolution: $rel_path"
        # Ripristina backup
        cp "$backup_file" "$file" 2>/dev/null || true
        ((failed++))
    fi
done

# Verifica finale
echo -e "\n${BLUE}🔍 Verifica finale...${NC}"
remaining=$(find "$BASE_DIR" -type f \( \
    -name "*.php" -o -name "*.js" -o -name "*.ts" -o -name "*.blade.php" \
    -o -name "*.json" -o -name "*.md" -o -name "*.yml" -o -name "*.yaml" \
    -o -name "*.sh" -o -name "*.txt" \
\) -exec grep -l "^<<<<<<< HEAD" {} + 2>/dev/null | wc -l)

# Riepilogo
echo -e "\n${BLUE}=== 📊 RIEPILOGO ===${NC}"
echo -e "${CYAN}📁 File totali: $total${NC}"
echo -e "${GREEN}✅ Risolti: $resolved${NC}"
echo -e "${YELLOW}⏭️  Saltati: $skipped${NC}"
echo -e "${RED}❌ Errori: $failed${NC}"
echo -e "${YELLOW}📋 Conflitti rimanenti: $remaining${NC}"

log "SUMMARY: Total=$total Resolved=$resolved Skipped=$skipped Failed=$failed Remaining=$remaining"

if [ "$remaining" -eq 0 ]; then
    echo -e "${GREEN}🎉 TUTTI I CONFLITTI RISOLTI!${NC}"
    log "SUCCESS: All conflicts resolved"
    exit 0
elif [ "$resolved" -gt 0 ]; then
    echo -e "${GREEN}✅ $resolved file risolti, $remaining rimanenti${NC}"
    log "PARTIAL: $resolved files resolved, $remaining remaining"
    exit 0
else
    echo -e "${YELLOW}⚠️  Nessun file risolto${NC}"
    log "WARNING: No files resolved"
    exit 1
fi

