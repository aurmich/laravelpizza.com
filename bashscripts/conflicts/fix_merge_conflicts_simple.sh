#!/bin/bash

# Script to fix merge conflicts by removing all merge markers and keeping the content
# Usage: ./fix_merge_conflicts_simple.sh

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

echo "Finding files with merge conflicts in $SCRIPT_DIR..."

# Find all files with merge conflict markers
find "$SCRIPT_DIR" -type f -exec grep -l "<<<< HEAD" {} \; > /tmp/conflict_files.txt

if [ ! -s /tmp/conflict_files.txt ]; then
    echo "No merge conflicts found!"
    exit 0
fi

echo "Found $(wc -l < /tmp/conflict_files.txt) files with merge conflicts:"
cat /tmp/conflict_files.txt

echo ""
echo "Fixing merge conflicts..."

while IFS= read -r file; do
    echo "Processing: $file"

    # Create backup
    cp "$file" "${file}.backup"

    # Remove merge conflict markers using sed
    # This removes:
    # <<<<<<< HEAD
    # =======
    # >>>>>>> [commit hash/branch]
    sed -i '/^<<<<<<< HEAD$/d; /^=======$/d; /^>>>>>>> .*$/d' "$file"

    echo "  ✓ Fixed: $file"
done < /tmp/conflict_files.txt

echo ""
echo "All merge conflicts have been resolved!"
echo "Backup files created with .backup extension"

# Clean up
rm /tmp/conflict_files.txt

echo "Done!"