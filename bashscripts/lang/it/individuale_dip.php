<?php

return array (
  'navigation' => 
  array (
    'name' => 'Performance Dipendenti',
    'plural' => 'Performance Dipendenti',
    'group' => 
    array (
      'name' => 'Valutazione & KPI',
      'description' => 'Gestione delle performance dei dipendenti',
    ),
    'label' => 'Performance Dipendenti',
    'sort' => 59,
    'icon' => 'employee-performance',
  ),
  'fields' => 
  array (
    'dipendente' => 
    array (
      'label' => 'Dipendente',
      'placeholder' => 'Seleziona il dipendente',
      'help' => 'Dipendente da valutare',
    ),
    'matricola' => 
    array (
      'label' => 'Matricola',
      'placeholder' => 'Inserisci la matricola',
      'help' => 'Numero di matricola del dipendente',
    ),
    'periodo' => 
    array (
      'label' => 'Periodo',
      'placeholder' => 'Seleziona il periodo',
      'help' => 'Periodo di valutazione',
      'options' => 
      array (
        'mensile' => 'Mensile',
        'trimestrale' => 'Trimestrale',
        'semestrale' => 'Semestrale',
        'annuale' => 'Annuale',
      ),
    ),
    'risultati_ottenuti' => 
    array (
      'label' => 'Risultati Ottenuti',
      'placeholder' => 'Valuta i risultati',
      'help' => 'Valutazione dei risultati raggiunti',
      'scale' => 
      array (
        1 => 'Insufficiente',
        2 => 'Sufficiente',
        3 => 'Buono',
        4 => 'Ottimo',
        5 => 'Eccellente',
      ),
    ),
    'qualita_prestazione' => 
    array (
      'label' => 'Qualità della Prestazione',
      'placeholder' => 'Valuta la qualità',
      'help' => 'Valutazione della qualità del lavoro',
    ),
    'arricchimento_professionale' => 
    array (
      'label' => 'Crescita Professionale',
      'placeholder' => 'Valuta la crescita',
      'help' => 'Valutazione dello sviluppo professionale',
    ),
    'impegno' => 
    array (
      'label' => 'Impegno',
      'placeholder' => 'Valuta l\'impegno',
      'help' => 'Valutazione dell\'impegno dimostrato',
    ),
    'note' => 
    array (
      'label' => 'Note',
      'placeholder' => 'Inserisci eventuali note',
      'help' => 'Note aggiuntive sulla valutazione',
    ),
    'delete' => 
    array (
      'label' => 'delete',
    ),
    'toggleColumns' => 
    array (
      'label' => 'toggleColumns',
    ),
    'id' => 
    array (
      'label' => 'id',
    ),
    'matr' => 
    array (
      'label' => 'matr',
    ),
    'cognome' => 
    array (
      'label' => 'cognome',
    ),
    'nome' => 
    array (
      'label' => 'nome',
    ),
    'email' => 
    array (
      'label' => 'email',
    ),
    'stabi' => 
    array (
      'label' => 'stabi',
    ),
    'repar' => 
    array (
      'label' => 'repar',
    ),
    'anno' => 
    array (
      'label' => 'anno',
    ),
    'created_at' => 
    array (
      'label' => 'created_at',
    ),
    'updated_at' => 
    array (
      'label' => 'updated_at',
    ),
    'create' => 
    array (
      'label' => 'create',
    ),
    'view' => 
    array (
      'label' => 'view',
    ),
    'edit' => 
    array (
      'label' => 'edit',
    ),
    'openFilters' => 
    array (
      'label' => 'openFilters',
    ),
    'applyFilters' => 
    array (
      'label' => 'applyFilters',
    ),
    'resetFilters' => 
    array (
      'label' => 'resetFilters',
    ),
    'reorderRecords' => 
    array (
      'label' => 'reorderRecords',
    ),
    'value' => 
    array (
      'label' => 'value',
    ),
    'motivo' => 
    array (
      'label' => 'motivo',
    ),
    'ha_diritto' => 
    array (
      'label' => 'ha_diritto',
    ),
    'al' => 
    array (
      'label' => 'al',
    ),
    'dal' => 
    array (
      'label' => 'dal',
    ),
    'repar_txt' => 
    array (
      'label' => 'repar_txt',
    ),
    'stabi_txt' => 
    array (
      'label' => 'stabi_txt',
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
  ),
  'actions' => 
  array (
    'evaluate' => 
    array (
      'label' => 'Valuta',
      'success' => 'Valutazione completata con successo',
    ),
    'approve' => 
    array (
      'label' => 'Approva',
      'success' => 'Valutazione approvata con successo',
    ),
    'reject' => 
    array (
      'label' => 'Rifiuta',
      'success' => 'Valutazione rifiutata',
    ),
    'copy_from_organizzativa' => 
    array (
      'label' => 'copy_from_organizzativa',
    ),
    'create' => 
    array (
      'label' => 'create',
    ),
  ),
  'messages' => 
  array (
    'validation' => 
    array (
      'required' => 'Campo obbligatorio',
      'numeric' => 'Il valore deve essere numerico',
      'min' => 'Il valore minimo è :min',
      'max' => 'Il valore massimo è :max',
    ),
    'status' => 
    array (
      'draft' => 'Bozza',
      'pending' => 'In Attesa',
      'approved' => 'Approvata',
      'rejected' => 'Rifiutata',
    ),
  ),
  'model' => 
  array (
    'label' => 'individuale dip.model',
  ),
);
