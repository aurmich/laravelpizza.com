#!/bin/bash

# --------------------------------------------------------------------------
# Git Conflict Resolution Script for All Modules
# --------------------------------------------------------------------------
# This script automates the resolution of Git conflicts in all modules
# by taking the HEAD version for most files.
#
<<<<<<< HEAD
# Usage: bashscripts/conflicts/fix_all_conflicts.sh
# Posizione: bashscripts/conflicts/fix_all_conflicts.sh
# --------------------------------------------------------------------------

# --- Configuration ---
# Script deve essere eseguito dalla root del progetto
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/../.." && pwd)"
BASE_DIR="$PROJECT_ROOT/laravel"
=======
# Usage: ./scripts/fix_all_conflicts.sh
# --------------------------------------------------------------------------

# --- Configuration ---
BASE_DIR="/var/www/_bases/base_techplanner_fila3_mono/laravel"
>>>>>>> 803d2a9 (.)
BACKUP_DIR="$BASE_DIR/backups/all_conflicts_$(date +%Y%m%d%H%M%S)"
LOG_FILE="$BASE_DIR/logs/all_conflicts_$(date +%Y%m%d%H%M%S).log"

# --- Colors for output ---
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# --- Logging Function ---
log_message() {
    local type="$1"
    local message="$2"
    local timestamp=$(date '+%Y-%m-%d %H:%M:%S')
    echo -e "${timestamp} [${type^^}] ${message}" | tee -a "$LOG_FILE"
}

# --- Create backup directory ---
mkdir -p "$BACKUP_DIR" || { log_message "error" "Failed to create backup directory: $BACKUP_DIR"; exit 1; }
log_message "info" "Backup directory created: $BACKUP_DIR"

# --- Find all files with Git conflict markers ---
    sed -i '/>>>>>>>/d' "$file"
    sed -i '/=======/d' "$file"
<<<<<<< HEAD

=======
>>>>>>> 803d2a9 (.)
