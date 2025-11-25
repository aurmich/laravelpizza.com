# Git Management Scripts

## Panoramica

Questa cartella contiene tutti gli script per la gestione Git del progetto Laraxot, inclusi script per subtrees, sincronizzazione, conflitti e branch management.

## Collegamenti

- [Documentazione Git](../docs/git_scripts.md)
- [Conflict Resolution Guide](../docs/git-conflict-resolution-incoming-strategy.md)
- [Subtree Management](../docs/git_subtree_conflicts.md)
- [Best Practices](../docs/best-practices.md)

## Script Principali

### Risoluzione Conflitti

#### resolve_all_conflicts_incoming.sh

**Scopo**: Risolve automaticamente tutti i conflitti Git usando la strategia INCOMING (prende sempre la versione nuova).

**Uso**:
```bash
# Risolvi conflitti in Modules
./resolve_all_conflicts_incoming.sh laravel/Modules

# Risolvi conflitti in tutto il progetto
./resolve_all_conflicts_incoming.sh
```

**Features**:
- ✅ Backup automatico pre-risoluzione
- ✅ Log dettagliato con timestamp
- ✅ Conteggio conflitti risolti
- ✅ Verifica finale
- ✅ Esclusione automatica vendor/node_modules

**Output Esempio**:
```
🐄 SUPERMUCCA GIT CONFLICT RESOLVER v6.0
📁 File totali processati:    266
✅ File risolti con successo:  263
🔧 Conflitti totali risolti:   842
🎉 SUCCESSO!
```

#### resolve_git_conflict.sh

Risoluzione interattiva/manuale di conflitti Git.

#### resolve_git_conflicts.sh

Script legacy per risoluzione conflitti.

### Gestione Subtrees

#### git_pull_subtrees.sh

Pull di tutti i subtree configurati nel progetto.

#### git_push_subtrees.sh

Push di tutti i subtree verso i repository remoti.

#### git_sync_subtrees.sh

Sincronizzazione bidirezionale (pull + push) di tutti i subtree.

### Gestione Branch

#### git_up.sh

Aggiorna il branch corrente con rebase automatico.

#### git_up_noai.sh

Aggiorna senza AI commit message generation.

#### git_rebase.sh

Rebase interattivo con gestione conflitti.

### Gestione Remote

#### git_remote_add_org.sh

Aggiunge remote per organizzazione GitHub.

#### git_change_org.sh

Cambia organizzazione GitHub per i remote.

#### git_sync_org.sh

Sincronizza con organizzazione GitHub.

## Struttura Directory

```
git-management/
├── README.md                               # Questo file
├── resolve_all_conflicts_incoming.sh       # Script risoluzione conflitti INCOMING
├── resolve_git_conflict.sh                 # Risoluzione interattiva
├── resolve_git_conflicts.sh                # Script legacy
├── git_pull_subtrees.sh                    # Pull tutti subtree
├── git_push_subtrees.sh                    # Push tutti subtree
├── git_sync_subtrees.sh                    # Sync tutti subtree
├── git_up.sh                               # Update branch con rebase
├── git_rebase.sh                           # Rebase interattivo
└── [altri script...]
```

## Workflow Tipici

### Workflow 1: Sincronizzazione Subtree

```bash
# 1. Pull tutti i subtree
./git_pull_subtrees.sh

# 2. Risolvi eventuali conflitti
./resolve_all_conflicts_incoming.sh laravel/Modules

# 3. Push modifiche
./git_push_subtrees.sh
```

### Workflow 2: Update Branch con Conflitti

```bash
# 1. Update branch
./git_up.sh

# 2. Se ci sono conflitti, risolvili
./resolve_all_conflicts_incoming.sh

# 3. Continua rebase
git rebase --continue
```

### Workflow 3: Merge Feature Branch

```bash
# 1. Merge feature
git merge feature/my-feature

# 2. Risolvi conflitti automaticamente
./resolve_all_conflicts_incoming.sh

# 3. Verifica e test
php artisan optimize:clear
./vendor/bin/phpstan analyse

# 4. Commit
git add .
git commit -m "merge: feature/my-feature with conflicts resolved"
```

## Convenzioni

### Naming

- `git_*.sh`: Script per operazioni git standard
- `resolve_*.sh`: Script per risoluzione conflitti
- `sync_*.sh`: Script per sincronizzazione

### Log Files

Tutti gli script salvano log in `../logs/`:

- Formato: `script_name_YYYYMMDD_HHMMSS.log`
- Contenuto: Timestamp, operazioni, errori, riepilogo

### Backup Files

Tutti gli script salvano backup in `../backups/`:

- Formato: `conflicts_YYYYMMDD_HHMMSS/`
- Struttura: Replica struttura progetto
- Conservazione: Manuale

## Testing

### Test Manuale

```bash
# Test dry-run
./resolve_all_conflicts_incoming.sh laravel/Modules/TestModule

# Verifica backup creato
ls -lh ../backups/

# Verifica log
tail -50 ../logs/resolve_conflicts_*.log
```

### Test Automatici

(TODO: Creare test suite per gli script bash)

## Troubleshooting

### Script non esegue

```bash
# Verifica permessi
chmod +x resolve_all_conflicts_incoming.sh

# Verifica shebang
head -1 resolve_all_conflicts_incoming.sh
```

### Conflitti non risolti

```bash
# Verifica conflitti rimanenti
grep -r "<<<<<<< HEAD" laravel/Modules

# Ripristina singolo file da git
git show COMMIT:path/to/file.php > file.php
```

### File corrotti dopo risoluzione

```bash
# Verifica sintassi PHP
php -l file.php

# Ripristina da backup
cp ../backups/conflicts_TIMESTAMP/file.php laravel/path/to/file.php
```

## Vedi Anche

- [Git Conflict Resolver Library](../lib/git_conflict_resolver.sh)
- [Conflict Resolution Documentation](../docs/git-conflict-resolution-incoming-strategy.md)
- [Bash Best Practices](../docs/bash_best_practices.md)
- [Project Git Workflow](../docs/git_workflow.md)

## Autori

- AI Assistant + Laraxot Team
- Data creazione: 2025-10-22
- Ultima modifica: 2025-10-22

## Licenza

MIT License - Vedi LICENSE file nella root del progetto.







