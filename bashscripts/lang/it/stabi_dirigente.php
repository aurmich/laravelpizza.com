<?php return array (
  'resource' => 
  array (
    'name' => 'Stabi diri',
  ),
  'navigation' => 
  array (
    'name' => 'Stabi diri',
    'plural' => 'Stabi diri',
    'group' => 
    array (
      'name' => 'Admin',
    ),
  ),
  'fields' => 
  array (
    'brand' => 'Marca',
    'model' => 'Modello',
    'description' => 'Descrizione',
    'serial_number' => 'Numero di serie',
    'inventory_number' => 'Codice inventario',
    'code' => 'Identificativo',
    'manufacturing_year' => 'Anno di fabbricazione',
    'purchase_year' => 'Anno di acquisto',
    'is_enabled' => 'È attivo?',
    'asset_type' => 'Tipologia',
    'area' => 'Area',
    'parent' => 'Asset genitore',
    'name' => 'Nome',
    'id' => 
    array (
      'label' => 'ID',
    ),
    'valutatore_id' => 
    array (
      'label' => 'Valutatore Id',
    ),
    'stabi' => 
    array (
      'label' => 'Stabi',
    ),
    'repar' => 
    array (
      'label' => 'Repar',
    ),
    'anno' => 
    array (
      'label' => 'Anno',
    ),
    'matr' => 
    array (
      'label' => 'Matricola',
    ),
    'cognome' => 
    array (
      'label' => 'Cognome',
    ),
    'nome' => 
    array (
      'label' => 'Nome',
    ),
    'nome_stabi' => 
    array (
      'label' => 'Nome Stabi',
    ),
    'nome_diri' => 
    array (
      'label' => 'Nome diri',
    ),
    'nome_diri_plus' => 
    array (
      'label' => 'Nome diri Plus',
>>>>>>> dc18abbe (first)
    ),
    'delete' => 
    array (
      'label' => 'delete',
    ),
    'edit' => 
    array (
      'label' => 'edit',
    ),
    'view' => 
    array (
      'label' => 'view',
    ),
    'email' => 
    array (
      'label' => 'email',
>>>>>>> dc18abbe (first)
    ),
  ),
  'actions' => 
  array (
<?php

declare(strict_types=1);

return [
    'enable' => 
    array (
      'cta' => 'Attiva',
    ),
    'disable' => 
    array (
      'cta' => 'Dismetti',
    ),
    'import' => 
    array (
      'row_number' => 'Riga :row',
      'fields' => 
      array (
        'import_file' => 'Seleziona un file XLS o CSV da caricare',
      ),
    ),
    'export' => 
    array (
      'filename_prefix' => 'Lista asset al',
      'columns' => 
      array (
>>>>>>> dc18abbe (first)
        'brand' => 'Marca',
        'model' => 'Modello',
        'description' => 'Descrizione',
        'serial_number' => 'Numero di serie',
        'inventory_number' => 'Codice inventario',
        'code' => 'Identificativo',
        'manufacturing_year' => 'Anno di fabbricazione',
        'purchase_year' => 'Anno di acquisto',
        'is_enabled' => 'È attivo?',
        'asset_type' => 'Tipologia',
    'navigation' => [
        'name' => 'stabi dirigente',
        'plural' => 'stabi dirigente',
        'group' => [
            'name' => 'Admin ',
        ],
    ],
    'fields' => [
        'name' => 'Nome',
        'parent' => 'Padre',
        'parent.name' => 'Padre',
        'parent_name' => 'Padre',
        'assets' => 'assets',
    ],
    'actions' => [
        'import' => [
            'name' => 'Importa da file',
>>>>>>> f3d4311a (Squashed 'laravel/Modules/Progressioni/' content from commit 72d99eef1)
            'fields' => [
                'import_file' => 'Seleziona un file XLS o CSV da caricare',
            ],
        ],
        'export' => [
            'name' => 'Esporta dati',
            'filename_prefix' => 'Aree al',
            'columns' => [
                'name' => 'Nome area',
                'parent_name' => 'Nome area livello superiore',
            ],
        ],
    ],
    'tab' => [
        'index' => 'lista',
        'create' => 'aggiungi',
    ],
];
    'navigation' => [
        'name' => 'Performance Dirigenziale',
        'plural' => 'Performance Dirigenziali',
        'group' => [
            'name' => 'Valutazione & KPI',
            'description' => 'Gestione delle performance dei dirigenti',
        ],
        'label' => 'Performance Dirigenziale',
        'sort' => 58,
        'icon' => 'performance-manager',
    ],
    'fields' => [
        'name' => [
            'label' => 'Nome',
            'placeholder' => 'Inserisci il nome',
            'help' => 'Nome della performance dirigenziale',
        ],
        'dirigente' => [
            'label' => 'Dirigente',
            'placeholder' => 'Seleziona il dirigente',
            'help' => 'Dirigente di riferimento',
        ],
        'struttura' => [
            'label' => 'Struttura',
            'placeholder' => 'Seleziona la struttura',
            'help' => 'Struttura organizzativa',
        ],
        'anno' => [
            'label' => 'Anno',
            'placeholder' => 'Seleziona l\'anno',
            'help' => 'Anno di riferimento',
        ],
        'punteggio' => [
            'label' => 'Punteggio',
            'placeholder' => 'Inserisci il punteggio',
            'help' => 'Punteggio della performance',
        ],
        'guard_name' => [
            'label' => 'Sistema di Protezione',
            'placeholder' => 'Seleziona il sistema',
            'help' => 'Sistema di protezione utilizzato',
        ],
        'permissions' => [
            'label' => 'Permessi',
            'placeholder' => 'Seleziona i permessi',
            'help' => 'Permessi associati',
        ],
        'updated_at' => [
            'label' => 'Aggiornato il',
            'help' => 'Data ultimo aggiornamento',
        ],
        'first_name' => [
            'label' => 'Nome',
            'placeholder' => 'Inserisci il nome',
            'help' => 'Nome del dirigente',
        ],
        'last_name' => [
            'label' => 'Cognome',
            'placeholder' => 'Inserisci il cognome',
            'help' => 'Cognome del dirigente',
        ],
        'select_all' => [
            'label' => 'Seleziona Tutto',
            'message' => 'Seleziona tutti gli elementi disponibili',
        ],
        'stabilimento' => [
            'label' => 'Stabilimento',
            'placeholder' => 'Seleziona lo stabilimento',
            'help' => 'Stabilimento di riferimento',
        ],
        'ruolo' => [
            'label' => 'Ruolo',
            'placeholder' => 'Seleziona il ruolo',
            'help' => 'Ruolo del dirigente nello stabilimento',
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'Nuovo Dirigente',
            'success' => 'Dirigente creato con successo',
        ],
        'edit' => [
            'label' => 'Modifica',
            'success' => 'Dirigente aggiornato con successo',
        ],
        'delete' => [
            'label' => 'Elimina',
            'success' => 'Dirigente eliminato con successo',
        ],
        'import' => [
            'label' => 'Importa',
            'fields' => [
                'import_file' => [
                    'label' => 'File da importare',
                    'placeholder' => 'Seleziona un file XLS o CSV',
                    'help' => 'Formati supportati: XLS, XLSX, CSV',
                ],
            ],
        ],
        'export' => [
            'label' => 'Esporta',
            'filename_prefix' => 'Stabilimenti_Dirigenti_',
            'columns' => [
                'name' => [
                    'label' => 'Nome Stabilimento',
                    'help' => 'Nome dello stabilimento',
                ],
                'parent_name' => [
                    'label' => 'Area',
                    'help' => 'Area di appartenenza',
                ],
            ],
        ],
    ],
    'messages' => [
        'validation' => [
            'stabilimento' => [
                'required' => 'Lo stabilimento è obbligatorio',
            ],
            'ruolo' => [
                'required' => 'Il ruolo è obbligatorio',
            ],
        ],
        'import' => [
            'success' => 'Importazione completata con successo',
            'error' => 'Errore durante l\'importazione',
        ],
        'export' => [
            'success' => 'Esportazione completata con successo',
            'error' => 'Errore durante l\'esportazione',
        ],
        'save' => [
            'success' => 'Dirigente salvato con successo',
            'error' => 'Errore durante il salvataggio',
        ],
        'delete' => [
            'success' => 'Dirigente eliminato con successo',
            'error' => 'Errore durante l\'eliminazione',
        ],
    ],
];
>>>>>>> 961ad402 (first)
