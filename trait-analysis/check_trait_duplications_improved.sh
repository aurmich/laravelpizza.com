#!/bin/bash

# Script migliorato per verificare duplicazioni di trait nelle catene di ereditarietà
# Versione: 2.0
# Data: $(date +%Y-%m-%d)
# Autore: TechPlanner Team

set -e

# Configurazione
LARAVEL_DIR="/var/www/_bases/base_techplanner_fila4_mono/laravel"
MODULES_DIR="$LARAVEL_DIR/Modules"
OUTPUT_FILE="$(pwd)/trait_collisions_report_$(date +%Y%m%d_%H%M%S).txt"

# Colori per output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}🔍 Controllo duplicazioni trait nelle catene di ereditarietà...${NC}"
echo -e "${BLUE}================================================================${NC}"
echo -e "${YELLOW}📁 Directory Laravel: $LARAVEL_DIR${NC}"
echo -e "${YELLOW}📁 Directory Moduli: $MODULES_DIR${NC}"
echo -e "${YELLOW}📄 File report: $OUTPUT_FILE${NC}"
echo ""

ERRORS_FOUND=0
WARNINGS_FOUND=0
MODULES_CHECKED=0

# Trait comuni da verificare
COMMON_TRAITS=("HasFactory" "SoftDeletes" "BelongsToTenant" "Updater" "LogsActivity" "HasMedia" "HasUuid" "HasProfile")

# Inizia il report
echo "Report Duplicazioni Trait - $(date)" > "$OUTPUT_FILE"
echo "========================================" >> "$OUTPUT_FILE"
echo "" >> "$OUTPUT_FILE"

for module_dir in "$MODULES_DIR"/*; do
    if [ ! -d "$module_dir" ]; then
        continue
    fi

    MODULE_NAME=$(basename "$module_dir")
    MODELS_DIR="$module_dir/app/Models"

    if [ ! -d "$MODELS_DIR" ]; then
        echo -e "${YELLOW}⚠️  Modulo $MODULE_NAME: Directory Models non trovata${NC}" | tee -a "$OUTPUT_FILE"
        continue
    fi

    MODULES_CHECKED=$((MODULES_CHECKED + 1))
    echo -e "${BLUE}📦 Controllo modulo: $MODULE_NAME${NC}" | tee -a "$OUTPUT_FILE"

    # Trova BaseModel del modulo
    BASE_MODEL="$MODELS_DIR/BaseModel.php"

    if [ ! -f "$BASE_MODEL" ]; then
        echo -e "${YELLOW}   ⚠️  BaseModel.php non trovato${NC}" | tee -a "$OUTPUT_FILE"
        continue
    fi

    # Estrai trait dal BaseModel in modo più robusto
    BASE_TRAITS=$(grep -o "use [A-Za-z][A-Za-z0-9_\\\\]*;" "$BASE_MODEL" 2>/dev/null | \
                 grep -v "namespace\|class\|function\|interface\|trait" | \
                 sed 's/use //g' | sed 's/;//g' | sed 's/.*\\//' | tr '\n' ' ')

    if [ -z "$BASE_TRAITS" ]; then
        echo -e "${YELLOW}   ℹ️  Nessun trait trovato in BaseModel${NC}" | tee -a "$OUTPUT_FILE"
    else
        echo -e "   📋 Trait in BaseModel: $BASE_TRAITS" | tee -a "$OUTPUT_FILE"
    fi

    MODULE_ERRORS=0
    MODULE_WARNINGS=0

    # Verifica ogni modello figlio
    for model_file in "$MODELS_DIR"/*.php; do
        if [ ! -f "$model_file" ]; then
            continue
        fi

        MODEL_NAME=$(basename "$model_file" .php)

        # Salta BaseModel e file che non sono modelli
        if [[ "$MODEL_NAME" == "BaseModel" || "$MODEL_NAME" == *"Test"* ]]; then
            continue
        fi

        # Verifica se estende BaseModel o una classe base
        if ! grep -q "extends.*Base" "$model_file" && ! grep -q "extends.*Model" "$model_file"; then
            continue
        fi

        # Verifica duplicazioni trait
        for trait in $BASE_TRAITS; do
            if grep -q "use.*$trait" "$model_file"; then
                echo -e "   ${RED}❌ $MODEL_NAME.php: Duplicazione trait '$trait'${NC}" | tee -a "$OUTPUT_FILE"
                ERRORS_FOUND=$((ERRORS_FOUND + 1))
                MODULE_ERRORS=$((MODULE_ERRORS + 1))
            fi
        done

        # Verifica metodo newFactory() duplicato se HasFactory è in BaseModel
        if echo "$BASE_TRAITS" | grep -q "HasFactory"; then
            if grep -q "function newFactory" "$model_file"; then
                echo -e "   ${RED}❌ $MODEL_NAME.php: Metodo newFactory() duplicato${NC}" | tee -a "$OUTPUT_FILE"
                ERRORS_FOUND=$((ERRORS_FOUND + 1))
                MODULE_ERRORS=$((MODULE_ERRORS + 1))
            fi
        fi

        # Verifica trait comuni non in BaseModel ma nel modello figlio
        for trait in "${COMMON_TRAITS[@]}"; do
            if echo "$BASE_TRAITS" | grep -q "$trait"; then
                continue  # Già controllato sopra
            fi

            if grep -q "use.*$trait" "$model_file"; then
                echo -e "   ${YELLOW}⚠️  $MODEL_NAME.php: Trait '$trait' dovrebbe essere in BaseModel${NC}" | tee -a "$OUTPUT_FILE"
                WARNINGS_FOUND=$((WARNINGS_FOUND + 1))
                MODULE_WARNINGS=$((MODULE_WARNINGS + 1))
            fi
        done
    done

    if [ "$MODULE_ERRORS" -eq 0 ] && [ "$MODULE_WARNINGS" -eq 0 ]; then
        echo -e "   ${GREEN}✅ Modulo $MODULE_NAME: Nessuna duplicazione trait${NC}" | tee -a "$OUTPUT_FILE"
    elif [ "$MODULE_ERRORS" -eq 0 ] && [ "$MODULE_WARNINGS" -gt 0 ]; then
        echo -e "   ${YELLOW}⚠️  Modulo $MODULE_NAME: $MODULE_WARNINGS warning(s)${NC}" | tee -a "$OUTPUT_FILE"
    else
        echo -e "   ${RED}❌ Modulo $MODULE_NAME: $MODULE_ERRORS errore(i), $MODULE_WARNINGS warning(s)${NC}" | tee -a "$OUTPUT_FILE"
    fi

    echo "" | tee -a "$OUTPUT_FILE"
done

# Report finale
echo -e "${BLUE}================================================================${NC}" | tee -a "$OUTPUT_FILE"
echo "" | tee -a "$OUTPUT_FILE"
echo "📊 STATISTICHE FINALI:" | tee -a "$OUTPUT_FILE"
echo "=====================" | tee -a "$OUTPUT_FILE"
echo "Moduli controllati: $MODULES_CHECKED" | tee -a "$OUTPUT_FILE"
echo "Errori trovati: $ERRORS_FOUND" | tee -a "$OUTPUT_FILE"
echo "Warning trovati: $WARNINGS_FOUND" | tee -a "$OUTPUT_FILE"
echo "" | tee -a "$OUTPUT_FILE"

if [ "$ERRORS_FOUND" -eq 0 ] && [ "$WARNINGS_FOUND" -eq 0 ]; then
    echo -e "${GREEN}🎉 Tutte le catene di ereditarietà sono pulite!${NC}" | tee -a "$OUTPUT_FILE"
    echo "" | tee -a "$OUTPUT_FILE"
    echo "✅ Nessuna azione richiesta" | tee -a "$OUTPUT_FILE"
    exit 0
else
    echo -e "${RED}❌ Trovate $ERRORS_FOUND violazioni di ereditarietà e $WARNINGS_FOUND warning${NC}" | tee -a "$OUTPUT_FILE"
    echo "" | tee -a "$OUTPUT_FILE"
    echo "📋 AZIONI RICHIESTE:" | tee -a "$OUTPUT_FILE"
    echo "===================" | tee -a "$OUTPUT_FILE"
    if [ "$ERRORS_FOUND" -gt 0 ]; then
        echo "1. Rimuovere trait duplicati dai modelli figli" | tee -a "$OUTPUT_FILE"
        echo "2. Rimuovere metodi newFactory() se HasFactory è in BaseModel" | tee -a "$OUTPUT_FILE"
    fi
    if [ "$WARNINGS_FOUND" -gt 0 ]; then
        echo "3. Considerare di spostare trait comuni nel BaseModel" | tee -a "$OUTPUT_FILE"
    fi
    echo "4. Verificare che solo BaseModel contenga trait comuni" | tee -a "$OUTPUT_FILE"
    echo "5. Aggiornare documentazione catena ereditarietà" | tee -a "$OUTPUT_FILE"
    echo "" | tee -a "$OUTPUT_FILE"
    echo "📖 DOCUMENTAZIONE:" | tee -a "$OUTPUT_FILE"
    echo "=================" | tee -a "$OUTPUT_FILE"
    echo "- docs/inheritance_chain_critical_rules.md" | tee -a "$OUTPUT_FILE"
    echo "- ../bashscripts/docs/traits/" | tee -a "$OUTPUT_FILE"
    echo "" | tee -a "$OUTPUT_FILE"
    echo -e "${YELLOW}📄 Report completo salvato in: $OUTPUT_FILE${NC}" | tee -a "$OUTPUT_FILE"
    exit 1
fi