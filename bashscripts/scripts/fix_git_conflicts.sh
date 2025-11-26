#!/bin/bash

# Script per risolvere automaticamente i conflitti Git rimanenti
# Basato sulla business logic del progetto BashScripts Fila3

source ./lib/custom.sh

# Colori per output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

# Funzione per pulire un file dai conflitti Git
clean_git_conflicts() {
    local file="$1"
    local backup_file="${file}.backup"
    
    log "info" "Pulizia conflitti in: $file"
    
    # Crea backup
    cp "$file" "$backup_file"
    
    # Rimuovi marcatori di conflitto Git
    sed -i '/^<<<<<<< HEAD$/d' "$file"
    sed -i '/^=======$/d' "$file"
    sed -i '/^>>>>>>> .*$/d' "$file"
    
    # Rimuovi righe vuote multiple
    sed -i '/^$/N;/^\n$/d' "$file"
    
    log "success" "Conflitti rimossi da: $file"
}

# Funzione per risolvere conflitti in file JSON
fix_json_conflicts() {
    local file="$1"
    
    log "info" "Risoluzione conflitti JSON in: $file"
    
    # Se il file è vuoto o contiene solo marcatori di conflitto, crea un JSON valido
    if grep -q "^<<<<<<< HEAD" "$file" || grep -q "^=======" "$file"; then
        # Estrai il contenuto valido tra i marcatori
        local content=$(grep -v "^<<<<<<< HEAD" "$file" | grep -v "^=======" | grep -v "^>>>>>>> .*")
        
        # Se non c'è contenuto valido, crea un JSON vuoto
        if [ -z "$content" ]; then
            echo "{}" > "$file"
        else
            echo "$content" > "$file"
        fi
        
        log "success" "JSON corretto in: $file"
    fi
}

# Funzione per risolvere conflitti in file PHP
fix_php_conflicts() {
    local file="$1"
    
    log "info" "Risoluzione conflitti PHP in: $file"
    
    # Rimuovi marcatori di conflitto mantenendo il contenuto valido
    sed -i '/^<<<<<<< HEAD$/,/^=======$/d' "$file"
    sed -i '/^=======$/,/^>>>>>>> .*$/d' "$file"
    
    # Verifica sintassi PHP
    if php -l "$file" >/dev/null 2>&1; then
        log "success" "PHP sintatticamente corretto: $file"
    else
        log "warning" "Attenzione: sintassi PHP potrebbe essere errata in: $file"
    fi
}

# Funzione per risolvere conflitti in file Markdown
fix_markdown_conflicts() {
    local file="$1"
    
    log "info" "Risoluzione conflitti Markdown in: $file"
    
    # Per file Markdown, mantieni il contenuto più recente o completo
    if grep -q "^<<<<<<< HEAD" "$file"; then
        # Estrai il contenuto dopo =======
        sed -i '/^<<<<<<< HEAD$/,/^=======$/d' "$file"
        sed -i '/^=======$/,/^>>>>>>> .*$/d' "$file"
        
        log "success" "Markdown corretto in: $file"
    fi
}

# Funzione principale
main() {
    log "info" "🚀 Avvio risoluzione automatica conflitti Git"
    echo "=================================================="
    
    # Trova tutti i file con conflitti
    local conflict_files=($(grep -r "<<<<<<< HEAD" . --include="*.php" --include="*.json" --include="*.md" --include="*.sh" -l))
    
    if [ ${#conflict_files[@]} -eq 0 ]; then
        log "success" "✅ Nessun conflitto trovato!"
        exit 0
    fi
    
    log "info" "📦 Trovati ${#conflict_files[@]} file con conflitti"
    
    local fixed_count=0
    local error_count=0
    
    # Processa ogni file
    for file in "${conflict_files[@]}"; do
        log "info" "🔧 Elaborazione: $file"
        
        # Determina il tipo di file e applica la strategia appropriata
        case "$file" in
            *.json)
                fix_json_conflicts "$file"
                ;;
            *.php)
                fix_php_conflicts "$file"
                ;;
            *.md)
                fix_markdown_conflicts "$file"
                ;;
            *.sh)
                clean_git_conflicts "$file"
                ;;
            *)
                clean_git_conflicts "$file"
                ;;
        esac
        
        # Verifica se il file è ancora corrotto
        if grep -q "<<<<<<< HEAD" "$file"; then
            log "warning" "⚠️ Conflitti rimanenti in: $file (richiede intervento manuale)"
            error_count=$((error_count + 1))
        else
            fixed_count=$((fixed_count + 1))
        fi
    done
    
    # Riepilogo finale
    echo "=================================================="
    log "info" "📊 Riepilogo risoluzione conflitti:"
    echo "   ✅ File risolti: $fixed_count"
    echo "   ⚠️ File con conflitti rimanenti: $error_count"
    echo "   📦 File totali processati: ${#conflict_files[@]}"
    
    if [ $error_count -eq 0 ]; then
        log "success" "🎉 Tutti i conflitti sono stati risolti!"
        exit 0
    else
        log "warning" "⚠️ Alcuni file richiedono ancora intervento manuale"
        exit 1
    fi
}

# Verifica se lo script è stato chiamato direttamente
if [[ "${BASH_SOURCE[0]}" == "${0}" ]]; then
    main "$@"
fi
