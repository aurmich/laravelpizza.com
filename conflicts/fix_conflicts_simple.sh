#!/bin/bash

# Script semplice per risolvere conflitti Git
# Usa sempre la "current change" (dopo =======)

set -euo pipefail

# Colori
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[0;33m'
BLUE='\033[0;34m'
NC='\033[0m'

BASE_DIR="/var/www/_bases/base_quaeris_fila4_mono/laravel"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/var/www/_bases/base_quaeris_fila4_mono/bashscripts/backups/simple_fix_${TIMESTAMP}"

mkdir -p "$BACKUP_DIR"

echo -e "${BLUE}=== 🔧 RISOLUZIONE CONFLITTI GIT ===${NC}"
echo -e "${YELLOW}Directory: $BASE_DIR${NC}"
echo -e "${YELLOW}Backup: $BACKUP_DIR${NC}"

# Contatore
count=0

# Trova e risolvi i conflitti
find "$BASE_DIR" -type f -name "*.php" ! -path "*/vendor/*" ! -path "*/.git/*" | while read -r file; do
    if grep -q "^<<<<<<< " "$file" 2>/dev/null; then
        ((count++))
        echo -e "${YELLOW}[$count] Risoluzione: $file${NC}"
        
        # Backup
        cp "$file" "$BACKUP_DIR/$(basename "$file").backup"
        
        # Risolvi conflitto - mantieni solo la parte dopo =======
        awk '
        BEGIN { in_conflict = 0; keep = 0 }
        /^<<<<<<< / { in_conflict = 1; next }
        /^=======/ { if (in_conflict) keep = 1; next }
        /^>>>>>>> / { if (in_conflict) { in_conflict = 0; keep = 0 } next }
        { if (!in_conflict || keep) print }
        ' "$file" > "$file.tmp" && mv "$file.tmp" "$file"
        
        echo -e "${GREEN}✅ Fatto: $file${NC}"
    fi
done

echo -e "\n${GREEN}=== COMPLETATO ===${NC}"
echo -e "${GREEN}File processati: $count${NC}"
