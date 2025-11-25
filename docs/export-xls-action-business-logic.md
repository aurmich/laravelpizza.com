# ExportXlsAction - Business Logic Analysis

## Overview
Analisi della business logic per l'azione di esportazione Excel nelle risorse Filament.

## File Analizzato
`Modules/Xot/app/Filament/Actions/Header/ExportXlsAction.php`

## Business Logic

### Scopo Principale
La classe `ExportXlsAction` fornisce un'azione standardizzata per esportare dati da tabelle Filament in formato Excel (.xlsx), con supporto per filtri applicati e campi personalizzabili.

### Funzionalità Core

#### 1. **Configurazione Azione**
```php
$this->translateLabel()
    ->tooltip(__('xot::actions.export_xls'))
    ->icon('heroicon-o-arrow-down-tray')
```

**Business Logic:**
- Icona standard di download (arrow-down-tray)
- Tooltip tradotto automaticamente
- Label traducibile per internazionalizzazione
- Integrazione con sistema traduzioni Xot

#### 2. **Generazione Nome File Dinamico**
```php
$filename = class_basename($livewire).'-'.collect($livewire->tableFilters)->flatten()->implode('-').'.xlsx';
```

**Business Logic:**
- Nome file basato sulla classe della risorsa
- Include filtri applicati nel nome per identificazione
- Formato: `{ResourceName}-{filter1}-{filter2}.xlsx`
- Evita conflitti di nome e facilita organizzazione

#### 3. **Sistema di Traduzioni Chiavi**
```php
$transKey = app(GetTransKeyAction::class)->execute($livewire::class);
$transKey .= '.fields';
```

**Business Logic:**
- Generazione automatica chiave traduzione
- Pattern: `{module}::{resource}.fields`
- Centralizzazione gestione traduzioni
- Coerenza con architettura Xot

#### 4. **Recupero Dati Filtrati**
```php
$query = $livewire->getFilteredTableQuery();
$rows = $query->get();
```

**Business Logic:**
- Rispetta filtri applicati dall'utente
- Esporta solo dati visibili/filtrati
- Utilizza query builder ottimizzata
- Mantiene coerenza con vista tabella

#### 5. **Selezione Campi Personalizzata**
```php
/** @var array<int, string> $fields */
$fields = [];
if (method_exists($resource, 'getXlsFields')) {
    $rawFields = $resource::getXlsFields($livewire->tableFilters);

    if (is_array($rawFields)) {
        $fields = array_map(static function ($field): string {
            if (is_object($field) && method_exists($field, '__toString')) {
                return $field->__toString();
            }
            if (is_scalar($field)) {
                return (string) $field;
            }
            return '';
        }, $rawFields);
    }
}
```

**Business Logic:**
- **Campi Dinamici**: Le risorse possono definire campi specifici per Excel
- **Filtri Context**: I campi possono variare in base ai filtri attivi
- **Type Safety**: Conversione sicura di oggetti e scalari a stringhe
- **Fallback**: Se non definiti, usa campi di default della tabella

#### 6. **Esportazione Excel**
```php
return app(ExportXlsByCollection::class)->execute(
    $rows,
    $filename,
    $transKey,
    array_values($fields)
);
```

**Business Logic:**
- Delegazione a servizio specializzato per Excel
- Passa dati, nome file, chiavi traduzione e campi
- Separazione responsabilità (SRP)
- Riutilizzabilità del componente export

## Architettura e Pattern

### Design Patterns Utilizzati
1. **Command Pattern**: Azione incapsulata e riutilizzabile
2. **Strategy Pattern**: Diversi campi per diverse risorse
3. **Dependency Injection**: Servizi iniettati tramite container
4. **Template Method**: Struttura fissa con variazioni per risorsa

### Integrazione con Filament
- Estende `Action` di Filament per header
- Utilizza `ListRecords` per accesso a filtri e query
- Compatibile con tutte le risorse Filament
- Mantiene UX nativa di Filament

## Conflitti Git Risolti


**Risoluzione:**
- Rimossa label vuota
- Mantenuto tooltip descrittivo
- Eliminati marcatori di conflitto Git

## Casi d'Uso Tipici

### 1. **Report Amministrativi**
```php
// In UserResource:
public static function getXlsFields(array $filters): array
{
    return ['name', 'email', 'created_at', 'last_login'];
}
```

### 2. **Esportazione Filtrata**
```php
// Utente applica filtri:
// - Data: ultima settimana
// - Stato: attivo
// File generato: UserResource-ultima_settimana-attivo.xlsx
```

### 3. **Campi Dinamici per Contesto**
```php
public static function getXlsFields(array $filters): array
{
    $fields = ['id', 'name'];

    if (isset($filters['include_sensitive'])) {
        $fields[] = 'salary';
        $fields[] = 'social_security';
    }

    return $fields;
}
```

## Configurazione Required

### 1. **Aggiunta a Resource**
```php
class UserResource extends Resource
{
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
        ];
    }

    // Campi per Excel (opzionale)
    public static function getXlsFields(array $filters): array
    {
        return ['name', 'email', 'role', 'created_at'];
    }
}
```

### 2. **Configurazione in ListPage**
```php
class ListUsers extends ListRecords
{
    protected function getHeaderActions(): array
    {
        return [
            ExportXlsAction::make(),
        ];
    }
}
```

### 3. **File di Traduzione**
```php
// lang/it/user.php
return [
    'fields' => [
        'name' => 'Nome',
        'email' => 'Email',
        'created_at' => 'Data Creazione',
    ],
];
```

## Vantaggi Business

1. **Standardizzazione**: Pattern uniforme per tutte le risorse
2. **Personalizzazione**: Campi configurabili per risorsa
3. **Performance**: Esporta solo dati filtrati
4. **UX**: Nomi file descrittivi con filtri
5. **I18n**: Supporto completo multilingue
6. **Manutenibilità**: Codice centralizzato e riutilizzabile

## Considerazioni Tecniche

### Performance
- Utilizza `get()` invece di `paginate()` per export completo
- Memory usage proporzionale al dataset
- Considera `chunk()` per dataset molto grandi

### Sicurezza
- Rispetta autorizzazioni della risorsa padre
- Filtra dati in base a permessi utente
- Non espone dati sensibili non autorizzati

### Scalabilità
- Delegazione a servizio separato per ottimizzazioni
- Possibilità di queue per export pesanti
- Cache per traduzioni frequenti

## Conclusioni

L'`ExportXlsAction` fornisce una soluzione robusta e flessibile per l'esportazione dati in contesti amministrativi, con particolare attenzione alla personalizzazione per risorsa e all'esperienza utente.