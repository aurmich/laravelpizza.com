#!/bin/bash

# Script per normalizzare i nomi dei file .md nella documentazione
# Regole:
# - Solo minuscole (eccetto README.md)
# - No date nel nome
# - No caratteri maiuscoli
# - Focus su business logic, DRY + KISS

set -e

BASE_DIR="/var/www/_bases/base_ptvx_fila4_mono/laravel/Modules"
LOG_FILE="/tmp/docs_normalization_$(date +%Y%m%d_%H%M%S).log"

echo "=== Normalizzazione Documentazione ===" | tee -a "$LOG_FILE"
echo "Data: $(date)" | tee -a "$LOG_FILE"
echo "" | tee -a "$LOG_FILE"

# Funzione per convertire nome file in formato corretto
normalize_filename() {
    local filename="$1"
    local basename=$(basename "$filename")
    
    # Salta README.md
    if [ "$basename" = "README.md" ]; then
        echo "$basename"
        return
    fi
    
    # Converti in minuscolo
    local normalized=$(echo "$basename" | tr '[:upper:]' '[:lower:]')
    
    # Rimuovi date nel formato YYYY-MM-DD o YYYY_MM_DD
    normalized=$(echo "$normalized" | sed -E 's/-?[0-9]{4}[-_][0-9]{2}[-_][0-9]{2}-?//g')
    
    # Rimuovi date nel formato YYYYMMDD
    normalized=$(echo "$normalized" | sed -E 's/-?[0-9]{8}-?//g')
    
    # Rimuovi numeri isolati all'inizio o alla fine
    normalized=$(echo "$normalized" | sed -E 's/^[0-9]+-//g' | sed -E 's/-[0-9]+\.md$/.md/g')
    
    # Pulisci doppi trattini
    normalized=$(echo "$normalized" | sed -E 's/--+/-/g')
    
    # Rimuovi trattini iniziali/finali
    normalized=$(echo "$normalized" | sed -E 's/^-+//g' | sed -E 's/-+\.md$/.md/g')
    
    echo "$normalized"
}

# Trova tutti i file .md nelle cartelle docs
find "$BASE_DIR" -type f -name "*.md" -path "*/docs/*" | while read -r filepath; do
    dirname=$(dirname "$filepath")
    basename=$(basename "$filepath")
    
    # Salta README.md
    if [ "$basename" = "README.md" ]; then
        continue
    fi
    
    # Calcola nuovo nome
    new_basename=$(normalize_filename "$basename")
    
    # Se il nome è cambiato
    if [ "$basename" != "$new_basename" ]; then
        new_filepath="$dirname/$new_basename"
        
        # Se il file di destinazione esiste già, aggiungi suffisso
        if [ -f "$new_filepath" ] && [ "$filepath" != "$new_filepath" ]; then
            echo "CONFLITTO: $filepath -> $new_filepath (già esiste)" | tee -a "$LOG_FILE"
            # Aggiungi suffisso numerico
            counter=1
            while [ -f "${new_filepath%.md}-$counter.md" ]; do
                counter=$((counter + 1))
            done
            new_filepath="${new_filepath%.md}-$counter.md"
            echo "  Rinominato in: $new_filepath" | tee -a "$LOG_FILE"
        fi
        
        echo "RINOMINA: $basename -> $(basename $new_filepath)" | tee -a "$LOG_FILE"
        echo "  Path: $dirname" | tee -a "$LOG_FILE"
        
        # Esegui rinomina (commentato per sicurezza, rimuovi # per eseguire)
        # mv "$filepath" "$new_filepath"
    fi
done

echo "" | tee -a "$LOG_FILE"
echo "=== Analisi Completata ===" | tee -a "$LOG_FILE"
echo "Log salvato in: $LOG_FILE" | tee -a "$LOG_FILE"
echo "" | tee -a "$LOG_FILE"
echo "NOTA: Le rinominazioni sono commentate per sicurezza." | tee -a "$LOG_FILE"
echo "Rimuovi il commento dalla riga 'mv' per eseguire le rinominazioni." | tee -a "$LOG_FILE"
