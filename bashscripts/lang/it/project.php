<?php return array (
  'navigation' => 
  array (
    'name' => 'Progetto',
    'plural' => 'Progetti',
    'group' => 
    array (
      'name' => 'Incentivi',
      'description' => 'Gestione dei progetti e incentivi',
    ),
    'label' => 'progetti',
    'sort' => 69,
    'icon' => 'incentivi-project',
  ),
  'fields' => 
  array (
    'base' => 
    array (
      'nome' => 
      array (
        'label' => 'Nome Progetto',
        'placeholder' => 'Inserisci il nome',
        'help' => 'Nome identificativo del progetto',
      ),
      'codice' => 
      array (
        'label' => 'Codice',
        'placeholder' => 'Inserisci il codice',
        'help' => 'Codice univoco del progetto',
      ),
      'descrizione' => 
      array (
        'label' => 'Descrizione',
        'placeholder' => 'Inserisci la descrizione',
        'help' => 'Descrizione dettagliata del progetto',
      ),
    ),
    'periodo' => 
    array (
      'data_inizio' => 
      array (
        'label' => 'Data Inizio',
        'placeholder' => 'Seleziona la data di inizio',
        'help' => 'Data di inizio del progetto',
      ),
      'data_fine' => 
      array (
        'label' => 'Data Fine',
        'placeholder' => 'Seleziona la data di fine',
        'help' => 'Data di fine del progetto',
      ),
      'durata' => 
      array (
        'label' => 'Durata',
        'help' => 'Durata prevista in mesi',
      ),
    ),
    'budget' => 
    array (
      'importo' => 
      array (
        'label' => 'Importo Budget',
        'placeholder' => 'Inserisci l\'importo',
        'help' => 'Budget totale del progetto',
      ),
      'speso' => 
      array (
        'label' => 'Importo Speso',
        'help' => 'Budget già utilizzato',
      ),
      'residuo' => 
      array (
        'label' => 'Importo Residuo',
        'help' => 'Budget ancora disponibile',
      ),
    ),
    'team' => 
    array (
      'responsabile' => 
      array (
        'label' => 'Responsabile',
        'placeholder' => 'Seleziona il responsabile',
        'help' => 'Responsabile del progetto',
      ),
      'membri' => 
      array (
        'label' => 'Membri Team',
        'placeholder' => 'Seleziona i membri',
        'help' => 'Team di progetto',
      ),
    ),
    'stato' => 
    array (
      'label' => 'Stato',
      'placeholder' => 'Seleziona lo stato',
      'help' => 'Stato attuale del progetto',
      'options' => 
      array (
        'pianificazione' => 'In Pianificazione',
        'avviato' => 'Avviato',
        'in_corso' => 'In Corso',
        'sospeso' => 'Sospeso',
        'completato' => 'Completato',
        'chiuso' => 'Chiuso',
        'annullato' => 'Annullato',
      ),
    ),
    'documenti' => 
    array (
      'label' => 'Documenti',
      'placeholder' => 'Carica i documenti',
      'help' => 'Documentazione di progetto',
    ),
    'note' => 
    array (
      'label' => 'Note',
      'placeholder' => 'Inserisci eventuali note',
      'help' => 'Note aggiuntive sul progetto',
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
    'toggleColumns' => 
    array (
      'label' => 'toggleColumns',
    ),
    'reorderRecords' => 
    array (
      'label' => 'reorderRecords',
    ),
    'updated_at' => 
    array (
      'label' => 'updated_at',
    ),
    'created_at' => 
    array (
      'label' => 'created_at',
    ),
    'determina' => 
    array (
      'label' => 'determina',
    ),
    'data_fine_esecuzione' => 
    array (
      'label' => 'data_fine_esecuzione',
    ),
    'data_inizio_esecuzione' => 
    array (
      'label' => 'data_inizio_esecuzione',
    ),
    'data_aggiudicazione' => 
    array (
      'label' => 'data_aggiudicazione',
    ),
    'workgroup' => 
    array (
      'denominazione' => 
      array (
        'label' => 'workgroup.denominazione',
      ),
    ),
    'delete' => 
    array (
      'label' => 'delete',
    ),
    'edit' => 
    array (
      'label' => 'edit',
    ),
    'view' => 
    array (
      'label' => 'view',
    ),
    'create' => 
    array (
      'label' => 'create',
    ),
    'componente_innovazione' => 
    array (
      'label' => 'componente_innovazione',
    ),
    'componente_incentivante' => 
    array (
      'label' => 'componente_incentivante',
    ),
    'importo_effettivo_fondo' => 
    array (
      'label' => 'importo_effettivo_fondo',
    ),
    'importo_totale' => 
    array (
      'label' => 'importo_totale',
    ),
    'percentuale_fondo' => 
    array (
      'label' => 'percentuale_fondo',
    ),
    'tipo' => 
    array (
      'label' => 'tipo',
    ),
    'nome' => 
    array (
      'label' => 'nome',
    ),
    'value' => 
    array (
      'label' => 'value',
    ),
    'is_active' => 
    array (
      'label' => 'is_active',
    ),
  ),
  'actions' => 
  array (
    'create' => 
    array (
      'label' => 'Nuovo Progetto',
      'success' => 'Progetto creato con successo',
      'error' => 'Errore durante la creazione',
    ),
    'update' => 
    array (
      'label' => 'Modifica',
      'success' => 'Progetto aggiornato con successo',
      'error' => 'Errore durante l\'aggiornamento',
    ),
    'delete' => 
    array (
      'label' => 'Elimina',
      'success' => 'Progetto eliminato con successo',
      'error' => 'Errore durante l\'eliminazione',
      'confirm' => 'Sei sicuro di voler eliminare questo progetto?',
    ),
    'start' => 
    array (
      'label' => 'Avvia',
      'success' => 'Progetto avviato con successo',
      'error' => 'Errore durante l\'avvio',
    ),
    'suspend' => 
    array (
      'label' => 'Sospendi',
      'success' => 'Progetto sospeso con successo',
      'error' => 'Errore durante la sospensione',
    ),
    'complete' => 
    array (
      'label' => 'Completa',
      'success' => 'Progetto completato con successo',
      'error' => 'Errore durante il completamento',
    ),
    'close' => 
    array (
      'label' => 'Chiudi',
      'success' => 'Progetto chiuso con successo',
      'error' => 'Errore durante la chiusura',
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
      'codice' => 
      array (
        'required' => 'Il codice è obbligatorio',
        'unique' => 'Questo codice è già in uso',
        'regex' => 'Il codice deve contenere solo lettere, numeri e trattini',
      ),
      'date' => 
      array (
        'required' => 'Le date sono obbligatorie',
        'date' => 'Le date devono essere valide',
        'after' => 'La data di fine deve essere successiva all\'inizio',
      ),
      'budget' => 
      array (
        'required' => 'Il budget è obbligatorio',
        'numeric' => 'Il budget deve essere numerico',
        'min' => 'Il budget deve essere maggiore di zero',
      ),
    ),
    'errors' => 
    array (
      'insufficient_budget' => 'Budget insufficiente',
      'invalid_status_transition' => 'Transizione di stato non valida',
      'team_incomplete' => 'Team incompleto',
      'dependencies_exist' => 'Esistono dipendenze attive',
    ),
    'warnings' => 
    array (
      'budget_low' => 'Budget quasi esaurito',
      'deadline_approaching' => 'Scadenza imminente',
      'overdue_activities' => 'Attività in ritardo',
      'missing_documentation' => 'Documentazione incompleta',
    ),
    'info' => 
    array (
      'milestones_updated' => 'Milestone aggiornate',
      'team_assigned' => 'Team assegnato correttamente',
      'budget_allocated' => 'Budget allocato correttamente',
      'documentation_complete' => 'Documentazione completa',
    ),
  ),
);