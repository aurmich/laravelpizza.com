#!/usr/bin/env python3
"""
Script Python per risolvere conflitti Git - Current Change
Mantiene la versione dopo ======= (current change)
"""

import os
import sys
import re
from pathlib import Path
from datetime import datetime

BASE_DIR = Path("/var/www/_bases/base_ptvx_fila4_mono")
TIMESTAMP = datetime.now().strftime("%Y%m%d_%H%M%S")
BACKUP_DIR = BASE_DIR / "bashscripts" / "backups" / f"conflicts_python_{TIMESTAMP}"
LOG_FILE = BASE_DIR / "bashscripts" / "logs" / f"fix_conflicts_python_{TIMESTAMP}.log"
FAILED_FILES_LIST = BASE_DIR / "bashscripts" / "logs" / f"failed_files_{TIMESTAMP}.txt"

BACKUP_DIR.mkdir(parents=True, exist_ok=True)
LOG_FILE.parent.mkdir(parents=True, exist_ok=True)

resolved = 0
failed = 0
skipped = 0
failed_files = []

def log(msg):
    with open(LOG_FILE, 'a') as f:
        f.write(f"[{datetime.now()}] {msg}\n")

def resolve_conflicts(content):
    """Risolve conflitti mantenendo current change (dopo =======)"""
    lines = content.split('\n')
    result = []
    state = 0  # 0=normale, 1=in HEAD (scarta), 2=in current (mantieni)
    
    for line in lines:
        if line.startswith('<<<<<<<'):
            state = 1
            continue
        elif line.startswith('======='):
            if state == 1:
                state = 2
            continue
        elif line.startswith('>>>>>>>'):
            state = 0
            continue
        
        if state == 0 or state == 2:
            result.append(line)
    
    return '\n'.join(result)

print("=== Risoluzione Conflitti Git - Current Change (Python) ===")
print(f"Timestamp: {datetime.now()}")
print(f"Directory: {BASE_DIR}")
print(f"Log: {LOG_FILE}")
print(f"Backup: {BACKUP_DIR}")
print()

# Trova tutti i file con conflitti
print("Ricerca file con conflitti...")
files = []
for root, dirs, filenames in os.walk(BASE_DIR / "laravel"):
    # Escludi directory
    dirs[:] = [d for d in dirs if d not in ['vendor', 'node_modules', '.git', 'storage']]
    
    for filename in filenames:
        filepath = Path(root) / filename
        try:
            with open(filepath, 'r', encoding='utf-8', errors='ignore') as f:
                content = f.read()
                if '<<<<<<<' in content:
                    files.append(filepath)
        except:
            pass

print(f"Trovati {len(files)} file con conflitti (escluso vendor/)\n")
log(f"Trovati {len(files)} file con conflitti")

# Processa ogni file
for idx, filepath in enumerate(files, 1):
    print(f"[{idx}/{len(files)}] {filepath.relative_to(BASE_DIR)}")
    
    try:
        # Leggi contenuto
        with open(filepath, 'r', encoding='utf-8') as f:
            original_content = f.read()
        
        # Backup
        backup_name = str(filepath.relative_to(BASE_DIR)).replace('/', '_')
        backup_file = BACKUP_DIR / f"{backup_name}.backup"
        with open(backup_file, 'w', encoding='utf-8') as f:
            f.write(original_content)
        
        # Risolvi conflitti
        resolved_content = resolve_conflicts(original_content)
        
        # Verifica
        if '<<<<<<<' in resolved_content:
            print(f"  ERRORE: Conflitti rimanenti")
            log(f"ERRORE: {filepath} - conflitti rimanenti")
            failed_files.append(str(filepath.relative_to(BASE_DIR)))
            failed += 1
            continue
        
        if not resolved_content.strip():
            print(f"  ERRORE: Risultato vuoto")
            log(f"ERRORE: {filepath} - risultato vuoto")
            failed_files.append(str(filepath.relative_to(BASE_DIR)))
            failed += 1
            continue
        
        # Scrivi file risolto
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(resolved_content)
        
        print(f"  OK: Risolto")
        log(f"OK: {filepath}")
        resolved += 1
        
    except Exception as e:
        print(f"  ERRORE: {e}")
        log(f"ERRORE: {filepath} - {e}")
        failed_files.append(str(filepath.relative_to(BASE_DIR)))
        failed += 1

print()
print("=== RIEPILOGO ===")
print(f"File processati: {len(files)}")
print(f"Risolti: {resolved}")
print(f"Falliti: {failed}")
print(f"Skipped: {skipped}")
print(f"Log: {LOG_FILE}")
print(f"Backup: {BACKUP_DIR}")

if failed_files:
    print(f"\nFile falliti ({len(failed_files)}):")
    with open(FAILED_FILES_LIST, 'w') as f:
        for file in failed_files:
            print(f"  - {file}")
            f.write(f"{file}\n")
    print(f"\nLista completa in: {FAILED_FILES_LIST}")

sys.exit(0 if failed == 0 else 1)

