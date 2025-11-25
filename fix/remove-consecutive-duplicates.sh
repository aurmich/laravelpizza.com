#!/bin/bash
# Rimuove righe duplicate consecutive (conflitti mal risolti)

set -e

cd /var/www/_bases/base_ptvx_fila4_mono/laravel

echo "🔧 Rimozione righe duplicate consecutive..."

# File da processare (quelli con errori noti)
FILES=(
    "Modules/Xot/app/Datas/XotData.php"
    "Modules/Xot/app/Actions/Blade/RegisterBladeComponentsAction.php"
    "Modules/Xot/app/Actions/File/GetComponentsAction.php"
    "Modules/Xot/app/Providers/RouteServiceProvider.php"
    "Modules/Xot/app/Providers/Filament/XotBasePanelProvider.php"
)

BACKUP_DIR="../bashscripts/backups/dedup_$(date +%Y%m%d_%H%M%S)"
mkdir -p "$BACKUP_DIR"

for file in "${FILES[@]}"; do
    if [ ! -f "$file" ]; then
        echo "  ⏭️  Skip (non esiste): $file"
        continue
    fi
    
    echo "  🔧 Processing: $file"
    
    # Backup
    cp "$file" "$BACKUP_DIR/$(basename "$file").backup"
    
    # Rimuovi righe consecutive identiche con AWK
    awk '
    {
        if ($0 != prev) {
            print $0
        }
        prev = $0
    }
    ' "$file" > "$file.tmp"
    
    mv "$file.tmp" "$file"
    echo "    ✅ Done"
done

echo ""
echo "✅ Completato!"
echo "📁 Backup: $BACKUP_DIR"

