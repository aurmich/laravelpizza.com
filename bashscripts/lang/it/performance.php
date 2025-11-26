<?php

return array (
  'fields' => 
  array (
    'name' => 
    array (
      'label' => 'Nome',
      'placeholder' => 'Inserisci il nome',
      'help' => 'Nome della performance',
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
      'help' => 'Seleziona tutti gli elementi',
    ),
    'id' => 
    array (
      'label' => 'ID',
      'help' => 'Identificativo univoco',
    ),
    'email' => 
    array (
      'label' => 'Email',
      'placeholder' => 'Inserisci l\'email',
      'help' => 'Indirizzo email del dipendente',
    ),
    'delete' => 
    array (
      'label' => 'Elimina',
    ),
    'toggleColumns' => 
    array (
      'label' => 'Mostra/Nascondi Colonne',
    ),
    'reorderRecords' => 
    array (
      'label' => 'Riordina Record',
    ),
    'resetFilters' => 
    array (
      'label' => 'Resetta Filtri',
    ),
    'applyFilters' => 
    array (
      'label' => 'Applica Filtri',
    ),
    'openFilters' => 
    array (
      'label' => 'openFilters',
    ),
    'message' => 
    array (
      'label' => 'message',
    ),
  ),
  'actions' => 
  array (
    'import' => 
    array (
      'label' => 'Importa',
      'fields' => 
      array (
        'import_file' => 
        array (
          'label' => 'Seleziona un file XLS o CSV da importare',
          'placeholder' => 'Seleziona un file XLS o CSV',
          'help' => 'Formati supportati: XLS, XLSX, CSV',
        ),
      ),
    ),
    'export' => 
    array (
      'label' => 'Esporta',
      'filename_prefix' => 'Performance_',
      'columns' => 
      array (
        'name' => 
        array (
          'label' => 'Nome',
          'help' => 'Nome della performance',
        ),
        'description' => 
        array (
          'label' => 'Descrizione',
          'help' => 'Descrizione della performance',
        ),
        'status' => 
        array (
          'label' => 'Stato',
          'help' => 'Stato della performance',
        ),
        'created_at' => 
        array (
          'label' => 'Data Creazione',
          'help' => 'Data di creazione della performance',
        ),
        'updated_at' => 
        array (
          'label' => 'Ultimo Aggiornamento',
          'help' => 'Data ultimo aggiornamento della performance',
        ),
      ),
    ),
  ),
  'messages' => 
  array (
    'import' => 
    array (
      'success' => 'Importazione completata con successo',
      'error' => 'Errore durante l\'importazione',
    ),
    'export' => 
    array (
      'success' => 'Esportazione completata con successo',
      'error' => 'Errore durante l\'esportazione',
    ),
    'save' => 
    array (
      'success' => 'Performance salvata con successo',
      'error' => 'Errore durante il salvataggio',
    ),
    'delete' => 
    array (
      'success' => 'Performance eliminata con successo',
      'error' => 'Errore durante l\'eliminazione',
    ),
  ),
  'navigation' => 
  array (
    'name' => 'Performance',
    'plural' => 'Performance',
    'group' => 
    array (
      'name' => 'Valutazione & KPI',
      'description' => 'Gestione delle performance',
    ),
    'label' => 'Performance',
    'icon' => 'performance-chart',
    'sort' => 50,
  ),
  'model' => 
  array (
    'label' => 'performance.model',
  ),
);
