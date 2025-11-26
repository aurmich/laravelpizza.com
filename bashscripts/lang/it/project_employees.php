<?php return array (
  'navigation' => 
  array (
    'name' => 'Dipendente Progetto',
    'plural' => 'Dipendenti Progetti',
    'group' => 
    array (
      'name' => 'Incentivi',
      'description' => 'Gestione dei dipendenti nei progetti',
    ),
    'label' => 'dipendenti_progetti',
    'sort' => 71,
    'icon' => 'incentivi-project-employees',
  ),
  'fields' => 
  array (
    'dipendente' => 
    array (
      'nome' => 
      array (
        'label' => 'Nome Dipendente',
        'placeholder' => 'Seleziona il dipendente',
        'help' => 'Nome del dipendente assegnato',
      ),
      'matricola' => 
      array (
        'label' => 'Matricola',
        'placeholder' => 'Inserisci la matricola',
        'help' => 'Codice identificativo del dipendente',
      ),
      'ruolo' => 
      array (
        'label' => 'Ruolo',
        'placeholder' => 'Seleziona il ruolo',
        'help' => 'Ruolo nel progetto',
        'options' => 
        array (
          'responsabile' => 'Responsabile',
          'coordinatore' => 'Coordinatore',
          'tecnico' => 'Tecnico',
          'collaboratore' => 'Collaboratore',
        ),
      ),
    ),
    'assegnazione' => 
    array (
      'data_inizio' => 
      array (
        'label' => 'Data Inizio',
        'placeholder' => 'Seleziona la data di inizio',
        'help' => 'Data di inizio assegnazione',
      ),
      'data_fine' => 
      array (
        'label' => 'Data Fine',
        'placeholder' => 'Seleziona la data di fine',
        'help' => 'Data di fine assegnazione',
      ),
      'percentuale' => 
      array (
        'label' => 'Percentuale Impegno',
        'placeholder' => 'Inserisci la percentuale',
        'help' => 'Percentuale di tempo dedicato al progetto',
      ),
    ),
    'competenze' => 
    array (
      'label' => 'Competenze',
      'placeholder' => 'Seleziona le competenze',
      'help' => 'Competenze richieste per il ruolo',
    ),
    'responsabilita' => 
    array (
      'label' => 'Responsabilità',
      'placeholder' => 'Inserisci le responsabilità',
      'help' => 'Responsabilità assegnate',
    ),
    'obiettivi' => 
    array (
      'label' => 'Obiettivi',
      'placeholder' => 'Inserisci gli obiettivi',
      'help' => 'Obiettivi individuali nel progetto',
    ),
    'valutazione' => 
    array (
      'punteggio' => 
      array (
        'label' => 'Punteggio',
        'placeholder' => 'Inserisci il punteggio',
        'help' => 'Valutazione delle performance',
      ),
      'commenti' => 
      array (
        'label' => 'Commenti',
        'placeholder' => 'Inserisci i commenti',
        'help' => 'Note sulla valutazione',
      ),
    ),
    'applyFilters' => 
    array (
      'label' => 'applyFilters',
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
    'openFilters' => 
    array (
      'label' => 'openFilters',
    ),
    'value' => 
    array (
      'label' => 'value',
    ),
    'anno_competenza' => 
    array (
      'label' => 'anno_competenza',
    ),
    'sum_total_row' => 
    array (
      'label' => 'sum_total_row',
    ),
  ),
  'actions' => 
  array (
    'assign' => 
    array (
      'label' => 'Assegna',
      'success' => 'Dipendente assegnato con successo',
      'error' => 'Errore durante l\'assegnazione',
    ),
    'remove' => 
    array (
      'label' => 'Rimuovi',
      'success' => 'Dipendente rimosso con successo',
      'error' => 'Errore durante la rimozione',
      'confirm' => 'Sei sicuro di voler rimuovere questo dipendente dal progetto?',
    ),
    'evaluate' => 
    array (
      'label' => 'Valuta',
      'success' => 'Valutazione salvata con successo',
      'error' => 'Errore durante la valutazione',
    ),
    'update_role' => 
    array (
      'label' => 'Aggiorna Ruolo',
      'success' => 'Ruolo aggiornato con successo',
      'error' => 'Errore durante l\'aggiornamento del ruolo',
    ),
  ),
  'messages' => 
  array (
    'validation' => 
    array (
      'dipendente' => 
      array (
        'required' => 'Il dipendente è obbligatorio',
        'exists' => 'Il dipendente selezionato non esiste',
        'unique' => 'Il dipendente è già assegnato al progetto',
      ),
      'ruolo' => 
      array (
        'required' => 'Il ruolo è obbligatorio',
        'in' => 'Il ruolo selezionato non è valido',
      ),
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
        'between' => 'La percentuale deve essere tra 0 e 100',
      ),
    ),
    'errors' => 
    array (
      'role_conflict' => 'Conflitto di ruolo rilevato',
      'overallocation' => 'Dipendente già allocato al 100%',
      'missing_skills' => 'Competenze richieste mancanti',
      'invalid_period' => 'Periodo non valido',
    ),
    'warnings' => 
    array (
      'high_workload' => 'Carico di lavoro elevato',
      'skill_mismatch' => 'Possibile disallineamento competenze',
      'evaluation_due' => 'Valutazione in scadenza',
    ),
    'info' => 
    array (
      'assignment_details' => 'Dettagli assegnazione aggiornati',
      'role_requirements' => 'Requisiti ruolo disponibili',
      'evaluation_period' => 'Periodo di valutazione: :period',
    ),
  ),
  'title' => 'project employees',
);