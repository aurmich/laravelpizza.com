<?php return array (
  'navigation' => 
  array (
    'name' => 'Liquidazione',
    'plural' => 'Liquidazioni',
    'group' => 
    array (
      'name' => 'Incentivi',
      'description' => 'Gestione delle liquidazioni incentivi',
    ),
    'label' => 'liquidazioni',
    'sort' => 90,
    'icon' => 'incentivi-settlement',
  ),
  'fields' => 
  array (
    'importo' => 
    array (
      'label' => 'Importo',
      'placeholder' => 'Inserisci l\'importo',
      'help' => 'Importo della liquidazione',
    ),
    'data' => 
    array (
      'label' => 'Data',
      'placeholder' => 'Seleziona la data',
      'help' => 'Data della liquidazione',
    ),
    'stato' => 
    array (
      'label' => 'Stato',
      'placeholder' => 'Seleziona lo stato',
      'help' => 'Stato attuale della liquidazione',
      'options' => 
      array (
        'bozza' => 'Bozza',
        'approvata' => 'Approvata',
        'pagata' => 'Pagata',
        'annullata' => 'Annullata',
      ),
    ),
    'dipendente' => 
    array (
      'label' => 'Dipendente',
      'placeholder' => 'Seleziona il dipendente',
      'help' => 'Dipendente beneficiario',
    ),
    'progetto' => 
    array (
      'label' => 'Progetto',
      'placeholder' => 'Seleziona il progetto',
      'help' => 'Progetto di riferimento',
    ),
    'note' => 
    array (
      'label' => 'Note',
      'placeholder' => 'Inserisci eventuali note',
      'help' => 'Note aggiuntive sulla liquidazione',
    ),
    'documenti' => 
    array (
      'label' => 'Documenti',
      'placeholder' => 'Carica i documenti',
      'help' => 'Documenti relativi alla liquidazione',
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
    'updated_at' => 
    array (
      'label' => 'updated_at',
    ),
    'created_at' => 
    array (
      'label' => 'created_at',
    ),
    'tipologia' => 
    array (
      'label' => 'tipologia',
    ),
    'project' => 
    array (
      'nome' => 
      array (
        'label' => 'project.nome',
      ),
    ),
  ),
  'actions' => 
  array (
    'create' => 
    array (
      'label' => 'Nuova Liquidazione',
      'success' => 'Liquidazione creata con successo',
      'error' => 'Errore durante la creazione',
    ),
    'update' => 
    array (
      'label' => 'Modifica',
      'success' => 'Liquidazione aggiornata con successo',
      'error' => 'Errore durante l\'aggiornamento',
    ),
    'delete' => 
    array (
      'label' => 'Elimina',
      'success' => 'Liquidazione eliminata con successo',
      'error' => 'Errore durante l\'eliminazione',
      'confirm' => 'Sei sicuro di voler eliminare questa liquidazione?',
    ),
    'approve' => 
    array (
      'label' => 'Approva',
      'success' => 'Liquidazione approvata con successo',
      'error' => 'Errore durante l\'approvazione',
    ),
    'pay' => 
    array (
      'label' => 'Paga',
      'success' => 'Liquidazione pagata con successo',
      'error' => 'Errore durante il pagamento',
    ),
    'cancel' => 
    array (
      'label' => 'Annulla',
      'success' => 'Liquidazione annullata con successo',
      'error' => 'Errore durante l\'annullamento',
    ),
  ),
  'messages' => 
  array (
    'validation' => 
    array (
      'importo' => 
      array (
        'required' => 'L\'importo è obbligatorio',
        'numeric' => 'L\'importo deve essere numerico',
        'min' => 'L\'importo deve essere maggiore di zero',
      ),
      'data' => 
      array (
        'required' => 'La data è obbligatoria',
        'date' => 'La data deve essere valida',
      ),
      'dipendente' => 
      array (
        'required' => 'Il dipendente è obbligatorio',
        'exists' => 'Il dipendente selezionato non esiste',
      ),
    ),
    'errors' => 
    array (
      'insufficient_funds' => 'Fondi insufficienti per la liquidazione',
      'invalid_status' => 'Stato non valido per l\'operazione',
      'already_paid' => 'Liquidazione già pagata',
      'documents_missing' => 'Documenti obbligatori mancanti',
    ),
    'warnings' => 
    array (
      'high_amount' => 'Importo superiore alla media',
      'pending_approvals' => 'Approvazioni in sospeso',
      'payment_delayed' => 'Pagamento in ritardo',
    ),
    'info' => 
    array (
      'payment_scheduled' => 'Pagamento programmato per :date',
      'documents_ready' => 'Documenti pronti per l\'elaborazione',
      'approval_required' => 'Richiesta approvazione superiore',
    ),
  ),
);