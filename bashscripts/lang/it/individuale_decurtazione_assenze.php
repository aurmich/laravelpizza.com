<?php

return array (
  'navigation' => 
  array (
    'name' => 'Decurtazione Assenze',
    'plural' => 'Decurtazioni Assenze',
    'group' => 
    array (
      'name' => 'Valutazione',
      'description' => 'Gestione delle decurtazioni per assenze',
    ),
    'label' => 'decurtazioni',
    'sort' => 91,
    'icon' => 'performance-deduction',
  ),
  'fields' => 
  array (
    'dipendente' => 
    array (
      'name' => 
      array (
        'label' => 'Nome Dipendente',
        'placeholder' => 'Seleziona il dipendente',
        'help' => 'Dipendente soggetto a decurtazione',
      ),
      'matricola' => 
      array (
        'label' => 'Matricola',
        'placeholder' => 'Inserisci la matricola',
        'help' => 'Codice identificativo del dipendente',
      ),
    ),
    'assenza' => 
    array (
      'tipo' => 
      array (
        'label' => 'Tipo Assenza',
        'placeholder' => 'Seleziona il tipo',
        'help' => 'Tipologia di assenza',
        'options' => 
        array (
          'malattia' => 'Malattia',
          'ferie' => 'Ferie',
          'permesso' => 'Permesso',
          'congedo' => 'Congedo',
          'altro' => 'Altro',
        ),
      ),
      'data_inizio' => 
      array (
        'label' => 'Data Inizio',
        'placeholder' => 'Seleziona la data di inizio',
        'help' => 'Data di inizio dell\'assenza',
      ),
      'data_fine' => 
      array (
        'label' => 'Data Fine',
        'placeholder' => 'Seleziona la data di fine',
        'help' => 'Data di fine dell\'assenza',
      ),
      'giorni' => 
      array (
        'label' => 'Giorni Totali',
        'help' => 'Numero totale di giorni di assenza',
      ),
    ),
    'decurtazione' => 
    array (
      'percentuale' => 
      array (
        'label' => 'Percentuale',
        'placeholder' => 'Inserisci la percentuale',
        'help' => 'Percentuale di decurtazione',
      ),
      'importo' => 
      array (
        'label' => 'Importo',
        'placeholder' => 'Inserisci l\'importo',
        'help' => 'Importo della decurtazione',
      ),
      'motivo' => 
      array (
        'label' => 'Motivazione',
        'placeholder' => 'Inserisci la motivazione',
        'help' => 'Motivo della decurtazione',
      ),
      'label' => 
      array (
        'percentuale' => 
        array (
          'label' => 'Percentuale',
          'placeholder' => 'Inserisci la percentuale',
          'help' => 'Percentuale di decurtazione',
        ),
        'importo' => 
        array (
          'label' => 'Importo',
          'placeholder' => 'Inserisci l\'importo',
          'help' => 'Importo della decurtazione',
        ),
        'motivo' => 
        array (
          'label' => 'Motivazione',
          'placeholder' => 'Inserisci la motivazione',
          'help' => 'Motivo della decurtazione',
        ),
      ),
    ),
    'stato' => 
    array (
      'label' => 'Stato',
      'help' => 'Stato attuale della decurtazione',
      'options' => 
      array (
        'bozza' => 'Bozza',
        'approvata' => 'Approvata',
        'applicata' => 'Applicata',
        'annullata' => 'Annullata',
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
    'toggleColumns' => 
    array (
      'label' => 'toggleColumns',
    ),
    'id' => 
    array (
      'label' => 'id',
    ),
    'anno' => 
    array (
      'label' => 'anno',
    ),
    'individuale' => 
    array (
      'nome' => 
      array (
        'label' => 'individuale.nome',
      ),
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
    'delete' => 
    array (
      'label' => 'delete',
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
  ),
  'actions' => 
  array (
    'calculate' => 
    array (
      'label' => 'Calcola Decurtazione',
      'success' => 'Decurtazione calcolata con successo',
      'error' => 'Errore durante il calcolo',
    ),
    'approve' => 
    array (
      'label' => 'Approva',
      'success' => 'Decurtazione approvata con successo',
      'error' => 'Errore durante l\'approvazione',
    ),
    'apply' => 
    array (
      'label' => 'Applica',
      'success' => 'Decurtazione applicata con successo',
      'error' => 'Errore durante l\'applicazione',
    ),
    'cancel' => 
    array (
      'label' => 'Annulla',
      'success' => 'Decurtazione annullata con successo',
      'error' => 'Errore durante l\'annullamento',
      'confirm' => 'Sei sicuro di voler annullare questa decurtazione?',
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
      'date' => 
      array (
        'required' => 'Le date sono obbligatorie',
        'date' => 'Le date devono essere valide',
        'after' => 'La data di fine deve essere successiva all\'inizio',
      ),
      'percentuale' => 
      array (
        'required' => 'La percentuale è obbligatoria',
        'numeric' => 'La percentuale deve essere numerica',
        'min' => 'La percentuale deve essere almeno :min',
        'max' => 'La percentuale non può superare :max',
      ),
      'importo' => 
      array (
        'required' => 'L\'importo è obbligatorio',
        'numeric' => 'L\'importo deve essere numerico',
        'min' => 'L\'importo deve essere maggiore di zero',
      ),
    ),
    'errors' => 
    array (
      'calculation_failed' => 'Calcolo della decurtazione fallito',
      'invalid_dates' => 'Date non valide',
      'already_processed' => 'Decurtazione già elaborata',
      'insufficient_permissions' => 'Permessi insufficienti',
    ),
    'warnings' => 
    array (
      'overlapping_dates' => 'Date sovrapposte con altre assenze',
      'high_deduction' => 'Decurtazione superiore alla media',
      'pending_approval' => 'In attesa di approvazione',
    ),
    'info' => 
    array (
      'calculation_details' => 'Dettagli del calcolo disponibili',
      'history_available' => 'Storico modifiche disponibile',
      'auto_calculation' => 'Calcolo automatico applicato',
    ),
  ),
  'model' => 
  array (
    'label' => 'individuale decurtazione assenze.model',
  ),
);
