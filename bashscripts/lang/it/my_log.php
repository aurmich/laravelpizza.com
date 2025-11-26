>>>>>>> f3d4311a (Squashed 'laravel/Modules/Progressioni/' content from commit 72d99eef1)
<?php

declare(strict_types=1);

return [
    'navigation' => [
        'name' => 'my-log',
        'plural' => 'my-log',
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
    ],
];
<?php 
return array (
  'navigation' => 
  array (
    'name' => 'I Miei Log',
    'plural' => 'I Miei Log',
    'group' => 
    array (
      'name' => 'Valutazione & KPI',
      'description' => 'Visualizzazione dei log personali',
    ),
    'label' => 'I Miei Log',
    'sort' => 56,
    'icon' => 'performance-log-outline',
  ),
  'fields' => 
  array (
    'name' => 
    array (
      'label' => 'Nome',
      'placeholder' => 'Inserisci il nome',
      'help' => 'Nome del log',
    ),
    'descrizione' => 
    array (
      'label' => 'Descrizione',
      'placeholder' => 'Inserisci la descrizione',
      'help' => 'Descrizione dettagliata del log',
    ),
    'data' => 
    array (
      'label' => 'Data',
      'placeholder' => 'Seleziona la data',
      'help' => 'Data del log',
    ),
    'tipo' => 
    array (
      'label' => 'Tipo',
      'placeholder' => 'Seleziona il tipo',
      'help' => 'Tipologia di log',
      'options' => 
      array (
        'info' => 'Informazione',
        'warning' => 'Avviso',
        'error' => 'Errore',
      ),
    ),
    'utente' => 
    array (
      'label' => 'Utente',
      'placeholder' => 'Seleziona l\'utente',
      'help' => 'Utente associato al log',
    ),
  ),
);
>>>>>>> 961ad402 (first)
