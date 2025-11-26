<?php

return array (
  'navigation' => 
  array (
    'name' => 'Opzioni Performance',
    'plural' => 'Opzioni Performance',
    'group' => 
    array (
      'name' => 'Valutazione & KPI',
      'description' => 'Gestione delle opzioni di performance',
    ),
    'label' => 'performance_options',
    'sort' => 57,
    'icon' => 'performance-option-outline',
  ),
  'fields' => 
  array (
    'name' => 'Nome',
    'guard_name' => 'Guard',
    'permissions' => 'Permessi',
    'updated_at' => 
    array (
      'label' => 'Aggiornato il',
    ),
    'first_name' => 'Nome',
    'last_name' => 'Cognome',
    'select_all' => 
    array (
      'name' => 'Seleziona Tutti',
      'message' => '',
    ),
    'post_type' => 
    array (
      'label' => 'post_type',
    ),
    'post_id' => 
    array (
      'label' => 'post_id',
    ),
    'meta_key' => 
    array (
      'label' => 'meta_key',
    ),
    'meta_value' => 
    array (
      'label' => 'meta_value',
    ),
    'created_at' => 
    array (
      'label' => 'created_at',
    ),
    'create' => 
    array (
      'label' => 'create',
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
    'openFilters' => 
    array (
      'label' => 'openFilters',
    ),
    'applyFilters' => 
    array (
      'label' => 'applyFilters',
    ),
    'resetFilters' => 
    array (
      'label' => 'resetFilters',
    ),
    'reorderRecords' => 
    array (
      'label' => 'reorderRecords',
    ),
    'toggleColumns' => 
    array (
      'label' => 'toggleColumns',
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
    'create' => 
    array (
      'label' => 'create',
    ),
  ),
  'model' => 
  array (
    'label' => 'option.model',
  ),
);