<?php

return array (
  'navigation' => 
  array (
    'name' => 'Performance Regionale',
    'plural' => 'Performance Regionali',
    'group' => 
    array (
      'name' => 'Valutazione & KPI',
      'description' => 'Gestione delle performance regionali',
    ),
    'label' => 'Performance Regionale',
    'sort' => 57,
    'icon' => 'performance-regional-outline',
  ),
  'fields' => 
  array (
    'regione' => 
    array (
      'name' => 
      array (
        'label' => 'Nome Regione',
        'placeholder' => 'Inserisci il nome della regione',
        'help' => 'Nome della regione di riferimento',
      ),
      'codice' => 
      array (
        'label' => 'Codice Regione',
        'placeholder' => 'Inserisci il codice regionale',
        'help' => 'Codice identificativo della regione',
      ),
      'area' => 
      array (
        'label' => 'Area Geografica',
        'placeholder' => 'Seleziona l\'area',
        'help' => 'Area geografica di appartenenza',
        'options' => 
        array (
          'nord' => 'Nord',
          'centro' => 'Centro',
          'sud' => 'Sud',
          'isole' => 'Isole',
        ),
      ),
    ),
    'performance' => 
    array (
      'totale' => 
      array (
        'label' => 'Totale Performance',
        'placeholder' => 'Inserisci il totale',
        'help' => 'Punteggio totale delle performance regionali',
      ),
      'media' => 
      array (
        'label' => 'Media Performance',
        'help' => 'Media delle performance degli stabilimenti',
      ),
      'trend' => 
      array (
        'label' => 'Trend',
        'help' => 'Andamento rispetto al periodo precedente',
        'options' => 
        array (
          'crescita' => 'In Crescita',
          'stabile' => 'Stabile',
          'decrescita' => 'In Decrescita',
        ),
      ),
    ),
    'stabilimenti' => 
    array (
      'numero' => 
      array (
        'label' => 'Numero Stabilimenti',
        'help' => 'Totale stabilimenti nella regione',
      ),
      'attivi' => 
      array (
        'label' => 'Stabilimenti Attivi',
        'help' => 'Numero di stabilimenti operativi',
      ),
      'valutati' => 
      array (
        'label' => 'Stabilimenti Valutati',
        'help' => 'Numero di stabilimenti con valutazione completa',
      ),
    ),
    'periodo' => 
    array (
      'inizio' => 
      array (
        'label' => 'Data Inizio',
        'placeholder' => 'Seleziona la data di inizio',
        'help' => 'Inizio del periodo di valutazione',
      ),
      'fine' => 
      array (
        'label' => 'Data Fine',
        'placeholder' => 'Seleziona la data di fine',
        'help' => 'Fine del periodo di valutazione',
      ),
    ),
    'timestamps' => 
    array (
      'created_at' => 
      array (
        'label' => 'Data Creazione',
        'help' => 'Data di creazione del record',
      ),
      'updated_at' => 
      array (
        'label' => 'Ultimo Aggiornamento',
        'help' => 'Data dell\'ultima modifica',
      ),
    ),
    'anno' => 
    array (
      'label' => 'anno',
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
    'repar' => 
    array (
      'label' => 'repar',
    ),
    'stabi_txt' => 
    array (
      'label' => 'stabi_txt',
    ),
    'stabi' => 
    array (
      'label' => 'stabi',
    ),
    'disci1_txt' => 
    array (
      'label' => 'disci1_txt',
    ),
    'applyFilters' => 
    array (
      'label' => 'applyFilters',
    ),
    'toggleColumns' => 
    array (
      'label' => 'toggleColumns',
    ),
    'disci1' => 
    array (
      'label' => 'disci1',
    ),
  ),
  'actions' => 
  array (
    'calculate' => 
    array (
      'label' => 'Calcola Performance',
      'success' => 'Performance calcolate con successo',
      'error' => 'Errore durante il calcolo delle performance',
    ),
    'export' => 
    array (
      'label' => 'Esporta Report',
      'success' => 'Report regionale esportato con successo',
      'error' => 'Errore durante l\'esportazione del report',
    ),
    'compare' => 
    array (
      'label' => 'Confronta Regioni',
      'success' => 'Confronto completato con successo',
      'error' => 'Errore durante il confronto',
    ),
  ),
  'messages' => 
  array (
    'validation' => 
    array (
      'regione' => 
      array (
        'required' => 'La regione è obbligatoria',
        'exists' => 'La regione selezionata non esiste',
      ),
      'periodo' => 
      array (
        'required' => 'Il periodo è obbligatorio',
        'date' => 'Le date devono essere valide',
        'after' => 'La data di fine deve essere successiva all\'inizio',
      ),
    ),
    'errors' => 
    array (
      'calculation_failed' => 'Calcolo delle performance fallito',
      'missing_data' => 'Dati insufficienti per il calcolo',
      'invalid_period' => 'Periodo non valido',
      'no_stabilimenti' => 'Nessuno stabilimento trovato nella regione',
    ),
    'warnings' => 
    array (
      'incomplete_data' => 'Dati incompleti per alcuni stabilimenti',
      'performance_gap' => 'Rilevato gap significativo tra stabilimenti',
      'trend_negative' => 'Trend negativo rilevato',
    ),
    'info' => 
    array (
      'calculation_started' => 'Calcolo performance avviato',
      'export_ready' => 'Report pronto per il download',
      'comparison_available' => 'Confronto con altre regioni disponibile',
    ),
  ),
);
