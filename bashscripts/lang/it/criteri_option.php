<?php

declare(strict_types=1);

return [
    'navigation' => [
>>>>>>> f3d4311a (Squashed 'laravel/Modules/Progressioni/' content from commit 72d99eef1)
        'name' => 'criteri option',
        'plural' => 'criteri option',
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
        'name' => 'Opzioni Criteri',
        'plural' => 'Opzioni Criteri',
        'group' => [
            'name' => 'Valutazione & KPI',
            'description' => 'Gestione delle opzioni dei criteri',
        ],
        'label' => 'Opzioni Criteri',
        'sort' => 60,
        'icon' => 'performance-option-outline',
    ],
    'fields' => [
        'name' => [
            'label' => 'Nome',
            'placeholder' => 'Inserisci il nome',
            'help' => 'Nome dell\'opzione',
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
            'help' => 'Data di ultimo aggiornamento',
        ],
        'first_name' => [
            'label' => 'Nome',
            'placeholder' => 'Inserisci il nome',
            'help' => 'Nome dell\'utente',
        ],
        'last_name' => [
            'label' => 'Cognome',
            'placeholder' => 'Inserisci il cognome',
            'help' => 'Cognome dell\'utente',
        ],
        'select_all' => [
            'label' => 'Seleziona Tutti',
            'help' => 'Seleziona tutte le opzioni',
        ],
        'valore' => [
            'label' => 'Valore',
            'placeholder' => 'Inserisci il valore',
            'help' => 'Valore dell\'opzione',
        ],
        'descrizione' => [
            'label' => 'Descrizione',
            'placeholder' => 'Inserisci la descrizione',
            'help' => 'Descrizione dettagliata dell\'opzione',
        ],
    ],
    'actions' => [
        'import' => [
            'fields' => [
                'import_file' => [
                    'label' => 'File da importare',
                    'placeholder' => 'Seleziona un file XLS o CSV',
                    'help' => 'Seleziona il file da importare (formati supportati: XLS, CSV)',
                ],
            ],
        ],
        'export' => [
            'filename_prefix' => 'Criteri_Opzioni_',
            'columns' => [
                'name' => [
                    'label' => 'Nome',
                    'help' => 'Nome dell\'opzione',
                ],
                'valore' => [
                    'label' => 'Valore',
                    'help' => 'Valore dell\'opzione',
                ],
            ],
        ],
    ],
];
>>>>>>> 961ad402 (first)
