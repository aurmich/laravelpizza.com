<?php

return array (
  'navigation' => 
  array (
    'name' => 'Performance Amministrativa',
    'plural' => 'Performance Amministrative',
    'group' => 
    array (
      'name' => 'Valutazione & KPI',
      'description' => 'Gestione delle performance amministrative',
    ),
    'label' => 'Performance Amministrativa',
    'sort' => 55,
    'icon' => 'performance-individuale-outline',
  ),
  'fields' => 
  array (
    'name' => 
    array (
      'label' => 'Nome',
      'placeholder' => 'Inserisci il nome',
      'help' => 'Nome della performance amministrativa',
    ),
    'guard_name' => 
    array (
      'label' => 'Sistema di Protezione',
      'placeholder' => 'Seleziona il sistema',
      'help' => 'Sistema di protezione utilizzato',
    ),
    'permissions' => 
    array (
      'label' => 'Permessi',
      'placeholder' => 'Seleziona i permessi',
      'help' => 'Permessi associati',
    ),
    'updated_at' => 
    array (
      'label' => 'Aggiornato il',
      'help' => 'Data ultimo aggiornamento',
    ),
    'first_name' => 
    array (
      'label' => 'Nome',
      'placeholder' => 'Inserisci il nome',
      'help' => 'Nome del dipendente',
    ),
    'last_name' => 
    array (
      'label' => 'Cognome',
      'placeholder' => 'Inserisci il cognome',
      'help' => 'Cognome del dipendente',
    ),
    'select_all' => 
    array (
      'label' => 'Seleziona Tutti',
      'help' => '',
    ),
    'create' => 
    array (
      'label' => 'create',
    ),
    'applyFilters' => 
    array (
      'label' => 'applyFilters',
    ),
    'toggleColumns' => 
    array (
      'label' => 'toggleColumns',
    ),
    'matr' => 
    array (
      'label' => 'matr',
    ),
    'cognome' => 
    array (
      'label' => 'cognome',
    ),
    'nome' => 
    array (
      'label' => 'nome',
    ),
    'email' => 
    array (
      'label' => 'email',
    ),
    'stabi_txt' => 
    array (
      'label' => 'stabi_txt',
    ),
    'repar_txt' => 
    array (
      'label' => 'repar_txt',
    ),
    'disci_txt' => 
    array (
      'label' => 'disci_txt',
    ),
    'categoria_eco' => 
    array (
      'label' => 'categoria_eco',
    ),
    'anno' => 
    array (
      'label' => 'anno',
    ),
    'totale_punteggio' => 
    array (
      'label' => 'totale_punteggio',
    ),
    'created_at' => 
    array (
      'label' => 'created_at',
    ),
    'view' => 
    array (
      'label' => 'view',
    ),
    'edit' => 
    array (
      'label' => 'edit',
    ),
    'delete' => 
    array (
      'label' => 'delete',
    ),
    'value' => 
    array (
      'label' => 'value',
    ),
    'openFilters' => 
    array (
      'label' => 'openFilters',
    ),
    'resetFilters' => 
    array (
      'label' => 'resetFilters',
    ),
    'reorderRecords' => 
    array (
      'label' => 'reorderRecords',
    ),
  ),
  'actions' => 
  array (
    'import' => 
    array (
      'fields' => 
      array (
        'import_file' => 
        array (
          'label' => 'Seleziona un file XLS o CSV da caricare',
          'placeholder' => '',
          'help' => '',
        ),
      ),
    ),
    'export' => 
    array (
      'filename_prefix' => 'Aree al',
      'columns' => 
      array (
        'name' => 
        array (
          'label' => 'Nome area',
          'help' => '',
        ),
        'parent_name' => 
        array (
          'label' => 'Nome area livello superiore',
          'help' => '',
        ),
      ),
    ),
    'create' => 
    array (
      'label' => 'create',
    ),
  ),
  'model' => 
  array (
    'label' => 'individuale adm.model',
  ),
);
