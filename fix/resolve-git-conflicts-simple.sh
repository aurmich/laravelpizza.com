#!/bin/bash
# Script semplice e robusto per risolvere conflitti Git (keep current change)
# Esclude automaticamente vendor/ e node_modules/

set -e

cd /var/www/_bases/base_ptvx_fila4_mono/laravel

echo "🔍 Ricerca file con conflitti (escludendo vendor/ e node_modules/)..."

# Trova file con conflitti, escludendo directories non necessarie
FILES=$(grep -r "<<<<<<< " --files-with-matches 2>/dev/null | grep -v "^vendor/" | grep -v "^node_modules/" || true)

if [ -z "$FILES" ]; then
    echo "✅ Nessun conflitto trovato!"
    exit 0
fi

TOTAL=$(echo "$FILES" | wc -l)
echo "📋 Trovati $TOTAL file con conflitti"
echo ""

BACKUP_DIR="/var/www/_bases/base_ptvx_fila4_mono/bashscripts/backups/simple_$(date +%Y%m%d_%H%M%S)"
mkdir -p "$BACKUP_DIR"

COUNT=0
SUCCESS=0
FAILED=0

echo "$FILES" | while IFS= read -r file; do
    ((COUNT++))
    echo "[$COUNT/$TOTAL] 🔧 Processing: $file"
    
    # Backup
    cp "$file" "$BACKUP_DIR/$(basename "$file").backup" 2>/dev/null || {
        echo "  ❌ Backup failed"
        ((FAILED++))
        continue
    }
    
    # Risolvi con AWK (keep current = sezione dopo =======)
    awk '
    BEGIN { in_head=0; in_current=0 }
    /^<<<<<<< / { in_head=1; next }
    /^=======/ { in_head=0; in_current=1; next }
    /^>>>>>>> / { in_current=0; next }
    { if (!in_head) print }
    ' "$file" > "$file.tmp"
    
    # Verifica risultato
    if [ ! -s "$file.tmp" ]; then
        echo "  ❌ Risultato vuoto"
        rm -f "$file.tmp"
        ((FAILED++))
        continue
    fi
    
    if grep -q "<<<<<<< " "$file.tmp"; then
        echo "  ❌ Conflitti rimanenti"
        rm -f "$file.tmp"
        ((FAILED++))
        continue
    fi
    
    # Sostituisci
    mv "$file.tmp" "$file"
    echo "  ✅ Risolto"
    ((SUCCESS++))
done

echo ""
echo "📊 Riepilogo:"
echo "  Totale: $TOTAL"
echo "  Successo: $SUCCESS"
echo "  Falliti: $FAILED"
echo "  Backup: $BACKUP_DIR"

