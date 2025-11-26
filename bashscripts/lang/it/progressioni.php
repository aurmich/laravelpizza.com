<?php

return [
    'navigation' => [
        'name' => 'progressione',
        'plural' => 'progressioni',
        'group' => [
            'name' => 'Admin ',
        ],
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
    'fields' => [
        'name' => 'Nome',
        'parent' => 'Padre',
        'parent.name' => 'Padre',
        'parent_name' => 'Padre',
        'assets' => 'assets',
        'id' => [
            'label' => 'ID',
        ],
        'id_placeholder' => ' ',
        'cognome' => [
            'label' => 'Cognome',
        ],
        'cognome_placeholder' => ' ',
        'nome' => [
            'label' => 'Nome',
        ],
        'nome_placeholder' => ' ',
        'ente' => 'ente',
        'matr' => [
            'label' => 'matr',
        ],
        'motivo_placeholder' => ' ',
        'stabi' => [
            'label' => 'stabi',
        ],
        'stabi_txt' => [
            'label' => 'stabi_txt',
        ],
        'repar' => [
            'label' => 'repar',
        ],
        'repar_txt' => [
            'label' => 'repar_txt',
        ],
        'rep2kd' => 'rep2kd',
        'rep2ka' => 'rep2ka',
        'propro' => [
            'label' => 'propro',
        ],
        'posfun' => [
            'label' => 'posfun',
        ],
        'qua2kd' => 'qua2kd',
        'qua2ka' => 'qua2ka',
        'categoria_eco' => [
            'label' => 'categoria_eco',
        ],
        'anno' => [
            'label' => 'anno',
        ],
        'ha_diritto' => [
            'label' => 'ha_diritto',
        ],
        'motivo' => [
            'label' => 'motivo',
        ],
        'valutatore_id' => [
            'label' => 'valutatore_id',
        ],
        'anno/valutatore' => [
            'label' => 'anno/valutatore',
        ],
        'al' => [
            'label' => 'al',
        ],
        'dal' => [
            'label' => 'dal',
        ],
        'periodo' => [
            'label' => [
                'label' => 'progressioni::progressioni.fields.periodo.label',
            ],
        ],
        'rep' => [
            'label' => 'rep',
        ],
        'mail_sended_at' => [
            'label' => 'mail_sended_at',
        ],
        'lavoratore' => [
            'label' => 'lavoratore',
        ],
        'email' => [
            'label' => 'email',
        ],
        'criteri' => [
            'label' => 'criteri',
        ],
        'gg' => [
            'label' => 'gg',
        ],
        'gg_no_asz' => [
            'label' => 'gg_no_asz',
        ],
        'gg_asz' => [
            'label' => 'gg_asz',
        ],
        'gg_cateco_no_posfun_no_asz' => [
            'label' => 'gg_cateco_no_posfun_no_asz',
        ],
        'eta' => [
            'label' => 'eta',
        ],
        'qua' => [
            'label' => 'qua',
        ],
        'categoria_ecoval' => [
            'label' => 'categoria_ecoval',
        ],
        'posfunval' => [
            'label' => 'posfunval',
        ],
        'posiz' => [
            'label' => 'posiz',
        ],
        'posiz_txt' => [
            'label' => 'posiz_txt',
        ],
        'disci1' => [
            'label' => 'disci1',
        ],
        'disci1_txt' => [
            'label' => 'disci1_txt',
        ],
    ],
    'schede' => [
        'field' => [
            'stabi' => 'stabi',
            'valutatore_id' => 'Valutatore',
            'valutatore_id_placeholder' => '---',
            'year' => 'Anno',
            'year_placeholder' => 'anno es 2019',
            'sort_by_placeholder' => '  ',
            'sort_order_placeholder' => '  ',
        ],
    ],
    'tab' => [
        'index' => 'lista',
        'create' => 'Aggiungi.',
    ],
];
