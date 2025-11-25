# MODULE_NAMESPACE_RULES.md

## Regole fondamentali WindSurf/Laraxot sui moduli e le migrazioni

### 1. Namespace e BaseModel
- Ogni modello concreto di un modulo deve estendere esclusivamente `BaseModel` del proprio modulo.
- Mai estendere `Modules\Xot\Models\XotBaseModel` direttamente.
- Garantisce isolamento, override locale, coerenza tra moduli e compliance PHPStan livello 10.

### 2. Migrazioni: regole chiave
- Tutte le migrazioni devono essere **classi anonime** restituite da `return new class extends XotBaseMigration { ... }`.
- Mai usare classi nominali.
- Mai implementare il metodo `down` nelle migrazioni che estendono `XotBaseMigration`.
- Quando si aggiunge una colonna a una tabella esistente:
  - NON si crea una nuova migrazione di creazione
  - SI copia la migrazione originale, si aggiorna il timestamp
  - SI aggiunge la colonna in update solo se non esiste (`if (! $this->hasColumn(...))`)
- Documentare sempre la motivazione della modifica e aggiornare la documentazione più vicina e quella root.

### 3. Documentazione
- Aggiornare sempre la cartella docs più vicina e la root quando si cambia una regola o si modifica una tabella.
- Cross-link tra regole di modulo e regole globali.

### 4. Best practice PHPStan
- Tutte le modifiche devono essere conformi a PHPStan livello 10.
- Esplicitare sempre tipi di ritorno, parametri e proprietà.
- Aggiornare la documentazione delle regole ogni volta che si corregge un errore PHPStan.

---

## Backlink e cross-link
- [Modules/Performance/docs/database-migrations.md](../Performance/docs/database-migrations.md) ←→ [MODULE_NAMESPACE_RULES.md](./module-namespace-rules.md)
- [Modules/Performance/docs/migration_update_rules.md](../Performance/docs/migration_update_rules.md) ←→ [MODULE_NAMESPACE_RULES.md](./module-namespace-rules.md)
- [Modules/Performance/docs/README.md](../Performance/docs/README.md) ←→ [MODULE_NAMESPACE_RULES.md](./module-namespace-rules.md)

Ultimo aggiornamento: 2025-05-13

**Backlink modulo Performance:**
- [Modules/Performance/docs/convenzioni-modulo.md](../Performance/docs/convenzioni-modulo.md)
