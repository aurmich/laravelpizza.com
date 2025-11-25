#!/bin/bash

# Script per fixare gli accessor in SchedaTrait che devono salvare
# Fix: Aggiungere guard su getKey() prima di save()

FILE="/var/www/_bases/base_ptvx_fila4_mono/laravel/Modules/Sigma/app/Models/Traits/SchedaTrait.php"

# Backup del file originale
cp "$FILE" "${FILE}.backup"

# Applica il fix: cerca i pattern dove c'è il commento FIXED o REMOVED
# e aggiungi il guard su getKey() prima di attributes assignment

# Pattern da cercare: 
# - Righe con "// ⚠️ FIXED:" o "// ⚠️ REMOVED:"
# - Seguiti da $this->attributes[...]
# - Aggiungere prima: if ($this->getKey() === null) { return null; }
# - Aggiungere dopo: $this->save();

# Per ora stampiamo solo le linee da modificare
echo "Trovati questi accessor da fixare:"
grep -n "⚠️ FIXED\|⚠️ REMOVED" "$FILE" | head -20

echo ""
echo "File backup salvato in: ${FILE}.backup"
echo ""
echo "IMPORTANTE: Questo è uno script di analisi."
echo "Il fix verrà applicato manualmente per garantire accuratezza."

