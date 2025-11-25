#!/bin/bash

# Script robusto per risolvere conflitti Git mantenendo la "current change"
# Processa tutti i file con conflitti e li sistema

set -euo pipefail

# Colori
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[0;33m'
BLUE='\033[0;34m'
NC='\033[0m'

BASE_DIR="/var/www/_bases/base_quaeris_fila4_mono/laravel"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/var/www/_bases/base_quaeris_fila4_mono/bashscripts/backups/robust_fix_${TIMESTAMP}"

mkdir -p "$BACKUP_DIR"

echo -e "${BLUE}=== 🔧 RISOLUZIONE ROBUSTA CONFLITTI GIT ===${NC}"
echo -e "${YELLOW}Directory: $BASE_DIR${NC}"
echo -e "${YELLOW}Backup: $BACKUP_DIR${NC}"

# Trova tutti i file con conflitti
find "$BASE_DIR" -type f -name "*.php" -exec grep -l "^<<<<<<< " {} + 2>/dev/null | while read -r file; do
    echo -e "${YELLOW}🔧 Processando: $file${NC}"
    
    # Backup
    backup_file="$BACKUP_DIR/$(basename "$file").backup"
    cp "$file" "$backup_file"
    
    # Risolvi conflitti usando awk - mantieni la parte dopo =======
    awk '
    BEGIN { in_conflict = 0; skip = 0 }
    /^<<<<<<< / { in_conflict = 1; skip = 1; next }
    /^=======/ { if (in_conflict) { skip = 0; next } else { print } }
    /^>>>>>>> / { if (in_conflict) { in_conflict = 0; skip = 0; next } else { print } }
    { if (!in_conflict || (in_conflict && !skip)) print }
    ' "$file" > "$file.tmp" && mv "$file.tmp" "$file"
    
    # Verifica che non ci siano più conflitti
    if ! grep -q "^<<<<<<< " "$file" 2>/dev/null; then
        echo -e "${GREEN}✅ Risolto: $file${NC}"
    else
        echo -e "${RED}❌ Fallito: $file${NC}"
    fi
done

echo -e "\n${GREEN}=== COMPLETATO ===${NC}"

# Conteggio finale
remaining=$(find "$BASE_DIR" -type f -name "*.php" -exec grep -l "^<<<<<<< " {} + 2>/dev/null | wc -l)
echo -e "${YELLOW}Conflitti rimanenti: $remaining${NC}"
