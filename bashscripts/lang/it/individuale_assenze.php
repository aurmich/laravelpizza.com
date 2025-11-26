<?php return array (
  'navigation' => 
  array (
    'name' => 'Assenza Individuale',
    'plural' => 'Assenze Individuali',
    'group' => 
    array (
      'name' => 'Valutazione',
      'description' => 'Gestione delle assenze individuali',
    ),
    'label' => 'assenze',
    'sort' => 37,
    'icon' => 'performance-absence',
  ),
  'fields' => 
  array (
    'dipendente' => 
    array (
      'name' => 
      array (
        'label' => 'Nome Dipendente',
        'placeholder' => 'Seleziona il dipendente',
        'help' => 'Dipendente a cui si riferisce l\'assenza',
      ),
      'matricola' => 
      array (
        'label' => 'Matricola',
        'placeholder' => 'Inserisci la matricola',
        'help' => 'Codice identificativo del dipendente',
      ),
      'reparto' => 
      array (
        'label' => 'Reparto',
        'placeholder' => 'Seleziona il reparto',
        'help' => 'Reparto di appartenenza',
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
          'aspettativa' => 'Aspettativa',
          'altro' => 'Altro',
        ),
      ),
      'sottotipo' => 
      array (
        'label' => 'Sottotipo',
        'placeholder' => 'Seleziona il sottotipo',
        'help' => 'Specificazione del tipo di assenza',
      ),
      'giustificativo' => 
      array (
        'label' => 'Giustificativo',
        'placeholder' => 'Seleziona il giustificativo',
        'help' => 'Documento giustificativo dell\'assenza',
      ),
    ),
    'periodo' => 
    array (
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
      'giorni_totali' => 
      array (
        'label' => 'Giorni Totali',
        'help' => 'Numero totale di giorni di assenza',
      ),
      'giorni_lavorativi' => 
      array (
        'label' => 'Giorni Lavorativi',
        'help' => 'Numero di giorni lavorativi di assenza',
      ),
    ),
    'stato' => 
    array (
      'label' => 'Stato',
      'help' => 'Stato attuale dell\'assenza',
      'options' => 
      array (
        'richiesta' => 'Richiesta',
        'approvata' => 'Approvata',
        'rifiutata' => 'Rifiutata',
        'annullata' => 'Annullata',
        'in_corso' => 'In Corso',
        'conclusa' => 'Conclusa',
      ),
    ),
    'note' => 
    array (
      'label' => 'Note',
      'placeholder' => 'Inserisci eventuali note',
      'help' => 'Note aggiuntive sull\'assenza',
    ),
    'timestamps' => 
    array (
      'created_at' => 
      array (
        'label' => 'Data Creazione',
        'help' => 'Data di registrazione dell\'assenza',
      ),
      'updated_at' => 
      array (
        'label' => 'Ultimo Aggiornamento',
        'help' => 'Data dell\'ultima modifica',
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
    'tipo' => 
    array (
      'label' => 'tipo',
    ),
    'codice' => 
    array (
      'label' => 'codice',
    ),
    'descr' => 
    array (
      'label' => 'descr',
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
    'edit' => 
    array (
      'label' => 'edit',
    ),
    'delete' => 
    array (
      'label' => 'delete',
    ),
    'value' => 
    array (
      'label' => 'value',
    ),
    'openFilters' => 
    array (
      'label' => 'openFilters',
    ),
    'resetFilters' => 
    array (
      'label' => 'resetFilters',
    ),
    'view' => 
    array (
      'label' => 'view',
    ),
  ),
  'actions' => 
  array (
    'create' => 
    array (
      'label' => 'Nuova Assenza',
      'success' => 'Assenza registrata con successo',
      'error' => 'Errore durante la registrazione',
    ),
    'update' => 
    array (
      'label' => 'Modifica',
      'success' => 'Assenza aggiornata con successo',
      'error' => 'Errore durante l\'aggiornamento',
    ),
    'delete' => 
    array (
      'label' => 'Elimina',
      'success' => 'Assenza eliminata con successo',
      'error' => 'Errore durante l\'eliminazione',
      'confirm' => 'Sei sicuro di voler eliminare questa assenza?',
    ),
    'approve' => 
    array (
      'label' => 'Approva',
      'success' => 'Assenza approvata con successo',
      'error' => 'Errore durante l\'approvazione',
    ),
    'reject' => 
    array (
      'label' => 'Rifiuta',
      'success' => 'Assenza rifiutata con successo',
      'error' => 'Errore durante il rifiuto',
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
      'tipo' => 
      array (
        'required' => 'Il tipo è obbligatorio',
        'in' => 'Il tipo selezionato non è valido',
      ),
      'giustificativo' => 
      array (
        'required_if' => 'Il giustificativo è obbligatorio per questo tipo di assenza',
        'file' => 'Il giustificativo deve essere un file',
      ),
    ),
    'errors' => 
    array (
      'overlap_dates' => 'Date sovrapposte con altre assenze',
      'insufficient_days' => 'Giorni disponibili insufficienti',
      'expired_request' => 'Richiesta scaduta',
      'invalid_status' => 'Stato non valido per l\'operazione',
    ),
    'warnings' => 
    array (
      'holiday_included' => 'Il periodo include giorni festivi',
      'long_absence' => 'Assenza di lunga durata',
      'frequent_absences' => 'Frequenza elevata di assenze',
    ),
    'info' => 
    array (
      'days_remaining' => 'Giorni rimanenti: :days',
      'approval_pending' => 'In attesa di approvazione',
      'automatic_approval' => 'Approvazione automatica applicata',
    ),
  ),
  'model' => 
  array (
    'label' => 'individuale assenze.model',
  ),
);