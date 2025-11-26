<?php

declare(strict_types=1);

return [
    'navigation' => [
        'name' => 'Performance PO',
        'plural' => 'Performance PO',
        'group' => [
            'name' => 'Valutazione & KPI',
            'description' => 'Gestione delle performance delle Posizioni Organizzative',
        ],
        'label' => 'Performance PO',
        'sort' => 60,
        'icon' => 'po-performance',
    ],
    'fields' => [
        'posizione' => [
            'label' => 'Posizione Organizzativa',
            'placeholder' => 'Seleziona la PO',
            'help' => 'Posizione Organizzativa da valutare',
        ],
        'responsabile' => [
            'label' => 'Responsabile',
            'placeholder' => 'Seleziona il responsabile',
            'help' => 'Responsabile della posizione organizzativa',
        ],
        'periodo' => [
            'label' => 'Periodo',
            'placeholder' => 'Seleziona il periodo',
            'help' => 'Periodo di valutazione',
            'options' => [
                'mensile' => 'Mensile',
                'trimestrale' => 'Trimestrale',
                'semestrale' => 'Semestrale',
                'annuale' => 'Annuale',
            ],
        ],
        'risultati_ottenuti' => [
            'label' => 'Conseguimento Obiettivi',
            'placeholder' => 'Valuta il conseguimento',
            'help' => 'Valutazione del conseguimento degli obiettivi',
        ],
        'qualita_prestazione' => [
            'label' => 'Monitoraggio Processi',
            'placeholder' => 'Valuta il monitoraggio',
            'help' => 'Valutazione del monitoraggio delle attività',
        ],
        'arricchimento_professionale' => [
            'label' => 'Clima Lavorativo',
            'placeholder' => 'Valuta il clima',
            'help' => 'Valutazione delle strategie di miglioramento del clima',
        ],
        'impegno' => [
            'label' => 'Programmazione Attività',
            'placeholder' => 'Valuta la programmazione',
            'help' => 'Valutazione dell\'organizzazione delle attività',
        ],
        'esperienza_acquisita' => [
            'label' => 'Comunicazione Risultati',
            'placeholder' => 'Valuta la comunicazione',
            'help' => 'Valutazione della condivisione dei risultati',
        ],
        'punteggio_totale' => [
            'label' => 'Punteggio Totale',
            'help' => 'Punteggio complessivo della valutazione',
        ],
    ],
    'actions' => [
        'evaluate' => [
            'label' => 'Valuta',
            'success' => 'Valutazione completata con successo',
        ],
        'approve' => [
            'label' => 'Approva',
            'success' => 'Valutazione approvata con successo',
        ],
        'reject' => [
            'label' => 'Rifiuta',
            'success' => 'Valutazione rifiutata',
        ],
        'calculate' => [
            'label' => 'Calcola Punteggio',
            'success' => 'Punteggio calcolato con successo',
        ],
    ],
    'messages' => [
        'validation' => [
            'required' => 'Campo obbligatorio',
            'numeric' => 'Il valore deve essere numerico',
            'min' => 'Il valore minimo è :min',
            'max' => 'Il valore massimo è :max',
        ],
        'status' => [
            'draft' => 'Bozza',
            'pending' => 'In Attesa di Approvazione',
            'approved' => 'Approvata',
            'rejected' => 'Rifiutata',
        ],
    ],
];