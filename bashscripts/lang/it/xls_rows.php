<?php

declare(strict_types=1);

return [
    'navigation' => [
        'name' => 'xls rows',
        'plural' => 'xls rows',
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
    'id' => 'id',
    'ente' => 'ente',
    'matr' => 'matr',
    'cognome' => 'cognome',
    'nome' => 'nome',
    'ptime' => 'part-time',
    'valore_differenziale_rapportato_pt' => 'valore differenziale rapportato a tempo parziale',
    'categoria_eco' => 'posizione economica',
    'categoria_ecoval' => 'categoria giuridica',
    'excellences_count_last_3_years' => 'a) eccellenza',
    'gg_cateco_posfun_no_asz' => 'esperienza nella posizione economica',
    'perf_ind_media' => 'b) valutazione media performance',
    'punt_progressione' => 'conoscenza valutazione dirigente',
    'punt_progressione_finale' => 'punteggio totale',
    'benificiario_progressione' => 'beneficiario progressione',
    'gg_cateco_posfun' => 'c) gg. anzianità nella posiz. economica',
    'gg_in_sede_no_asz' => 'd) anzianità di servizio presso l\'Ente',
    'eta' => 'e) età',
    'gg_cateco_posfun_in_sede_no_asz' => 'gg_cateco_posfun_in_sede_no_asz',
];
