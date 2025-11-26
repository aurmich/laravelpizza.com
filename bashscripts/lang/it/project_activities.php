<?php return array (
  'navigation' => 
  array (
    'name' => 'Attività Progetto',
    'plural' => 'Attività Progetti',
    'group' => 
    array (
      'name' => 'Incentivi',
      'description' => 'Gestione delle attività dei progetti',
    ),
    'label' => 'attivita_progetti',
    'sort' => 18,
    'icon' => 'incentivi-project-activities',
  ),
  'fields' => 
  array (
    'attivita' => 
    array (
      'nome' => 
      array (
        'label' => 'Nome Attività',
        'placeholder' => 'Inserisci il nome',
        'help' => 'Nome identificativo dell\'attività',
      ),
      'descrizione' => 
      array (
        'label' => 'Descrizione',
        'placeholder' => 'Inserisci la descrizione',
        'help' => 'Descrizione dettagliata dell\'attività',
      ),
      'tipo' => 
      array (
        'label' => 'Tipo',
        'placeholder' => 'Seleziona il tipo',
        'help' => 'Tipologia di attività',
        'options' => 
        array (
          'analisi' => 'Analisi',
          'sviluppo' => 'Sviluppo',
          'test' => 'Testing',
          'documentazione' => 'Documentazione',
          'coordinamento' => 'Coordinamento',
        ),
      ),
    ),
    'pianificazione' => 
    array (
      'data_inizio' => 
      array (
        'label' => 'Data Inizio',
        'placeholder' => 'Seleziona la data di inizio',
        'help' => 'Data di inizio dell\'attività',
      ),
      'data_fine' => 
      array (
        'label' => 'Data Fine',
        'placeholder' => 'Seleziona la data di fine',
        'help' => 'Data di fine dell\'attività',
      ),
      'durata' => 
      array (
        'label' => 'Durata',
        'placeholder' => 'Inserisci la durata',
        'help' => 'Durata stimata in ore',
      ),
      'priorita' => 
      array (
        'label' => 'Priorità',
        'placeholder' => 'Seleziona la priorità',
        'help' => 'Livello di priorità',
        'options' => 
        array (
          'bassa' => 'Bassa',
          'media' => 'Media',
          'alta' => 'Alta',
          'critica' => 'Critica',
        ),
      ),
    ),
    'assegnazione' => 
    array (
      'responsabile' => 
      array (
        'label' => 'Responsabile',
        'placeholder' => 'Seleziona il responsabile',
        'help' => 'Responsabile dell\'attività',
      ),
      'partecipanti' => 
      array (
        'label' => 'Partecipanti',
        'placeholder' => 'Seleziona i partecipanti',
        'help' => 'Team assegnato all\'attività',
      ),
    ),
    'stato' => 
    array (
      'label' => 'Stato',
      'placeholder' => 'Seleziona lo stato',
      'help' => 'Stato attuale dell\'attività',
      'options' => 
      array (
        'da_iniziare' => 'Da Iniziare',
        'in_corso' => 'In Corso',
        'in_revisione' => 'In Revisione',
        'completata' => 'Completata',
        'sospesa' => 'Sospesa',
      ),
    ),
    'avanzamento' => 
    array (
      'percentuale' => 
      array (
        'label' => 'Percentuale Completamento',
        'placeholder' => 'Inserisci la percentuale',
        'help' => 'Percentuale di completamento',
      ),
      'ore_lavorate' => 
      array (
        'label' => 'Ore Lavorate',
        'placeholder' => 'Inserisci le ore',
        'help' => 'Ore effettivamente lavorate',
      ),
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
    'project_id' => 
    array (
      'label' => 'project_id',
    ),
    'anno_competenza' => 
    array (
      'label' => 'anno_competenza',
    ),
    'importo' => 
    array (
      'label' => 'importo',
    ),
    'quota_percentuale' => 
    array (
      'label' => 'quota_percentuale',
    ),
    'tipo' => 
    array (
      'label' => 'tipo',
    ),
    'nome' => 
    array (
      'label' => 'nome',
    ),
    'handleEmployees' => 
    array (
      'label' => 'handleEmployees',
    ),
    'employees' => 
    array (
      'full_name' => 
      array (
        'label' => 'employees.full_name',
      ),
    ),
  ),
  'actions' => 
  array (
    'create' => 
    array (
      'label' => 'Nuova Attività',
      'success' => 'Attività creata con successo',
      'error' => 'Errore durante la creazione',
    ),
    'update' => 
    array (
      'label' => 'Modifica',
      'success' => 'Attività aggiornata con successo',
      'error' => 'Errore durante l\'aggiornamento',
    ),
    'delete' => 
    array (
      'label' => 'Elimina',
      'success' => 'Attività eliminata con successo',
      'error' => 'Errore durante l\'eliminazione',
      'confirm' => 'Sei sicuro di voler eliminare questa attività?',
    ),
    'start' => 
    array (
      'label' => 'Avvia',
      'success' => 'Attività avviata con successo',
      'error' => 'Errore durante l\'avvio',
    ),
    'complete' => 
    array (
      'label' => 'Completa',
      'success' => 'Attività completata con successo',
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
      'tipo' => 
      array (
        'required' => 'Il tipo è obbligatorio',
        'in' => 'Il tipo selezionato non è valido',
      ),
      'date' => 
      array (
        'required' => 'Le date sono obbligatorie',
        'date' => 'Le date devono essere valide',
        'after' => 'La data di fine deve essere successiva all\'inizio',
      ),
      'durata' => 
      array (
        'required' => 'La durata è obbligatoria',
        'numeric' => 'La durata deve essere numerica',
        'min' => 'La durata deve essere maggiore di zero',
      ),
    ),
    'errors' => 
    array (
      'dependencies_incomplete' => 'Attività dipendenti non completate',
      'resources_unavailable' => 'Risorse non disponibili',
      'invalid_status_transition' => 'Transizione di stato non valida',
      'schedule_conflict' => 'Conflitto di schedulazione',
    ),
    'warnings' => 
    array (
      'overdue' => 'Attività in ritardo',
      'approaching_deadline' => 'Scadenza imminente',
      'resource_overallocation' => 'Risorse sovrallocate',
    ),
    'info' => 
    array (
      'dependencies_ok' => 'Dipendenze verificate',
      'resources_assigned' => 'Risorse assegnate correttamente',
      'milestone_reached' => 'Milestone raggiunta',
    ),
  ),
  'title' => 'project activities',
);