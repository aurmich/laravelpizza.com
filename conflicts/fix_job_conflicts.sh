#!/bin/bash

# --------------------------------------------------------------------------
# Git Conflict Resolution Script for Job Module
# --------------------------------------------------------------------------
# This script automates the resolution of Git conflicts in the Job module
# by taking the HEAD version for most files and handling special cases.
#
# Usage: bashscripts/conflicts/fix_job_conflicts.sh
# Posizione: bashscripts/conflicts/fix_job_conflicts.sh
# --------------------------------------------------------------------------

# --- Configuration ---
# Script deve essere eseguito dalla root del progetto
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/../.." && pwd)"
BASE_DIR="$PROJECT_ROOT/laravel"
JOB_MODULE_DIR="$BASE_DIR/Modules/Job"
BACKUP_DIR="$BASE_DIR/backups/job_conflicts_$(date +%Y%m%d%H%M%S)"
LOG_FILE="$BASE_DIR/logs/job_conflicts_$(date +%Y%m%d%H%M%S).log"

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

# --- Create directories ---
mkdir -p "$BACKUP_DIR" "$BASE_DIR/logs" || { log_message "error" "Failed to create backup/log directories"; exit 1; }
log_message "info" "Backup directory created: $BACKUP_DIR"

# --- Find all files with Git conflict markers in Job module ---
            sed -i '/>>>>>>>/d' "$file"
            sed -i '/=======/d' "$file"
