<?php

>>>>>>> bdeae81f (first)
declare(strict_types=1);

return [
    'navigation' => [
        'name' => 'Tenant',
>>>>>>> bdeae81f (first)
        'plural' => 'Tenants',
        'group' => [
            'name' => 'Gestione Utenti',
            'description' => 'Gestione dei tenant e delle loro configurazioni',
        ],
        'label' => 'tenant',
        'sort' => 30,
        'icon' => 'user-user-tenant',
    ],
    'table' => [
        'heading' => 'Tenant',
    ],
    'fields' => [
        'first_name' => 'Nome',
        'last_name' => 'Cognome',
        'secondary_color' => [
            'label' => 'secondary_color',
        ],
        'slug' => [
            'label' => 'slug',
        ],
        'name' => [
            'label' => 'name',
        ],
        'id' => [
            'label' => 'id',
        ],
        'message' => [
            'label' => 'message',
        ],
        'resetFilters' => [
            'label' => 'resetFilters',
        ],
        'applyFilters' => [
            'label' => 'applyFilters',
        ],
    ],
    'actions' => [
        'import' => [
            'fields' => [
                'import_file' => 'Seleziona un file XLS o CSV da caricare',
            ],
        ],
        'export' => [
            'filename_prefix' => 'Aree al',
            'columns' => [
                'name' => 'Nome area',
                'parent_name' => 'Nome area livello superiore',
            ],
        ],
        'change_password' => 'Cambio password',
        'group' => 'Sistema',
        'sort' => 25,
        'icon' => 'tenant-main-animated',
        'badge' => [
            'color' => 'success',
            'label' => 'Multi-tenant',
        ],
    ],

    'sections' => [
        'building' => [
            'navigation' => [
                'name' => 'Edifici',
                'group' => 'Tenant',
                'sort' => 10,
                'icon' => 'tenant-building-animated',
                'badge' => [
                    'color' => 'info',
                    'label' => 'Gestione',
                ],
            ],
            'fields' => [
                'name' => 'Nome',
                'address' => 'Indirizzo',
                'units' => 'Unità',
                'manager' => 'Amministratore',
                'status' => 'Stato',
                'notes' => 'Note',
            ],
        ],

        'unit' => [
            'navigation' => [
                'name' => 'Unità Immobiliari',
                'group' => 'Tenant',
                'sort' => 20,
                'icon' => 'tenant-unit-icon',
                'badge' => [
                    'color' => 'warning',
                    'label' => 'Occupazione',
                ],
            ],
            'fields' => [
                'number' => 'Numero',
                'floor' => 'Piano',
                'type' => 'Tipologia',
                'size' => 'Metratura',
                'tenant' => 'Inquilino',
                'rent' => 'Canone',
                'status' => 'Stato',
            ],
            'types' => [
                'apartment' => 'Appartamento',
                'office' => 'Ufficio',
                'store' => 'Negozio',
                'warehouse' => 'Magazzino',
            ],
        ],

        'tenant' => [
            'navigation' => [
                'name' => 'Inquilini',
                'group' => 'Tenant',
                'sort' => 30,
                'icon' => 'tenant-person-icon',
                'badge' => [
                    'color' => 'primary',
                    'label' => 'Contratti',
                ],
            ],
            'fields' => [
                'name' => 'Nome',
                'surname' => 'Cognome',
                'tax_code' => 'Codice Fiscale',
                'email' => 'Email',
                'phone' => 'Telefono',
                'contract_start' => 'Inizio Contratto',
                'contract_end' => 'Fine Contratto',
                'deposit' => 'Deposito Cauzionale',
            ],
        ],
    ],

    'common' => [
        'status' => [
            'active' => 'Attivo',
            'inactive' => 'Inattivo',
            'maintenance' => 'In Manutenzione',
            'reserved' => 'Riservato',
        ],
        'actions' => [
            'create' => 'Crea',
            'edit' => 'Modifica',
            'delete' => 'Elimina',
            'view' => 'Visualizza',
            'assign' => 'Assegna',
            'unassign' => 'Rimuovi Assegnazione',
            'renew' => 'Rinnova',
            'terminate' => 'Termina',
        ],
        'messages' => [
            'success' => [
                'created' => 'Creato con successo',
                'updated' => 'Aggiornato con successo',
                'deleted' => 'Eliminato con successo',
                'assigned' => 'Assegnato con successo',
                'unassigned' => 'Assegnazione rimossa con successo',
            ],
            'error' => [
                'create' => 'Errore durante la creazione',
                'update' => 'Errore durante l\'aggiornamento',
                'delete' => 'Errore durante l\'eliminazione',
                'assign' => 'Errore durante l\'assegnazione',
                'unassign' => 'Errore durante la rimozione dell\'assegnazione',
            ],
            'confirm' => [
                'delete' => 'Sei sicuro di voler eliminare questo elemento?',
                'terminate' => 'Sei sicuro di voler terminare questo contratto?',
            ],
        ],
        'filters' => [
            'status' => 'Stato',
            'type' => 'Tipo',
            'floor' => 'Piano',
            'date_range' => 'Periodo',
            'occupation' => 'Occupazione',
        ],
return array (
  'navigation' => 
  array (
    'name' => 'Tenant',
    'plural' => 'Tenants',
    'group' => 
    array (
      'name' => 'Gestione Utenti',
      'description' => 'Gestione dei tenant e delle loro configurazioni',
    ),
    'label' => 'tenant',
    'sort' => 30,
    'icon' => 'user-user-tenant',
  ),
  'table' => 
  array (
    'heading' => 'Tenant',
  ),
  'fields' => 
  array (
    'first_name' => 'Nome',
    'last_name' => 'Cognome',
    'secondary_color' => 
    array (
      'label' => 'secondary_color',
    ),
    'slug' => 
    array (
      'label' => 'slug',
    ),
    'name' => 
    array (
      'label' => 'name',
    ),
    'id' => 
    array (
      'label' => 'id',
    ),
    'message' => 
    array (
      'label' => 'message',
    ),
    'resetFilters' => 
    array (
      'label' => 'resetFilters',
    ),
    'applyFilters' => 
    array (
      'label' => 'applyFilters',
    ),
    'openFilters' => 
    array (
      'label' => 'openFilters',
    ),
  ),
  'actions' => 
  array (
    'import' => 
    array (
      'fields' => 
      array (
        'import_file' => 'Seleziona un file XLS o CSV da caricare',
      ),
    ),
    'export' => 
    array (
      'filename_prefix' => 'Aree al',
      'columns' => 
      array (
        'name' => 'Nome area',
        'parent_name' => 'Nome area livello superiore',
      ),
    ),
    'change_password' => 'Cambio password',
  ),
);
>>>>>>> e83070fd (.)
