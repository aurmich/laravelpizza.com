#!/bin/bash

# Script avanzato per risolvere merge conflicts complessi
# SuperMucca Advanced Conflict Resolver 🐄
# Gestisce conflitti multipli nello stesso file e casi edge

set -e

echo "🐄 SuperMucca ADVANCED Merge Conflict Resolver 🐄"
echo "================================================="
echo "Risoluzione avanzata dei conflitti Git..."
echo ""

# Colori
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
NC='\033[0m'

# Contatori
TOTAL_FILES=0
PROCESSED_FILES=0
SKIPPED_FILES=0
COMPLEX_CONFLICTS=0

WORK_DIR="/var/www/_bases/base_techplanner_fila3_mono/laravel"

# Funzione per processare conflitti complessi
process_complex_file() {
    local file="$1"
    local relative_path="${file#$WORK_DIR/}"
    local temp_file=$(mktemp)
    local in_conflict=false
    local conflict_count=0
    
    echo -e "${PURPLE}Processamento avanzato: ${relative_path}${NC}"
    
    # Backup
    cp "$file" "$file.advanced_backup"
    
    # Leggi il file linea per linea
    while IFS= read -r line; do
        if [[ "$line" == "<<<<<<< HEAD" ]]; then
            in_conflict=true
            ((conflict_count++))
            echo -e "${YELLOW}  Conflitto #${conflict_count} trovato${NC}"
            continue
        elif [[ "$line" == "=======" ]] && [ "$in_conflict" = true ]; then
            # Inizia la sezione incoming - la manteniamo
            continue
        elif [[ "$line" == ">>>>>>> filament4" ]] && [ "$in_conflict" = true ]; then
            in_conflict=false
            continue
        elif [ "$in_conflict" = true ] && [[ "$line" != "=======" ]]; then
            # Siamo nella sezione HEAD - la saltiamo
            continue
        else
            # Linea normale o parte incoming - la manteniamo
            echo "$line" >> "$temp_file"
        fi
    done < "$file"
    
    # Sostituisci il file originale
    mv "$temp_file" "$file"
    
    echo -e "${GREEN}✓ Risolti ${conflict_count} conflitti in: ${relative_path}${NC}"
    
    # Verifica finale
    if grep -q "<<<<<<< HEAD\|=======\|>>>>>>> filament4" "$file"; then
        echo -e "${RED}⚠ ATTENZIONE: Conflitti residui in: ${relative_path}${NC}"
        return 1
    fi
    
    return 0
}

# Funzione per analizzare la complessità dei conflitti
analyze_conflicts() {
    local file="$1"
    local head_count=$(grep -c "<<<<<<< HEAD" "$file" 2>/dev/null || echo "0")
    local sep_count=$(grep -c "=======" "$file" 2>/dev/null || echo "0")
    local end_count=$(grep -c ">>>>>>> filament4" "$file" 2>/dev/null || echo "0")
    
    if [ "$head_count" -ne "$sep_count" ] || [ "$sep_count" -ne "$end_count" ]; then
        echo "MALFORMED"
    elif [ "$head_count" -gt 1 ]; then
        echo "COMPLEX"
    elif [ "$head_count" -eq 1 ]; then
        echo "SIMPLE"
    else
        echo "NONE"
    fi
}

# Trova tutti i file con conflitti
echo -e "${BLUE}Analisi dei conflitti in corso...${NC}"
mapfile -t CONFLICT_FILES < <(find "$WORK_DIR" -type f -name "*.php" -exec grep -l "<<<<<<< HEAD" {} \;)

TOTAL_FILES=${#CONFLICT_FILES[@]}

if [ $TOTAL_FILES -eq 0 ]; then
    echo -e "${GREEN}🎉 Nessun conflitto trovato!${NC}"
    exit 0
fi

echo -e "${YELLOW}Trovati ${TOTAL_FILES} file con conflitti${NC}"
echo ""

# Analizza la complessità
echo -e "${BLUE}Analisi della complessità...${NC}"
SIMPLE_FILES=()
COMPLEX_FILES=()
MALFORMED_FILES=()

for file in "${CONFLICT_FILES[@]}"; do
    complexity=$(analyze_conflicts "$file")
    relative_path="${file#$WORK_DIR/}"
    
    case $complexity in
        "SIMPLE")
            SIMPLE_FILES+=("$file")
            echo -e "${GREEN}✓ Semplice: ${relative_path}${NC}"
            ;;
        "COMPLEX")
            COMPLEX_FILES+=("$file")
            echo -e "${YELLOW}⚠ Complesso: ${relative_path}${NC}"
            ;;
        "MALFORMED")
            MALFORMED_FILES+=("$file")
            echo -e "${RED}✗ Malformato: ${relative_path}${NC}"
            ;;
    esac
done

echo ""
echo -e "${BLUE}Riepilogo:${NC}"
echo -e "  File semplici: ${GREEN}${#SIMPLE_FILES[@]}${NC}"
echo -e "  File complessi: ${YELLOW}${#COMPLEX_FILES[@]}${NC}"
echo -e "  File malformati: ${RED}${#MALFORMED_FILES[@]}${NC}"
echo ""

# Chiedi conferma
read -p "Vuoi procedere con la risoluzione automatica? (y/N): " -n 1 -r
echo ""

if [[ ! $REPLY =~ ^[Yy]$ ]]; then
    echo -e "${YELLOW}Operazione annullata${NC}"
    exit 0
fi

echo ""
echo -e "${BLUE}Inizio risoluzione...${NC}"
echo ""

# Processa file semplici
if [ ${#SIMPLE_FILES[@]} -gt 0 ]; then
    echo -e "${GREEN}Processamento file semplici...${NC}"
    for file in "${SIMPLE_FILES[@]}"; do
        relative_path="${file#$WORK_DIR/}"
        echo -e "${YELLOW}Processando: ${relative_path}${NC}"
        
        if sed -i '/^<<<<<<< HEAD$/,/^=======$/d; /^>>>>>>> filament4$/d' "$file"; then
            echo -e "${GREEN}✓ Risolto: ${relative_path}${NC}"
            ((PROCESSED_FILES++))
        else
            echo -e "${RED}✗ Errore: ${relative_path}${NC}"
            ((SKIPPED_FILES++))
        fi
    done
    echo ""
fi

# Processa file complessi
if [ ${#COMPLEX_FILES[@]} -gt 0 ]; then
    echo -e "${PURPLE}Processamento file complessi...${NC}"
    for file in "${COMPLEX_FILES[@]}"; do
        if process_complex_file "$file"; then
            ((PROCESSED_FILES++))
            ((COMPLEX_CONFLICTS++))
        else
            ((SKIPPED_FILES++))
        fi
    done
    echo ""
fi

# Segnala file malformati
if [ ${#MALFORMED_FILES[@]} -gt 0 ]; then
    echo -e "${RED}File malformati (richiedono intervento manuale):${NC}"
    for file in "${MALFORMED_FILES[@]}"; do
        relative_path="${file#$WORK_DIR/}"
        echo -e "${RED}  ✗ ${relative_path}${NC}"
        ((SKIPPED_FILES++))
    done
    echo ""
fi

# Statistiche finali
echo "================================================="
echo -e "${GREEN}🐄 SuperMucca Advanced ha completato il lavoro! 🐄${NC}"
echo ""
echo -e "${BLUE}Statistiche finali:${NC}"
echo -e "  File totali: ${TOTAL_FILES}"
echo -e "  File risolti: ${GREEN}${PROCESSED_FILES}${NC}"
echo -e "  File complessi risolti: ${PURPLE}${COMPLEX_CONFLICTS}${NC}"
echo -e "  File saltati: ${RED}${SKIPPED_FILES}${NC}"
echo ""

if [ $PROCESSED_FILES -gt 0 ]; then
    echo -e "${GREEN}✓ Risoluzione completata con successo!${NC}"
    echo ""
    echo -e "${YELLOW}Comandi utili:${NC}"
    echo "  # Verifica lo stato"
    echo "  git status"
    echo ""
    echo "  # Controlla le modifiche"
    echo "  git diff"
    echo ""
    echo "  # Committa tutto"
    echo "  git add . && git commit -m 'Resolve all merge conflicts - accept filament4 changes'"
    echo ""
    echo "  # Test PHPStan"
    echo "  ./vendor/bin/phpstan analyze Modules --level=9"
    echo ""
    echo "  # Rimuovi i backup"
    echo "  find . -name '*.advanced_backup' -delete"
fi
