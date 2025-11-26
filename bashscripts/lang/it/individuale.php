<?php

return array (
  'navigation' => 
  array (
    'name' => 'Performance Individuale',
    'plural' => 'Performance Individuali',
    'group' => 
    array (
      'name' => 'Valutazione & KPI',
      'description' => 'Gestione delle performance individuali',
    ),
    'label' => 'Performance Individuale',
    'sort' => 37,
    'icon' => 'performance-individuale-outline',
  ),
  'fields' => 
  array (
    'name' => 
    array (
      'label' => 'Nome',
      'placeholder' => 'Inserisci il nome',
      'help' => 'Nome della performance individuale',
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
      'message' => 'Seleziona tutti gli elementi',
    ),
    'risultati_ottenuti' => 
    array (
      'label' => 'Conseguimento degli obiettivi',
      'help' => 'Descrizione dei risultati ottenuti',
    ),
    'qualita_prestazione' => 
    array (
      'label' => 'Qualità della Prestazione',
      'help' => 'Valutazione della qualità della prestazione',
    ),
    'arricchimento_professionale' => 
    array (
      'label' => 'Arricchimento Professionale',
      'help' => 'Descrizione dell\'arricchimento professionale',
    ),
    'impegno' => 
    array (
      'label' => 'Impegno',
      'help' => 'Valutazione dell\'impegno',
    ),
    'esperienza_acquisita' => 
    array (
      'label' => 'Esperienza Acquisita',
      'help' => 'Descrizione dell\'esperienza acquisita',
    ),
    'applyFilters' => 
    array (
      'label' => 'applyFilters',
    ),
    'resetFilters' => 
    array (
      'label' => 'resetFilters',
    ),
    'openFilters' => 
    array (
      'label' => 'openFilters',
    ),
    'toggleColumns' => 
    array (
      'label' => 'toggleColumns',
    ),
    'reorderRecords' => 
    array (
      'label' => 'reorderRecords',
    ),
    'value' => 
    array (
      'label' => 'value',
    ),
    'email' => 
    array (
      'label' => 'email',
    ),
    'nome' => 
    array (
      'label' => 'nome',
    ),
    'cognome' => 
    array (
      'label' => 'cognome',
    ),
    'matr' => 
    array (
      'label' => 'matr',
    ),
    'edit' => 
    array (
      'label' => 'edit',
    ),
    'ha_diritto' => 
    array (
      'label' => 'ha_diritto',
    ),
    'motivo' => 
    array (
      'label' => 'motivo',
    ),
    'mail_sended_at' => 
    array (
      'label' => 'mail_sended_at',
    ),
    'totale_punteggio' => 
    array (
      'label' => 'totale_punteggio',
    ),
    'propro' => 
    array (
      'label' => 'propro',
    ),
    'posfun' => 
    array (
      'label' => 'posfun',
    ),
    'categoria_eco' => 
    array (
      'label' => 'categoria_eco',
    ),
    'categoria_ecoval' => 
    array (
      'label' => 'categoria_ecoval',
    ),
    'posfunval' => 
    array (
      'label' => 'posfunval',
    ),
    'posiz' => 
    array (
      'label' => 'posiz',
    ),
    'posiz_txt' => 
    array (
      'label' => 'posiz_txt',
    ),
    'disci1' => 
    array (
      'label' => 'disci1',
    ),
    'disci1_txt' => 
    array (
      'label' => 'disci1_txt',
    ),
    'stabi' => 
    array (
      'label' => 'stabi',
    ),
    'stabi_txt' => 
    array (
      'label' => 'stabi_txt',
    ),
    'repar' => 
    array (
      'label' => 'repar',
    ),
    'repar_txt' => 
    array (
      'label' => 'repar_txt',
    ),
    'dal' => 
    array (
      'label' => 'dal',
    ),
    'al' => 
    array (
      'label' => 'al',
    ),
    'anno' => 
    array (
      'label' => 'anno',
    ),
    'type' => 
    array (
      'label' => 'type',
    ),
    'delete' => 
    array (
      'label' => 'delete',
    ),
    'created_at' => 
    array (
      'label' => 'created_at',
    ),
    'view' => 
    array (
      'label' => 'view',
    ),
    'create' => 
    array (
      'label' => 'create',
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
          'label' => 'File da importare',
          'placeholder' => 'Seleziona un file XLS o CSV',
          'help' => 'Formati supportati: XLS, XLSX, CSV',
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
          'help' => 'Nome dell\'area di performance',
        ),
        'parent_name' => 
        array (
          'label' => 'Area Superiore',
          'help' => 'Nome dell\'area di livello superiore',
        ),
      ),
    ),
    'create' => 
    array (
      'label' => 'create',
    ),
    'copy_from_organizzativa' => 
    array (
      'label' => 'copy_from_organizzativa',
    ),
    'delete' => 
    array (
      'label' => 'delete',
    ),
    'edit' => 
    array (
      'label' => 'edit',
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
      'success' => 'Performance individuale salvata con successo',
      'error' => 'Errore durante il salvataggio',
    ),
    'delete' => 
    array (
      'success' => 'Performance individuale eliminata con successo',
      'error' => 'Errore durante l\'eliminazione',
    ),
  ),
  'title' => 'individuale',
);
