<?php

return array (
  'navigation' => 
  array (
    'name' => 'Totale Stabilimenti',
    'plural' => 'Totali Stabilimenti',
    'group' => 
    array (
      'name' => 'Valutazione',
      'description' => 'Gestione dei totali per stabilimento',
    ),
    'label' => 'totali',
    'sort' => 85,
    'icon' => 'performance-building',
  ),
  'fields' => 
  array (
    'name' => 
    array (
      'label' => 'Nome',
      'placeholder' => 'Inserisci il nome',
      'help' => 'Nome dello stabilimento',
    ),
    'totale' => 
    array (
      'label' => 'Totale',
      'placeholder' => 'Inserisci il totale',
      'help' => 'Totale performance dello stabilimento',
    ),
    'periodo' => 
    array (
      'label' => 'Periodo',
      'placeholder' => 'Seleziona il periodo',
      'help' => 'Periodo di riferimento',
    ),
    'guard_name' => 
    array (
      'label' => 'Sistema di Protezione',
      'placeholder' => 'Seleziona il sistema',
      'help' => 'Sistema di autenticazione utilizzato',
    ),
    'permissions' => 
    array (
      'label' => 'Autorizzazioni',
      'placeholder' => 'Seleziona le autorizzazioni',
      'help' => 'Autorizzazioni associate allo stabilimento',
    ),
    'updated_at' => 
    array (
      'label' => 'Ultimo aggiornamento',
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
    'dipendenti' => 
    array (
      'label' => 'Dipendenti',
      'placeholder' => 'Numero dipendenti',
      'help' => 'Numero totale dei dipendenti',
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
      'label' => 'Nuovo Totale',
      'success' => 'Totale creato con successo',
    ),
    'edit' => 
    array (
      'label' => 'Modifica',
      'success' => 'Totale aggiornato con successo',
    ),
    'delete' => 
    array (
      'label' => 'Elimina',
      'success' => 'Totale eliminato con successo',
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
      'filename_prefix' => 'Totali_Stabilimenti_',
      'columns' => 
      array (
        'name' => 
        array (
          'label' => 'Nome Stabilimento',
          'help' => 'Nome dello stabilimento',
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
      'totale' => 
      array (
        'required' => 'Il totale è obbligatorio',
        'numeric' => 'Il totale deve essere numerico',
        'min' => 'Il totale deve essere maggiore di zero',
      ),
      'periodo' => 
      array (
        'required' => 'Il periodo è obbligatorio',
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
      'success' => 'Totale salvato con successo',
      'error' => 'Errore durante il salvataggio',
    ),
    'delete' => 
    array (
      'success' => 'Totale eliminato con successo',
      'error' => 'Errore durante l\'eliminazione',
    ),
  ),
);
