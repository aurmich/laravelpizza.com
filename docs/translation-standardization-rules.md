# Regole di Standardizzazione Traduzioni - Moduli Laraxot

## Panoramica

Questo documento definisce le regole obbligatorie per la standardizzazione dei file di traduzione in tutti i moduli Laraxot, basate sull'analisi dei problemi esistenti e sulle best practice.

## Problemi Identificati

### 🔴 **Problemi Critici Rilevati:**

1. **Strutture Inconsistenti**
   - Alcuni file hanno struttura espansa perfetta (device.php)
   - Altri hanno problemi gravi (role.php, appointment.php)
   - Mancanza di coerenza tra moduli

2. **Helper Text Duplicato**
   - Pattern: `'helper_text' => 'campo_name'` invece di testi descrittivi
   - Violazione della regola: helper_text deve essere diverso da placeholder

3. **Label Non Tradotte**
   - Molti campi hanno label uguali al nome del campo (es. 'edit', 'create', 'attach')
   - Mancanza di traduzioni italiane appropriate

4. **Duplicazioni di Sezioni**
   - File appointment.php ha sezioni 'actions' duplicate
   - Ridondanza che causa confusione

5. **Sintassi Array Inconsistente**
   - Alcuni file usano `array()` invece di `[]`
   - Mancanza di `declare(strict_types=1);`

## Regole Obbligatorie

### 1. **Struttura File**
```php
<?php

declare(strict_types=1);

return [
    // Contenuto del file
];
```

**REQUISITI:**
- ✅ SEMPRE includere `declare(strict_types=1);`
- ✅ SEMPRE usare sintassi breve `[]` invece di `array()`
- ✅ SEMPRE chiudere con `];` e newline

### 2. **Struttura Espansa per Campi**
```php
'fields' => [
    'campo_name' => [
        'label' => 'Etichetta Campo',
        'placeholder' => 'Placeholder diverso da label',
        'tooltip' => 'Tooltip informativo',
        'helper_text' => 'Testo di aiuto specifico e diverso da placeholder',
        'help' => 'Testo di aiuto aggiuntivo',
        'validation' => [
            'required' => 'Messaggio di validazione',
            'min' => 'Messaggio di validazione minimo',
        ],
    ],
],
```

**REQUISITI:**
- ✅ SEMPRE struttura espansa per tutti i campi
- ✅ SEMPRE `helper_text` diverso da `placeholder`
- ✅ SEMPRE `label` tradotta in italiano
- ✅ MAI label uguale al nome del campo

### 3. **Struttura Espansa per Azioni**
```php
'actions' => [
    'action_name' => [
        'label' => 'Etichetta Azione',
        'icon' => 'heroicon-o-icon-name',
        'color' => 'primary|secondary|success|warning|danger',
        'tooltip' => 'Descrizione dell\'azione',
        'modal' => [
            'heading' => 'Titolo Modal',
            'description' => 'Descrizione dettagliata',
            'confirm' => 'Testo conferma',
            'cancel' => 'Testo annulla',
        ],
        'messages' => [
            'success' => 'Messaggio di successo',
            'error' => 'Messaggio di errore',
        ],
    ],
],
```

**REQUISITI:**
- ✅ SEMPRE struttura espansa per tutte le azioni
- ✅ SEMPRE includere modal per azioni distruttive
- ✅ SEMPRE includere messages per feedback utente
- ✅ SEMPRE icon e color appropriati

### 4. **Organizzazione Sezioni**
```php
// Sezioni obbligatorie in ogni file di traduzione
'navigation' => [...],    // Informazioni navigazione
'fields' => [...],        // Campi del form
'actions' => [...],       // Azioni disponibili
'sections' => [...],      // Sezioni del form
'filters' => [...],       // Filtri di ricerca
'messages' => [...],      // Messaggi feedback
'validation' => [...],    // Messaggi validazione
'options' => [...],       // Opzioni predefinite
```

### 5. **Regole di Naming**
- **File**: `nome_entita.php` (snake_case)
- **Chiavi**: `nome_campo` (snake_case)
- **Label**: Testi in italiano completi
- **Icon**: Sempre `heroicon-o-nome-icona`

### 6. **Regole di Contenuto**
- **MAI** duplicare sezioni
- **MAI** usare label uguali al nome del campo
- **MAI** usare helper_text uguale a placeholder
- **SEMPRE** tradurre tutti i testi in italiano
- **SEMPRE** fornire tooltip informativi

## Template Standardizzato

### File Template
Il template completo è disponibile in:
`/laravel/Modules/.translation_template.php`

### Sezioni Obbligatorie
1. **Navigation**: Informazioni per la navigazione
2. **Model**: Informazioni sul modello
3. **Fields**: Campi con struttura espansa
4. **Actions**: Azioni con struttura espansa
5. **Sections**: Sezioni del form
6. **Filters**: Filtri di ricerca
7. **Messages**: Messaggi di feedback
8. **Validation**: Messaggi di validazione
9. **Descriptions**: Descrizioni contestuali
10. **Options**: Opzioni predefinite

## Processo di Standardizzazione

### Fase 1: Analisi
- Identificare file con problemi strutturali
- Catalogare violazioni delle regole
- Prioritizzare per impatto utente

### Fase 2: Backup e Documentazione
- Creare backup dei file originali
- Documentare modifiche necessarie
- Aggiornare documentazione moduli

### Fase 3: Implementazione
- Applicare template standardizzato
- Correggere helper_text duplicati
- Tradurre label non tradotte
- Rimuovere duplicazioni

### Fase 4: Validazione
- Verificare sintassi PHP
- Testare caricamento traduzioni
- Validare coerenza interfaccia

## Esempi di Correzioni

### ❌ PRIMA (Problematico)
```php
return array (
  'fields' => 
  array (
    'edit' => 
    array (
      'label' => 'edit',
    ),
    'helper_text' => 'campo_name',
  ),
);
```

### ✅ DOPO (Corretto)
```php
<?php

declare(strict_types=1);

return [
    'fields' => [
        'edit' => [
            'label' => 'Modifica',
            'placeholder' => 'Seleziona per modificare',
            'tooltip' => 'Modifica l\'entità selezionata',
            'helper_text' => 'Clicca per modificare i dettagli dell\'entità',
            'help' => 'Utilizza questa azione per aggiornare le informazioni',
        ],
    ],
];
```

## Controlli di Qualità

### Validazione Sintassi
```bash
# Verifica sintassi PHP
php -l path/to/translation.php

# Verifica tutti i file di traduzione
find Modules/*/lang -name "*.php" -exec php -l {} \;
```

### Controlli Automatici
```bash
# Cerca helper_text duplicati
grep -r "helper_text.*=>.*'" Modules/*/lang/

# Cerca label non tradotte
grep -r "'label' => '[a-z_]*'," Modules/*/lang/

# Cerca sintassi array vecchia
grep -r "array (" Modules/*/lang/
```

## Best Practice

### 1. **Manutenzione Regolare**
- Eseguire controlli automatici settimanali
- Aggiornare traduzioni quando si modificano funzionalità
- Mantenere coerenza tra moduli

### 2. **Documentazione**
- Documentare ogni modifica nelle docs del modulo
- Mantenere changelog delle traduzioni
- Creare collegamenti bidirezionali

### 3. **Testing**
- Testare interfaccia dopo ogni modifica
- Verificare coerenza visiva
- Validare accessibilità

## Collegamenti

- [Template Standardizzato](../.translation_template.php)
- [Regole Traduzioni Globali](../../docs/translation-standardization.md)
- [Best Practice Laraxot](../../docs/laraxot-conventions.md)

---

**Autore**: Sistema di Standardizzazione Laraxot  
**Data**: 2025-01-06  
**Versione**: 1.0  
**Stato**: Implementazione in corso

