#!/bin/bash

# Script to resolve merge conflicts by taking current version (HEAD)
# Process ALL files with conflicts, regardless of extension

echo "Resolving merge conflicts in ALL files..."

# Get list of ALL files with conflicts (any extension)
conflict_files=$(find . -type f | xargs grep -l "<<< HEAD" 2>/dev/null)

echo "Found $(echo "$conflict_files" | wc -l) files with conflicts"

# Process each file
counter=0
for file in $conflict_files; do
    counter=$((counter + 1))
    echo "[$counter] Processing: $file"

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
        echo "  ✓ Resolved: $file"
    else
        echo "  ⚠ Warning: Empty result for $file, skipping"
        rm "$temp_file"
    fi
done

echo "Merge conflict resolution complete! Processed $counter files."