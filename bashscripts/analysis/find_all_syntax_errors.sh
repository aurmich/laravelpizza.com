#!/bin/bash

# Script per trovare TUTTI i file PHP con errori di sintassi

BASE_DIR="/var/www/_bases/base_ptvx_fila4_mono/laravel"
OUTPUT_FILE="/var/www/_bases/base_ptvx_fila4_mono/bashscripts/logs/syntax_errors_$(date +%Y%m%d_%H%M%S).txt"

echo "=== Scansione Errori Sintassi PHP ===" | tee "$OUTPUT_FILE"
echo "Timestamp: $(date)" | tee -a "$OUTPUT_FILE"
echo "Directory: $BASE_DIR" | tee -a "$OUTPUT_FILE"
echo "" | tee -a "$OUTPUT_FILE"

errors=0
total=0

while IFS= read -r -d '' file; do
    ((total++))
    if ! php -l "$file" >/dev/null 2>&1; then
        ((errors++))
        echo "❌ ERRORE #$errors: $file" | tee -a "$OUTPUT_FILE"
        php -l "$file" 2>&1 | grep -A 2 "error" | tee -a "$OUTPUT_FILE"
        echo "" | tee -a "$OUTPUT_FILE"
    fi
done < <(find "$BASE_DIR/Modules" -name "*.php" -type f ! -path "*/vendor/*" ! -path "*/node_modules/*" -print0)

echo "=== RIEPILOGO ===" | tee -a "$OUTPUT_FILE"
echo "File controllati: $total" | tee -a "$OUTPUT_FILE"
echo "File con errori: $errors" | tee -a "$OUTPUT_FILE"
echo "Log salvato in: $OUTPUT_FILE" | tee -a "$OUTPUT_FILE"

exit $errors

