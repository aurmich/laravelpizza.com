<?php
return array (
  'navigation' =>
  array (
    'name' => 'Assenze Organizzative',
    'plural' => 'Assenze Organizzative',
    'group' =>
    array (
      'name' => 'Valutazione',
      'description' => 'Gestione delle assenze organizzative',
    ),
    'label' => 'assenze',
    'sort' => 9,
    'icon' => 'performance-absence-outline',
  ),
  'fields' =>
  array (
    'name' =>
    array (
      'label' => 'Nome',
      'placeholder' => 'Inserisci il nome',
      'help' => 'Nome dell\'assenza',
    ),
    'tipo_assenza' =>
    array (
      'label' => 'Tipo Assenza',
      'placeholder' => 'Seleziona il tipo',
      'help' => 'Tipo di assenza',
      'options' =>
      array (
        'malattia' => 'Malattia',
        'ferie' => 'Ferie',
        'permesso' => 'Permesso',
        'altro' => 'Altro',
      ),
    ),
    'data_inizio' =>
    array (
      'label' => 'Data Inizio',
      'placeholder' => 'Seleziona la data',
      'help' => 'Data di inizio assenza',
    ),
    'data_fine' =>
    array (
      'label' => 'Data Fine',
      'placeholder' => 'Seleziona la data',
      'help' => 'Data di fine assenza',
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
      'help' => 'Autorizzazioni associate all\'assenza',
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
      'label' => 'Seleziona Tutto',
      'message' => 'Seleziona tutti gli elementi disponibili',
    ),
    'note' =>
    array (
      'label' => 'Note',
      'placeholder' => 'Inserisci eventuali note',
      'help' => 'Note aggiuntive sull\'assenza',
    ),
    'tipo' =>
    array (
      'label' => 'tipo',
    ),
    'codice' =>
    array (
      'label' => 'codice',
    ),
    'descr' =>
    array (
      'label' => 'descr',
    ),
    'anno' =>
    array (
      'label' => 'anno',
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
    'create' =>
    array (
      'label' => 'Nuova Assenza',
      'success' => 'Assenza creata con successo',
    ),
    'edit' =>
    array (
      'label' => 'Modifica',
      'success' => 'Assenza aggiornata con successo',
    ),
    'delete' =>
    array (
      'label' => 'Elimina',
      'success' => 'Assenza eliminata con successo',
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
      'filename_prefix' => 'Assenze_Organizzative_',
      'columns' =>
      array (
        'name' =>
        array (
          'label' => 'Nome Assenza',
          'help' => 'Nome dell\'assenza',
        ),
        'parent_name' =>
        array (
          'label' => 'Reparto',
          'help' => 'Reparto di appartenenza',
        ),
      ),
    ),
  ),
  'messages' =>
  array (
    'validation' =>
    array (
      'data_inizio' =>
      array (
        'required' => 'La data di inizio è obbligatoria',
        'date' => 'La data di inizio deve essere una data valida',
      ),
      'data_fine' =>
      array (
        'required' => 'La data di fine è obbligatoria',
        'date' => 'La data di fine deve essere una data valida',
        'after' => 'La data di fine deve essere successiva alla data di inizio',
      ),
      'tipo_assenza' =>
      array (
        'required' => 'Il tipo di assenza è obbligatorio',
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
      'success' => 'Assenza salvata con successo',
      'error' => 'Errore durante il salvataggio',
    ),
    'delete' =>
    array (
      'success' => 'Assenza eliminata con successo',
      'error' => 'Errore durante l\'eliminazione',
    ),
  ),
  'model' =>
  array (
    'label' => 'organizzativa assenze.model',
  ),
);