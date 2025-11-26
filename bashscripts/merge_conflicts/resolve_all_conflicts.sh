#!/bin/bash

# Script per risolvere automaticamente tutti i merge conflicts
# Prende sempre le "incoming changes" (filament4 branch)
# Creato da SuperMucca AI Assistant 🐄

set -e

echo "🐄 SuperMucca Merge Conflict Resolver 🐄"
echo "========================================"
echo "Risoluzione automatica dei conflitti Git..."
echo "Strategia: Accetta sempre le INCOMING CHANGES (filament4)"
echo ""

# Colori per output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Contatori
TOTAL_FILES=0
PROCESSED_FILES=0
SKIPPED_FILES=0

# Directory di lavoro
WORK_DIR="/var/www/_bases/base_techplanner_fila3_mono/laravel"

echo -e "${BLUE}Directory di lavoro: ${WORK_DIR}${NC}"
echo ""

# Funzione per processare un singolo file
process_file() {
    local file="$1"
    local relative_path="${file#$WORK_DIR/}"
    
    echo -e "${YELLOW}Processando: ${relative_path}${NC}"
    
    # Backup del file originale
    cp "$file" "$file.backup"
    
    # Usa sed per rimuovere i conflict markers e tenere solo le incoming changes
    # Strategia:
    # 1. Rimuove tutto dalla linea "<<<<<<< HEAD" fino alla linea "======="
    # 2. Rimuove la linea ">>>>>>> filament4"
    # 3. Mantiene tutto quello che sta tra "=======" e ">>>>>>> filament4"
    
    if sed -i '/^<<<<<<< HEAD$/,/^=======$/d; /^>>>>>>> filament4$/d' "$file"; then
        echo -e "${GREEN}✓ Risolto: ${relative_path}${NC}"
        ((PROCESSED_FILES++))
        
        # Verifica che il file non abbia più conflitti
        if grep -q "<<<<<<< HEAD\|=======\|>>>>>>> filament4" "$file"; then
            echo -e "${RED}⚠ ATTENZIONE: Il file potrebbe avere ancora conflitti: ${relative_path}${NC}"
        fi
    else
        echo -e "${RED}✗ Errore nel processare: ${relative_path}${NC}"
        # Ripristina il backup in caso di errore
        mv "$file.backup" "$file"
        ((SKIPPED_FILES++))
    fi
}

# Trova tutti i file con conflitti
echo -e "${BLUE}Ricerca dei file con conflitti...${NC}"
mapfile -t CONFLICT_FILES < <(find "$WORK_DIR" -type f -name "*.php" -exec grep -l "<<<<<<< HEAD" {} \;)

TOTAL_FILES=${#CONFLICT_FILES[@]}

if [ $TOTAL_FILES -eq 0 ]; then
    echo -e "${GREEN}🎉 Nessun conflitto trovato! Tutto pulito!${NC}"
    exit 0
fi

echo -e "${YELLOW}Trovati ${TOTAL_FILES} file con conflitti${NC}"
echo ""

# Chiedi conferma
read -p "Vuoi procedere con la risoluzione automatica? (y/N): " -n 1 -r
echo ""

if [[ ! $REPLY =~ ^[Yy]$ ]]; then
    echo -e "${YELLOW}Operazione annullata dall'utente${NC}"
    exit 0
fi

echo ""
echo -e "${BLUE}Inizio processamento...${NC}"
echo ""

# Processa ogni file
for file in "${CONFLICT_FILES[@]}"; do
    process_file "$file"
done

echo ""
echo "========================================"
echo -e "${GREEN}🐄 SuperMucca ha finito il lavoro! 🐄${NC}"
echo ""
echo -e "${BLUE}Statistiche:${NC}"
echo -e "  File totali trovati: ${TOTAL_FILES}"
echo -e "  File processati: ${GREEN}${PROCESSED_FILES}${NC}"
echo -e "  File saltati/errori: ${RED}${SKIPPED_FILES}${NC}"
echo ""

if [ $PROCESSED_FILES -gt 0 ]; then
    echo -e "${GREEN}✓ Conflitti risolti con successo!${NC}"
    echo ""
    echo -e "${YELLOW}Prossimi passi suggeriti:${NC}"
    echo "1. Controlla i file modificati:"
    echo "   git status"
    echo ""
    echo "2. Verifica che tutto sia corretto:"
    echo "   git diff --cached"
    echo ""
    echo "3. Committa le modifiche:"
    echo "   git add ."
    echo "   git commit -m 'Resolve merge conflicts - accept filament4 changes'"
    echo ""
    echo "4. Esegui i test:"
    echo "   ./vendor/bin/phpstan analyze Modules --level=9"
    echo ""
fi

if [ $SKIPPED_FILES -gt 0 ]; then
    echo -e "${RED}⚠ Alcuni file potrebbero necessitare di attenzione manuale${NC}"
    echo "Controlla i file .backup per vedere le versioni originali"
fi

echo ""
echo -e "${BLUE}File di backup creati con estensione .backup${NC}"
echo -e "${BLUE}Puoi rimuoverli con: find $WORK_DIR -name '*.backup' -delete${NC}"
