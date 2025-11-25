#!/bin/bash

# Script per rimuovere file duplicati case-insensitive
# Mantiene solo la versione con naming corretto

set -e

DRY_RUN=false
LARAVEL_DIR="/var/www/_bases/base_fixcity_fila4_mono/laravel"

# Parse arguments
if [[ "$1" == "--dry-run" ]]; then
    DRY_RUN=true
    echo "🔍 DRY RUN MODE - Nessun file sarà eliminato"
fi

cd "$LARAVEL_DIR"

echo "🔍 Cerco file duplicati case-insensitive..."

# Array per tracciare file da eliminare
declare -a FILES_TO_DELETE

# Funzione per determinare quale file mantenere
should_keep_file() {
    local file="$1"
    local basename=$(basename "$file")
    
    # Mantieni file standard in MAIUSCOLO
    if [[ "$basename" =~ ^(README|ROADMAP|CHANGELOG|LICENSE|CONTRIBUTING|SECURITY)\.md$ ]]; then
        return 0  # Mantieni
    fi
    
    # Mantieni file PHP in PascalCase (inizia con maiuscola)
    if [[ "$basename" =~ \.php$ ]] && [[ "$basename" =~ ^[A-Z] ]]; then
        return 0  # Mantieni
    fi
    
    # Mantieni migrations (snake_case con date)
    if [[ "$basename" =~ ^[0-9]{4}_[0-9]{2}_[0-9]{2}_ ]]; then
        return 0  # Mantieni
    fi
    
    # Per altri .md, mantieni solo se tutto minuscolo
    if [[ "$basename" =~ \.md$ ]] && [[ "$basename" == "${basename,,}" ]]; then
        return 0  # Mantieni
    fi
    
    # Per blade, mantieni solo se tutto minuscolo
    if [[ "$basename" =~ \.blade\.php$ ]] && [[ "$basename" == "${basename,,}" ]]; then
        return 0  # Mantieni
    fi
    
    return 1  # Elimina
}

# Trova duplicati
find Modules -type f \( -name "*.php" -o -name "*.md" \) | while read -r file; do
    dir=$(dirname "$file")
    base=$(basename "$file")
    
    # Cerca duplicati case-insensitive
    duplicates=$(find "$dir" -maxdepth 1 -iname "$base" ! -name "$base" 2>/dev/null || true)
    
    if [[ -n "$duplicates" ]]; then
        # Abbiamo duplicati!
        echo ""
        echo "📁 Duplicati trovati in: $dir"
        echo "   - $base"
        
        while IFS= read -r dup; do
            dup_base=$(basename "$dup")
            echo "   - $dup_base"
            
            # Determina quale eliminare
            if should_keep_file "$file"; then
                # Mantieni $file, elimina $dup
                echo "   ✅ Mantieni: $base"
                echo "   ❌ Elimina: $dup_base"
                
                if [[ "$DRY_RUN" == false ]]; then
                    rm "$dup"
                    echo "   🗑️  Eliminato: $dup"
                fi
            elif should_keep_file "$dup"; then
                # Mantieni $dup, elimina $file
                echo "   ❌ Elimina: $base"
                echo "   ✅ Mantieni: $dup_base"
                
                if [[ "$DRY_RUN" == false ]]; then
                    rm "$file"
                    echo "   🗑️  Eliminato: $file"
                fi
            else
                # Entrambi non rispettano convenzioni - chiedi all'utente
                echo "   ⚠️  ATTENZIONE: Entrambi i file non rispettano le convenzioni!"
                echo "   ⚠️  Verifica manualmente: $dir"
            fi
        done <<< "$duplicates"
    fi
done

echo ""
if [[ "$DRY_RUN" == true ]]; then
    echo "✅ DRY RUN completato. Esegui senza --dry-run per eliminare i file."
else
    echo "✅ Pulizia completata!"
fi

echo ""
echo "📊 Riepilogo file rimanenti con possibili problemi:"
find Modules -type f -name "*.md" | grep -E "(readme|roadmap|changelog)" | grep -v -E "(README|ROADMAP|CHANGELOG)" | head -10 || echo "   Nessun problema trovato"
