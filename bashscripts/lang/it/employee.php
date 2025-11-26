<?php return array (
  'navigation' => 
  array (
    'name' => 'Dipendente',
    'plural' => 'Dipendenti',
    'group' => 
    array (
      'name' => 'Incentivi',
      'description' => 'Gestione dei dipendenti e incentivi',
    ),
    'label' => 'dipendenti',
    'sort' => 40,
    'icon' => 'incentivi-employee',
  ),
  'fields' => 
  array (
    'anagrafica' => 
    array (
      'nome' => 
      array (
        'label' => 'Nome',
        'placeholder' => 'Inserisci il nome',
        'help' => 'Nome del dipendente',
      ),
      'cognome' => 
      array (
        'label' => 'Cognome',
        'placeholder' => 'Inserisci il cognome',
        'help' => 'Cognome del dipendente',
      ),
      'matricola' => 
      array (
        'label' => 'Matricola',
        'placeholder' => 'Inserisci la matricola',
        'help' => 'Codice identificativo del dipendente',
      ),
      'codice_fiscale' => 
      array (
        'label' => 'Codice Fiscale',
        'placeholder' => 'Inserisci il codice fiscale',
        'help' => 'Codice fiscale del dipendente',
      ),
      'data_nascita' => 
      array (
        'label' => 'Data di Nascita',
        'placeholder' => 'Seleziona la data',
        'help' => 'Data di nascita del dipendente',
      ),
    ),
    'contratto' => 
    array (
      'tipo' => 
      array (
        'label' => 'Tipo Contratto',
        'placeholder' => 'Seleziona il tipo',
        'help' => 'Tipologia di contratto',
        'options' => 
        array (
          'indeterminato' => 'Tempo Indeterminato',
          'determinato' => 'Tempo Determinato',
          'apprendistato' => 'Apprendistato',
          'collaborazione' => 'Collaborazione',
        ),
      ),
      'data_assunzione' => 
      array (
        'label' => 'Data Assunzione',
        'placeholder' => 'Seleziona la data',
        'help' => 'Data di assunzione',
      ),
      'data_cessazione' => 
      array (
        'label' => 'Data Cessazione',
        'placeholder' => 'Seleziona la data',
        'help' => 'Data di cessazione',
      ),
      'livello' => 
      array (
        'label' => 'Livello',
        'placeholder' => 'Seleziona il livello',
        'help' => 'Livello contrattuale',
      ),
    ),
    'organizzazione' => 
    array (
      'reparto' => 
      array (
        'label' => 'Reparto',
        'placeholder' => 'Seleziona il reparto',
        'help' => 'Reparto di appartenenza',
      ),
      'ruolo' => 
      array (
        'label' => 'Ruolo',
        'placeholder' => 'Seleziona il ruolo',
        'help' => 'Ruolo organizzativo',
      ),
      'responsabile' => 
      array (
        'label' => 'Responsabile',
        'placeholder' => 'Seleziona il responsabile',
        'help' => 'Responsabile diretto',
      ),
    ),
    'competenze' => 
    array (
      'label' => 'Competenze',
      'placeholder' => 'Seleziona le competenze',
      'help' => 'Competenze professionali',
    ),
    'documenti' => 
    array (
      'label' => 'Documenti',
      'placeholder' => 'Carica i documenti',
      'help' => 'Documenti del dipendente',
    ),
    'stato' => 
    array (
      'label' => 'Stato',
      'help' => 'Stato attuale del dipendente',
      'options' => 
      array (
        'attivo' => 'Attivo',
        'sospeso' => 'Sospeso',
        'cessato' => 'Cessato',
      ),
    ),
    'toggleColumns' => 
    array (
      'label' => 'toggleColumns',
    ),
    'create' => 
    array (
      'label' => 'create',
    ),
    'reorderRecords' => 
    array (
      'label' => 'reorderRecords',
    ),
    'matricola' => 
    array (
      'label' => 'matricola',
    ),
    'cognome' => 
    array (
      'label' => 'cognome',
    ),
    'nome' => 
    array (
      'label' => 'nome',
    ),
    'tipologia' => 
    array (
      'label' => 'tipologia',
    ),
    'sesso' => 
    array (
      'label' => 'sesso',
    ),
    'codice_fiscale' => 
    array (
      'label' => 'codice_fiscale',
    ),
    'posizione_inail' => 
    array (
      'label' => 'posizione_inail',
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
    'value' => 
    array (
      'label' => 'value',
    ),
    'delete' => 
    array (
      'label' => 'delete',
    ),
    'detach' => 
    array (
      'label' => 'detach',
    ),
    'newConsulenteEsterno' => 
    array (
      'label' => 'newConsulenteEsterno',
    ),
    'edit' => 
    array (
      'label' => 'edit',
    ),
    'importo_attivita_dipendente' => 
    array (
      'label' => 'importo_attivita_dipendente',
    ),
    'percentuale_attivita_dipendente' => 
    array (
      'label' => 'percentuale_attivita_dipendente',
    ),
    'recordId' => 
    array (
      'label' => 'recordId',
    ),
    'attach' => 
    array (
      'label' => 'attach',
    ),
  ),
  'actions' => 
  array (
    'create' => 
    array (
      'label' => 'Nuovo Dipendente',
      'success' => 'Dipendente creato con successo',
      'error' => 'Errore durante la creazione',
    ),
    'update' => 
    array (
      'label' => 'Modifica',
      'success' => 'Dipendente aggiornato con successo',
      'error' => 'Errore durante l\'aggiornamento',
    ),
    'delete' => 
    array (
      'label' => 'Elimina',
      'success' => 'Dipendente eliminato con successo',
      'error' => 'Errore durante l\'eliminazione',
      'confirm' => 'Sei sicuro di voler eliminare questo dipendente?',
    ),
    'suspend' => 
    array (
      'label' => 'Sospendi',
      'success' => 'Dipendente sospeso con successo',
      'error' => 'Errore durante la sospensione',
    ),
    'reactivate' => 
    array (
      'label' => 'Riattiva',
      'success' => 'Dipendente riattivato con successo',
      'error' => 'Errore durante la riattivazione',
    ),
    'terminate' => 
    array (
      'label' => 'Termina',
      'success' => 'Dipendente cessato con successo',
      'error' => 'Errore durante la cessazione',
    ),
  ),
  'messages' => 
  array (
    'validation' => 
    array (
      'anagrafica' => 
      array (
        'required' => 'I dati anagrafici sono obbligatori',
        'unique' => 'Codice fiscale già presente',
        'regex' => 'Formato codice fiscale non valido',
      ),
      'matricola' => 
      array (
        'required' => 'La matricola è obbligatoria',
        'unique' => 'Matricola già assegnata',
        'regex' => 'Formato matricola non valido',
      ),
      'contratto' => 
      array (
        'required' => 'I dati contrattuali sono obbligatori',
        'date' => 'Le date devono essere valide',
        'after' => 'La data di cessazione deve essere successiva all\'assunzione',
      ),
    ),
    'errors' => 
    array (
      'active_projects' => 'Dipendente assegnato a progetti attivi',
      'invalid_status' => 'Stato non valido per l\'operazione',
      'missing_documents' => 'Documenti obbligatori mancanti',
      'invalid_contract' => 'Dati contrattuali non validi',
    ),
    'warnings' => 
    array (
      'contract_expiring' => 'Contratto in scadenza',
      'missing_skills' => 'Competenze da aggiornare',
      'pending_reviews' => 'Valutazioni in sospeso',
    ),
    'info' => 
    array (
      'contract_updated' => 'Contratto aggiornato correttamente',
      'documents_complete' => 'Documentazione completa',
      'skills_verified' => 'Competenze verificate',
    ),
  ),
);