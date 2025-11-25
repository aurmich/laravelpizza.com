#!/bin/bash

# Script supermucca per risolvere conflitti Git prendendo incoming changes
echo "🐄 Supermucca Git Conflict Resolver 🐄"
echo "🔍 Cercando files con conflitti..."

# Trova tutti i files con conflict markers
conflict_files=$(grep -r "<<<< HEAD" . --include="*.php" --include="*.json" --include="*.md" --include="*.sh" --include="*.js" --include="*.ts" --include="*.vue" --include="*.yaml" --include="*.yml" --include="*.xml" --include="*.txt" 2>/dev/null | cut -d: -f1 | sort -u)

if [ -z "$conflict_files" ]; then
    echo "✅ Nessun conflitto trovato!"
    exit 0
fi

echo "📁 Conflitti trovati in:"
echo "$conflict_files"
echo ""

count=0

# Processa ogni file con conflitti
while IFS= read -r file; do
    if [ -f "$file" ]; then
        echo "🔧 Risolvendo conflitti in: $file"

        # Usa awk per rimuovere conflict markers e tenere incoming changes
        temp_file=$(mktemp)

        awk '
        BEGIN { in_conflict = 0; in_incoming = 0 }
        /^<<<< HEAD/ { in_conflict = 1; next }
        /^====/ { in_incoming = 1; next }
        /^>>>>/ { in_conflict = 0; in_incoming = 0; next }
        {
            if (!in_conflict || in_incoming) {
                print
            }
        }
        ' "$file" > "$temp_file"

        mv "$temp_file" "$file"
        count=$((count + 1))
        echo "✅ Risolto: $file"
    fi
done <<< "$conflict_files"

echo ""
echo "🎉 Supermucca ha risolto $count conflitti!"
echo "🔄 Ora puoi fare:"
echo "   git add ."
echo "   git commit -m 'Resolve conflicts by accepting incoming changes 🐄'"
