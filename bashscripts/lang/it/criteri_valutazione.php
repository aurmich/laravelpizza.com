>>>>>>> f3d4311a (Squashed 'laravel/Modules/Progressioni/' content from commit 72d99eef1)
<?php

declare(strict_types=1);

return [
    'navigation' => [
        'name' => 'criteri valutazione',
        'plural' => 'criteri valutazione',
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
        'edit' => 'Modifica',
    ],
];
<?php return array (
  'navigation' => 
  array (
    'name' => 'Criteri di Valutazione',
    'plural' => 'Criteri di Valutazione',
    'group' => 
    array (
      'name' => 'Valutazione & KPI',
      'description' => 'Gestione dei criteri di valutazione',
    ),
    'label' => 'Criteri di Valutazione',
    'sort' => 53,
    'icon' => 'performance-criteria-outline',
  ),
  'fields' => 
  array (
    'name' => 
    array (
      'label' => 'Nome',
      'placeholder' => 'Inserisci il nome del criterio',
      'help' => 'Nome identificativo del criterio',
    ),
    'description' => 
    array (
      'label' => 'Descrizione',
      'placeholder' => 'Inserisci la descrizione',
      'help' => 'Descrizione dettagliata del criterio',
    ),
    'peso' => 
    array (
      'label' => 'Peso',
      'placeholder' => 'Inserisci il peso',
      'help' => 'Peso del criterio nella valutazione (1-100)',
    ),
    'tipo' => 
    array (
      'label' => 'Tipo',
      'placeholder' => 'Seleziona il tipo',
      'help' => 'Tipologia del criterio',
      'options' => 
      array (
        'quantitativo' => 'Quantitativo',
        'qualitativo' => 'Qualitativo',
      ),
    ),
    'attivo' => 
    array (
      'label' => 'Attivo',
      'help' => 'Indica se il criterio è attualmente in uso',
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
      'help' => 'Permessi associati al criterio',
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
      'help' => 'Nome del valutatore',
    ),
    'last_name' => 
    array (
      'label' => 'Cognome',
      'placeholder' => 'Inserisci il cognome',
      'help' => 'Cognome del valutatore',
    ),
    'select_all' => 
    array (
      'label' => 'Seleziona Tutto',
      'message' => 'Seleziona tutti gli elementi disponibili',
    ),
    'created_at' => 
    array (
      'label' => 'created_at',
    ),
  ),
  'actions' => 
  array (
    'create' => 
    array (
      'label' => 'Nuovo Criterio',
      'success' => 'Criterio creato con successo',
    ),
    'edit' => 
    array (
      'label' => 'Modifica',
      'success' => 'Criterio aggiornato con successo',
    ),
    'delete' => 
    array (
      'label' => 'Elimina',
      'success' => 'Criterio eliminato con successo',
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
      'filename_prefix' => 'Criteri_Valutazione_',
      'columns' => 
      array (
        'name' => 
        array (
          'label' => 'Nome Criterio',
          'help' => 'Nome del criterio di valutazione',
        ),
        'parent_name' => 
        array (
          'label' => 'Gruppo',
          'help' => 'Gruppo di appartenenza del criterio',
        ),
      ),
    ),
  ),
  'messages' => 
  array (
    'validation' => 
    array (
      'peso' => 
      array (
        'required' => 'Il peso è obbligatorio',
        'numeric' => 'Il peso deve essere numerico',
        'min' => 'Il peso minimo è 1',
        'max' => 'Il peso massimo è 100',
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
      'success' => 'Criterio salvato con successo',
      'error' => 'Errore durante il salvataggio',
    ),
    'delete' => 
    array (
      'success' => 'Criterio eliminato con successo',
      'error' => 'Errore durante l\'eliminazione',
    ),
  ),
);
>>>>>>> 961ad402 (first)
