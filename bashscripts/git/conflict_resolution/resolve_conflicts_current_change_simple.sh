#!/bin/bash

set -euo pipefail

SCRIPT_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/../../.." && pwd)"
BASE_DIR="${BASE_DIR:-$SCRIPT_ROOT}"
DRY_RUN="${DRY_RUN:-false}"
BACKUP_ROOT="${BACKUP_ROOT:-$SCRIPT_ROOT/bashscripts/backups}"
TIMESTAMP="$(date +%Y%m%d_%H%M%S)"
BACKUP_DIR="$BACKUP_ROOT/current_change_simple_$TIMESTAMP"
LOG_FILE="$SCRIPT_ROOT/bashscripts/logs/resolve_conflicts_current_change_simple_$TIMESTAMP.log"

mkdir -p "$BACKUP_ROOT" "$(dirname "$LOG_FILE")"

is_binary() {
    local file="$1"
    if file --brief --mime "$file" 2>/dev/null | grep -qi "binary"; then
        return 0
    fi
    if grep -q $'\0' "$file" 2>/dev/null; then
        return 0
    fi
    return 1
}

resolve_file() {
    local file="$1"
    local tmp
    tmp="$(mktemp)"
    if awk '
        BEGIN { state=0 }
        /^<<<<<<< / { state=1; next }
        /^=======/ { if (state==1) state=2; next }
        /^>>>>>>> / { state=0; next }
        { if (state==0 || state==2) print }
    ' "$file" > "$tmp"; then
        mv "$tmp" "$file"
    else
        rm -f "$tmp"
        return 1
    fi
    return 0
}

log() {
    local msg="$1"
    printf '[%s] %s\n' "$(date '+%Y-%m-%d %H:%M:%S')" "$msg" | tee -a "$LOG_FILE" >/dev/null
}

log "Start current-change resolver (base: $BASE_DIR, dry-run: $DRY_RUN)"

mapfile -d '' -t FILES < <(find "$BASE_DIR" -type f \
    ! -path '*/.git/*' \
    ! -path '*/vendor/*' \
    ! -path '*/node_modules/*' \
    ! -path '*/storage/logs/*' \
    -print0)

TOTAL=0
RESOLVED=0
SKIPPED=0
FAILED=0
mkdir -p "$BACKUP_DIR"

for file in "${FILES[@]}"; do
    if ! grep -q "<<<<<<<" "$file" 2>/dev/null; then
        continue
    fi
    ((TOTAL++))

    if is_binary "$file"; then
        log "Skip binary: $file"
        ((SKIPPED++))
        continue
    fi

    if [[ "$DRY_RUN" == "true" ]]; then
        log "[DRY] would resolve: $file"
        ((SKIPPED++))
        continue
    fi

    cp "$file" "$BACKUP_DIR/$(echo "$file" | sed 's#/#__#g')"

    if resolve_file "$file"; then
        log "Resolved: $file"
        ((RESOLVED++))
    else
        log "Failed: $file"
        ((FAILED++))
    fi
done

log "Completed. Total=$TOTAL resolved=$RESOLVED skipped=$SKIPPED failed=$FAILED"