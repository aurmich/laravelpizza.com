# 🐄 SuperMucca Merge Conflict Resolver

Collezione di script bash per risolvere automaticamente i merge conflicts Git, accettando sempre le "incoming changes" dal branch `filament4`.
<<<<<<< HEAD
## 📁 Script Disponibili
### 1. `resolve_all_conflicts.sh` - Risolutore Base
Collezione di script bash per risolvere automaticamente i merge conflicts Git con diverse strategie di risoluzione.

## 📁 Script Disponibili

### 1. `resolve_incoming_changes.sh` - Risolutore Incoming Changes
**Uso:** Risoluzione automatica accettando le "incoming changes" (develop/filament4)

```bash
./bashscripts/merge_conflicts/resolve_incoming_changes.sh
```

**Caratteristiche:**
- ✅ Risolve conflitti automaticamente accettando incoming changes
- ✅ Crea backup di sicurezza con timestamp
- ✅ Statistiche dettagliate
- ✅ Verifica finale conflitti rimanenti
- ✅ Supporta file multipli (.php, .blade.php, .js, .ts, .vue, .md)

**Strategia:** Mantiene il contenuto tra `=======` e `>>>>>>> develop`, rimuove il contenuto tra `<<<<<<< HEAD` e `=======`

### 2. `resolve_current_changes.sh` - Risolutore Current Changes
**Uso:** Risoluzione automatica accettando le "current changes" (HEAD)

```bash
./bashscripts/merge_conflicts/resolve_current_changes.sh
```

**Caratteristiche:**
- ✅ Risolve conflitti automaticamente accettando current changes (HEAD)
- ✅ Crea backup di sicurezza con timestamp
- ✅ Statistiche dettagliate
- ✅ Verifica finale conflitti rimanenti
- ✅ Supporta file multipli (.php, .blade.php, .js, .ts, .vue, .md)

**Strategia:** Mantiene il contenuto tra `<<<<<<< HEAD` e `=======`, rimuove il contenuto tra `=======` e `>>>>>>> branch_name`

### 3. `resolve_all_conflicts.sh` - Risolutore Base (Legacy)
Collezione di script bash per risolvere automaticamente i merge conflicts Git, accettando sempre le "incoming changes" dal branch `filament4`.
## 📁 Script Disponibili
=======
## 📁 Script Disponibili
>>>>>>> 4b834e6 (.)
### 1. `resolve_all_conflicts.sh` - Risolutore Base
**Uso:** Risoluzione rapida e semplice dei conflitti standard
```bash
./bashscripts/merge_conflicts/resolve_all_conflicts.sh
```
**Caratteristiche:**
- ✅ Risolve conflitti semplici automaticamente
- ✅ Crea backup di sicurezza (`.backup`)
- ✅ Statistiche dettagliate
- ✅ Conferma utente prima dell'esecuzione
- ✅ Colori per output leggibile
### 2. `advanced_conflict_resolver.sh` - Risolutore Avanzato
**Uso:** Gestione di conflitti complessi e multipli
./bashscripts/merge_conflicts/advanced_conflict_resolver.sh
- 🔍 Analizza la complessità dei conflitti
- 🧠 Gestisce conflitti multipli nello stesso file
- 🛡️ Rileva file malformati
- 📊 Categorizza i file (semplici/complessi/malformati)
- 🔄 Processamento linea per linea per casi complessi
**Quando usarlo:**
- File con conflitti multipli
- Conflitti annidati o complessi
- Quando il risolutore base fallisce
### 3. `cleanup_and_verify.sh` - Cleanup e Verifica
**Uso:** Verifica post-risoluzione e cleanup
./bashscripts/merge_conflicts/cleanup_and_verify.sh
- 🔍 Controlla conflitti residui
- 🐘 Verifica sintassi PHP
- 📊 Esegue PHPStan sui moduli critici
- 🗑️ Cleanup file di backup
- 📋 Menu interattivo
- 🔄 Controllo stato Git
## 🚀 Workflow Consigliato
### Scenario 1: Conflitti Semplici
# 1. Risolvi i conflitti
<<<<<<< HEAD

### Scenario 1: Accettare Incoming Changes (develop/filament4)
```bash
# 1. Risolvi i conflitti accettando incoming changes
./bashscripts/merge_conflicts/resolve_incoming_changes.sh

# 2. Verifica e cleanup
# 3. Committa
git add .
git commit -m "Resolve merge conflicts - accept filament4 changes"
### Scenario 2: Conflitti Complessi
git commit -m "Resolve merge conflicts - accept incoming changes (develop)"
```

### Scenario 2: Accettare Current Changes (HEAD)
```bash
# 1. Risolvi i conflitti accettando current changes
./bashscripts/merge_conflicts/resolve_current_changes.sh

=======
>>>>>>> 4b834e6 (.)
# 2. Verifica e cleanup
# 3. Committa
git add .
<<<<<<< HEAD
git commit -m "Resolve merge conflicts - accept current changes (HEAD)"
```

### Scenario 3: Conflitti Complessi (Legacy)
```bash
### Scenario 1: Conflitti Semplici
# 1. Risolvi i conflitti
# 2. Verifica e cleanup
# 3. Committa
git add .
=======
>>>>>>> 4b834e6 (.)
git commit -m "Resolve merge conflicts - accept filament4 changes"
### Scenario 2: Conflitti Complessi
# 1. Usa il risolutore avanzato
# 2. Verifica accuratamente
# 3. Test aggiuntivi se necessario
./vendor/bin/phpstan analyze Modules --level=9
# 4. Committa
git commit -m "Resolve complex merge conflicts - accept filament4 changes"
## 🛡️ Sicurezza e Backup
### File di Backup
Gli script creano automaticamente backup:
- `.backup` - Risolutore base
- `.advanced_backup` - Risolutore avanzato
<<<<<<< HEAD
### Rimuovere i Backup
# Manuale
- `backup_YYYYMMDD_HHMMSS/` - Script nuovi (resolve_incoming_changes.sh, resolve_current_changes.sh)
- `.backup` - Risolutore base (legacy)
- `.advanced_backup` - Risolutore avanzato (legacy)

### Rimuovere i Backup
```bash
# Manuale - Backup nuovi script
rm -rf bashscripts/merge_conflicts/backup_*

# Manuale - Backup legacy
=======
### Rimuovere i Backup
# Manuale
>>>>>>> 4b834e6 (.)
find . -name "*.backup" -delete
find . -name "*.advanced_backup" -delete
# Tramite script di cleanup
# Scegli opzione 5
### Ripristino di Emergenza
# Ripristina un singolo file
mv file.php.backup file.php
<<<<<<< HEAD
# Ripristina tutti i file
```bash
# Ripristina da backup nuovi script (timestamp specifico)
cp bashscripts/merge_conflicts/backup_20250127_100000/file.php ./file.php

# Ripristina un singolo file (legacy)
mv file.php.backup file.php

# Ripristina tutti i file (legacy)
find . -name "*.backup" -exec bash -c 'mv "$1" "${1%.backup}"' _ {} \;
## 🔧 Personalizzazione
# Ripristina un singolo file
mv file.php.backup file.php
=======
>>>>>>> 4b834e6 (.)
# Ripristina tutti i file
find . -name "*.backup" -exec bash -c 'mv "$1" "${1%.backup}"' _ {} \;
## 🔧 Personalizzazione
### Modificare la Strategia di Risoluzione
Per accettare le "current changes" invece delle "incoming changes", modifica negli script:
# Cambia da:
# A:
<<<<<<< HEAD
### Aggiungere Altri Tipi di File
Modifica il pattern di ricerca:
# Da:

### Strategie di Risoluzione Disponibili
Gli script offrono due strategie principali:

1. **Incoming Changes** (`resolve_incoming_changes.sh`): Accetta le modifiche dal branch remoto
2. **Current Changes** (`resolve_current_changes.sh`): Accetta le modifiche dal branch corrente (HEAD)

### Modificare la Strategia di Risoluzione (Legacy)
Per modificare gli script legacy, cambia la logica sed:

```bash
# Per accettare incoming changes (default):
sed -i '/^<<<<<<< HEAD$/,/^=======$/d; /^>>>>>>> filament4$/d' "$file"

# Per accettare current changes:
sed -i '/^=======$/,/^>>>>>>> filament4$/d; /^<<<<<<< HEAD$/d' "$file"
```

### Aggiungere Altri Tipi di File
I nuovi script supportano già molti tipi di file. Per aggiungerne altri, modifica il pattern di ricerca:

```bash
# Pattern attuale nei nuovi script:
find . -name "*.php" -o -name "*.blade.php" -o -name "*.js" -o -name "*.ts" -o -name "*.vue" -o -name "*.md"

# Per aggiungere altri tipi (es. .css, .scss):
find . -name "*.php" -o -name "*.blade.php" -o -name "*.js" -o -name "*.ts" -o -name "*.vue" -o -name "*.md" -o -name "*.css" -o -name "*.scss"
```

## 🐛 Troubleshooting
### Problema: "Permission denied"
chmod +x bashscripts/merge_conflicts/*.sh
```bash
# Rendi eseguibili tutti gli script
chmod +x bashscripts/merge_conflicts/*.sh

# Oppure solo i nuovi script
chmod +x bashscripts/merge_conflicts/resolve_incoming_changes.sh
chmod +x bashscripts/merge_conflicts/resolve_current_changes.sh
```

## 🐛 Troubleshooting
### Problema: "Permission denied"
chmod +x bashscripts/merge_conflicts/*.sh
=======
### Aggiungere Altri Tipi di File
Modifica il pattern di ricerca:
# Da:
## 🐛 Troubleshooting
### Problema: "Permission denied"
chmod +x bashscripts/merge_conflicts/*.sh
>>>>>>> 4b834e6 (.)
### Problema: "File malformati"
I file con conflitti malformati richiedono intervento manuale:
1. Apri il file in un editor
2. Cerca i marker di conflitto
3. Risolvi manualmente
4. Rimuovi i marker
### Problema: "Errori di sintassi PHP"
Dopo la risoluzione automatica:
1. Esegui il cleanup script
2. Controlla gli errori segnalati
3. Correggi manualmente i file problematici
### Problema: "PHPStan errors"
# Test specifico su un modulo
./vendor/bin/phpstan analyze Modules/NomeModulo --level=8
# Con più dettagli
./vendor/bin/phpstan analyze Modules/NomeModulo --level=8 -v
## 📊 Statistiche e Logging
Gli script forniscono statistiche dettagliate:
- Numero totale di file processati
- File risolti con successo
- File saltati o con errori
- Conflitti complessi gestiti
## 🤝 Contribuire
Per migliorare gli script:
1. Testa su diversi tipi di conflitti
2. Aggiungi gestione per nuovi edge case
3. Migliora l'output e la user experience
4. Aggiungi supporto per altri tipi di file
## 📝 Note Tecniche
### Strategia di Risoluzione

#### Script `resolve_incoming_changes.sh`:
- **HEAD section**: Rimossa (versione corrente/locale)
- **Incoming section**: Mantenuta (versione develop/filament4)
- **Marker removal**: Tutti i marker Git vengono rimossi

#### Script `resolve_current_changes.sh`:
- **HEAD section**: Mantenuta (versione corrente/locale)
- **Incoming section**: Rimossa (versione develop/filament4)
- **HEAD section**: Rimossa (versione corrente/locale)
- **Incoming section**: Mantenuta (versione filament4)
- **Marker removal**: Tutti i marker Git vengono rimossi
### Limitazioni
- Non gestisce conflitti in file binari
- Richiede marker Git standard
- Non supporta merge tools esterni
### Compatibilità
- ✅ Bash 4.0+
- ✅ GNU sed
- ✅ Git 2.0+
- ✅ PHP 7.4+ (per syntax check)
---
**Creato da SuperMucca AI Assistant 🐄**  
*"Perché anche i conflitti Git meritano una risoluzione elegante!"*
