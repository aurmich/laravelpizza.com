<?php

declare(strict_types=1);

return [
    'navigation' => [
>>>>>>> f3d4311a (Squashed 'laravel/Modules/Progressioni/' content from commit 72d99eef1)
        'name' => 'criteri esclusione',
        'plural' => 'criteri esclusione',
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
        'name' => 'Criteri di Esclusione',
        'plural' => 'Criteri di Esclusione',
        'group' => [
            'name' => 'Valutazione & KPI',
            'description' => 'Gestione dei criteri di esclusione',
        ],
        'label' => 'Criteri di Esclusione',
        'sort' => 61,
        'icon' => 'performance-exclusion-outline',
    ],
    'fields' => [
        'name' => [
            'label' => 'Nome',
            'placeholder' => 'Inserisci il nome',
            'help' => 'Nome del criterio di esclusione',
        ],
        'descrizione' => [
            'label' => 'Descrizione',
            'placeholder' => 'Inserisci la descrizione',
            'help' => 'Descrizione dettagliata del criterio',
        ],
        'tipo' => [
            'label' => 'Tipo',
            'placeholder' => 'Seleziona il tipo',
            'help' => 'Tipo di esclusione',
            'options' => [
                'assenza' => 'Assenza',
                'comportamento' => 'Comportamento',
                'performance' => 'Performance',
            ],
        ],
        'attivo' => [
            'label' => 'Attivo',
            'help' => 'Indica se il criterio è attualmente in uso',
        ],
        'data_inizio' => [
            'label' => 'Data Inizio',
            'placeholder' => 'Seleziona la data di inizio',
            'help' => 'Data di inizio validità',
        ],
        'data_fine' => [
            'label' => 'Data Fine',
            'placeholder' => 'Seleziona la data di fine',
            'help' => 'Data di fine validità',
        ],
        'note' => [
            'label' => 'Note',
            'placeholder' => 'Inserisci eventuali note',
            'help' => 'Note aggiuntive sul criterio',
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'Nuovo Criterio',
            'success' => 'Criterio creato con successo',
        ],
        'edit' => [
            'label' => 'Modifica',
            'success' => 'Criterio aggiornato con successo',
        ],
        'delete' => [
            'label' => 'Elimina',
            'success' => 'Criterio eliminato con successo',
        ],
    ],
    'messages' => [
        'validation' => [
            'required' => 'Campo obbligatorio',
            'date' => 'Data non valida',
            'date_after' => 'La data deve essere successiva a :date',
            'date_before' => 'La data deve essere precedente a :date',
        ],
>>>>>>> 961ad402 (first)
    ],
];
