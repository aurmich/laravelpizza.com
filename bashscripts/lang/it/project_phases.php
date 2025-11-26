<?php return array (
  'navigation' => 
  array (
    'name' => 'Fase Progetto',
    'plural' => 'Fasi Progetti',
    'group' => 
    array (
      'name' => 'Incentivi',
      'description' => 'Gestione delle fasi dei progetti',
    ),
    'label' => 'fasi_progetti',
    'sort' => 72,
    'icon' => 'incentivi-project-phases',
  ),
  'fields' => 
  array (
    'progetto' => 
    array (
      'label' => 'Progetto',
      'placeholder' => 'Seleziona il progetto',
      'help' => 'Progetto di riferimento',
    ),
    'fase' => 
    array (
      'nome' => 
      array (
        'label' => 'Nome Fase',
        'placeholder' => 'Inserisci il nome della fase',
        'help' => 'Nome identificativo della fase',
      ),
      'descrizione' => 
      array (
        'label' => 'Descrizione',
        'placeholder' => 'Inserisci la descrizione',
        'help' => 'Descrizione dettagliata della fase',
      ),
      'ordine' => 
      array (
        'label' => 'Ordine',
        'placeholder' => 'Inserisci l\'ordine',
        'help' => 'Ordine di esecuzione della fase',
      ),
    ),
    'periodo' => 
    array (
      'data_inizio' => 
      array (
        'label' => 'Data Inizio',
        'placeholder' => 'Seleziona la data di inizio',
        'help' => 'Data di inizio della fase',
      ),
      'data_fine' => 
      array (
        'label' => 'Data Fine',
        'placeholder' => 'Seleziona la data di fine',
        'help' => 'Data di fine della fase',
      ),
      'durata' => 
      array (
        'label' => 'Durata',
        'help' => 'Durata prevista in giorni',
      ),
    ),
    'stato' => 
    array (
      'label' => 'Stato',
      'placeholder' => 'Seleziona lo stato',
      'help' => 'Stato attuale della fase',
      'options' => 
      array (
        'pianificata' => 'Pianificata',
        'in_corso' => 'In Corso',
        'completata' => 'Completata',
        'sospesa' => 'Sospesa',
        'annullata' => 'Annullata',
      ),
    ),
    'risorse' => 
    array (
      'budget' => 
      array (
        'label' => 'Budget',
        'placeholder' => 'Inserisci il budget',
        'help' => 'Budget allocato per la fase',
      ),
      'personale' => 
      array (
        'label' => 'Personale',
        'placeholder' => 'Seleziona il personale',
        'help' => 'Personale assegnato alla fase',
      ),
    ),
    'deliverables' => 
    array (
      'label' => 'Deliverables',
      'placeholder' => 'Inserisci i deliverables',
      'help' => 'Risultati attesi dalla fase',
    ),
    'dipendenze' => 
    array (
      'label' => 'Dipendenze',
      'placeholder' => 'Seleziona le dipendenze',
      'help' => 'Fasi da cui dipende',
    ),
    'toggleColumns' => 
    array (
      'label' => 'toggleColumns',
    ),
    'reorderRecords' => 
    array (
      'label' => 'reorderRecords',
    ),
    'resetFilters' => 
    array (
      'label' => 'resetFilters',
    ),
    'applyFilters' => 
    array (
      'label' => 'applyFilters',
    ),
    'openFilters' => 
    array (
      'label' => 'openFilters',
    ),
    'end_date' => 
    array (
      'label' => 'end_date',
    ),
    'start_date' => 
    array (
      'label' => 'start_date',
    ),
    'description' => 
    array (
      'label' => 'description',
    ),
    'name' => 
    array (
      'label' => 'name',
    ),
    'detach' => 
    array (
      'label' => 'detach',
    ),
    'edit' => 
    array (
      'label' => 'edit',
    ),
    'view' => 
    array (
      'label' => 'view',
    ),
    'nuova-fase' => 
    array (
      'label' => 'nuova-fase',
    ),
    'handlePhaseSettlements' => 
    array (
      'label' => 'handlePhaseSettlements',
    ),
    'handleSettlement' => 
    array (
      'label' => 'handleSettlement',
    ),
  ),
  'actions' => 
  array (
    'create' => 
    array (
      'label' => 'Nuova Fase',
      'success' => 'Fase creata con successo',
      'error' => 'Errore durante la creazione',
    ),
    'update' => 
    array (
      'label' => 'Modifica',
      'success' => 'Fase aggiornata con successo',
      'error' => 'Errore durante l\'aggiornamento',
    ),
    'delete' => 
    array (
      'label' => 'Elimina',
      'success' => 'Fase eliminata con successo',
      'error' => 'Errore durante l\'eliminazione',
      'confirm' => 'Sei sicuro di voler eliminare questa fase?',
    ),
    'start' => 
    array (
      'label' => 'Avvia',
      'success' => 'Fase avviata con successo',
      'error' => 'Errore durante l\'avvio',
    ),
    'complete' => 
    array (
      'label' => 'Completa',
      'success' => 'Fase completata con successo',
      'error' => 'Errore durante il completamento',
    ),
  ),
  'messages' => 
  array (
    'validation' => 
    array (
      'nome' => 
      array (
        'required' => 'Il nome è obbligatorio',
        'unique' => 'Questo nome è già in uso',
      ),
      'ordine' => 
      array (
        'required' => 'L\'ordine è obbligatorio',
        'numeric' => 'L\'ordine deve essere numerico',
        'min' => 'L\'ordine deve essere maggiore di zero',
      ),
      'date' => 
      array (
        'required' => 'Le date sono obbligatorie',
        'date' => 'Le date devono essere valide',
        'after' => 'La data di fine deve essere successiva all\'inizio',
      ),
    ),
    'errors' => 
    array (
      'dependencies_incomplete' => 'Dipendenze non completate',
      'resources_unavailable' => 'Risorse non disponibili',
      'invalid_sequence' => 'Sequenza non valida',
      'overlap_dates' => 'Date sovrapposte con altre fasi',
    ),
    'warnings' => 
    array (
      'budget_low' => 'Budget quasi esaurito',
      'deadline_approaching' => 'Scadenza imminente',
      'resource_overallocation' => 'Risorse sovrallocate',
    ),
    'info' => 
    array (
      'dependencies_ok' => 'Tutte le dipendenze soddisfatte',
      'resources_allocated' => 'Risorse allocate correttamente',
      'timeline_updated' => 'Timeline aggiornata',
    ),
  ),
  'title' => 'project phases',
);