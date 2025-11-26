<?php

return array (
  'navigation' => 
  array (
    'name' => 'Fondo Performance',
    'plural' => 'Fondi Performance',
    'group' => 
    array (
      'name' => 'Valutazione & KPI',
      'description' => 'Gestione dei fondi performance',
    ),
    'label' => 'Fondo Performance',
    'sort' => 54,
    'icon' => 'performance-fund-outline',
  ),
  'fields' => 
  array (
    'name' => 
    array (
      'label' => 'Nome',
      'placeholder' => 'Inserisci il nome',
      'help' => 'Nome del fondo performance',
    ),
    'importo' => 
    array (
      'label' => 'Importo',
      'placeholder' => 'Inserisci l\'importo',
      'help' => 'Importo del fondo',
    ),
    'anno' => 
    array (
      'label' => 'Anno',
      'placeholder' => 'Seleziona l\'anno',
      'help' => 'Anno di riferimento',
    ),
    'guard_name' => 
    array (
      'label' => 'Sistema di Protezione',
      'placeholder' => 'Seleziona il sistema',
      'help' => 'Sistema di autenticazione utilizzato',
    ),
    'permissions' => 
    array (
      'label' => 'Permessi',
      'placeholder' => 'Seleziona i permessi',
      'help' => 'Permessi associati al fondo',
    ),
    'updated_at' => 
    array (
      'label' => 'Aggiornato il',
      'help' => 'Data e ora dell\'ultima modifica',
    ),
    'first_name' => 
    array (
      'label' => 'Nome',
      'placeholder' => 'Inserisci il nome',
      'help' => 'Nome del responsabile',
    ),
    'last_name' => 
    array (
      'label' => 'Cognome',
      'placeholder' => 'Inserisci il cognome',
      'help' => 'Cognome del responsabile',
    ),
    'select_all' => 
    array (
      'label' => 'Seleziona Tutto',
      'message' => 'Seleziona tutti gli elementi disponibili',
    ),
    'stato' => 
    array (
      'label' => 'Stato',
      'placeholder' => 'Seleziona lo stato',
      'help' => 'Stato attuale del fondo',
      'options' => 
      array (
        'attivo' => 'Attivo',
        'chiuso' => 'Chiuso',
        'in_revisione' => 'In Revisione',
      ),
    ),
    'toggleColumns' => 
    array (
      'label' => 'toggleColumns',
    ),
    'reorderRecords' => 
    array (
      'label' => 'reorderRecords',
    ),
    'resetFilters' => 
    array (
      'label' => 'resetFilters',
    ),
  ),
  'actions' => 
  array (
    'create' => 
    array (
      'label' => 'Nuovo Fondo',
      'success' => 'Fondo creato con successo',
    ),
    'edit' => 
    array (
      'label' => 'Modifica',
      'success' => 'Fondo aggiornato con successo',
    ),
    'delete' => 
    array (
      'label' => 'Elimina',
      'success' => 'Fondo eliminato con successo',
    ),
    'import' => 
    array (
      'label' => 'Importa',
      'fields' => 
      array (
        'import_file' => 
        array (
          'label' => 'File da importare',
          'placeholder' => 'Seleziona un file XLS o CSV',
          'help' => 'Formati supportati: XLS, XLSX, CSV',
        ),
      ),
    ),
    'export' => 
    array (
      'label' => 'Esporta',
      'filename_prefix' => 'Fondi_Performance_',
      'columns' => 
      array (
        'name' => 
        array (
          'label' => 'Nome Fondo',
          'help' => 'Nome del fondo performance',
        ),
        'parent_name' => 
        array (
          'label' => 'Area',
          'help' => 'Area di appartenenza',
        ),
      ),
    ),
  ),
  'messages' => 
  array (
    'validation' => 
    array (
      'importo' => 
      array (
        'required' => 'L\'importo è obbligatorio',
        'numeric' => 'L\'importo deve essere numerico',
        'min' => 'L\'importo deve essere maggiore di zero',
      ),
      'anno' => 
      array (
        'required' => 'L\'anno è obbligatorio',
        'numeric' => 'L\'anno deve essere numerico',
      ),
    ),
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
      'success' => 'Fondo salvato con successo',
      'error' => 'Errore durante il salvataggio',
    ),
    'delete' => 
    array (
      'success' => 'Fondo eliminato con successo',
      'error' => 'Errore durante l\'eliminazione',
    ),
  ),
);
