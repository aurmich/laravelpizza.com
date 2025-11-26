<?php

declare(strict_types=1);

return [
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
>>>>>>> f3d4311a (Squashed 'laravel/Modules/Progressioni/' content from commit 72d99eef1)
    ],
];
