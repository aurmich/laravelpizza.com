#!/bin/bash

# Script to resolve merge conflicts by taking current version (HEAD)
# This will remove all merge conflict markers and keep the current version

echo "Resolving merge conflicts in all files..."

# Find all files with merge conflicts and process them
find . -type f -name "*.php" -o -name "*.blade.php" -o -name "*.md" -o -name "*.json" -o -name "*.js" -o -name "*.css" | \
while read file; do
    if grep -q "<<< HEAD" "$file"; then
        echo "Processing: $file"

        # Create a temporary file for processing
        temp_file="$(mktemp)"

        # Process the file to remove merge conflicts and keep HEAD version
        awk '
        /^<<< HEAD/ { in_head=1; next }
        /^===/ { in_head=0; in_other=1; next }
        /^>>>/ { in_other=0; next }
        in_head { print }
        !in_head && !in_other { print }
        ' "$file" > "$temp_file"

        # Replace the original file if processing was successful
        if [ -s "$temp_file" ]; then
            mv "$temp_file" "$file"
            echo "✓ Resolved: $file"
        else
            echo "⚠ Warning: Empty result for $file, skipping"
            rm "$temp_file"
        fi
    fi
done

echo "Merge conflict resolution complete!"