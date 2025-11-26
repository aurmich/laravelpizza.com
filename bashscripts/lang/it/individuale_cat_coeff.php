<?php

return array (
  'navigation' => 
  array (
    'name' => 'Coefficiente Categoria',
    'plural' => 'Coefficienti Categorie',
    'group' => 
    array (
      'name' => 'Valutazione',
      'description' => 'Gestione dei coefficienti per categoria',
    ),
    'label' => 'coefficienti',
    'sort' => 26,
    'icon' => 'performance-coefficient-outline',
  ),
  'fields' => 
  array (
    'categoria' => 
    array (
      'name' => 
      array (
        'label' => 'Nome Categoria',
        'placeholder' => 'Inserisci il nome della categoria',
        'help' => 'Nome identificativo della categoria',
      ),
      'codice' => 
      array (
        'label' => 'Codice',
        'placeholder' => 'Inserisci il codice categoria',
        'help' => 'Codice univoco della categoria',
      ),
      'descrizione' => 
      array (
        'label' => 'Descrizione',
        'placeholder' => 'Inserisci la descrizione',
        'help' => 'Descrizione dettagliata della categoria',
      ),
      'livello' => 
      array (
        'label' => 'Livello',
        'placeholder' => 'Seleziona il livello',
        'help' => 'Livello della categoria',
        'options' => 
        array (
          'base' => 'Base',
          'intermedio' => 'Intermedio',
          'avanzato' => 'Avanzato',
          'specialistico' => 'Specialistico',
        ),
      ),
    ),
    'coefficiente' => 
    array (
      'valore' => 
      array (
        'label' => 'Valore Coefficiente',
        'placeholder' => 'Inserisci il valore',
        'help' => 'Valore numerico del coefficiente',
      ),
      'minimo' => 
      array (
        'label' => 'Valore Minimo',
        'placeholder' => 'Inserisci il minimo',
        'help' => 'Valore minimo consentito',
      ),
      'massimo' => 
      array (
        'label' => 'Valore Massimo',
        'placeholder' => 'Inserisci il massimo',
        'help' => 'Valore massimo consentito',
      ),
      'step' => 
      array (
        'label' => 'Incremento',
        'placeholder' => 'Inserisci l\'incremento',
        'help' => 'Valore di incremento permesso',
      ),
    ),
    'applicazione' => 
    array (
      'data_inizio' => 
      array (
        'label' => 'Data Inizio',
        'placeholder' => 'Seleziona la data di inizio',
        'help' => 'Data di inizio validità',
      ),
      'data_fine' => 
      array (
        'label' => 'Data Fine',
        'placeholder' => 'Seleziona la data di fine',
        'help' => 'Data di fine validità',
      ),
      'stato' => 
      array (
        'label' => 'Stato',
        'help' => 'Stato attuale del coefficiente',
        'options' => 
        array (
          'attivo' => 'Attivo',
          'inattivo' => 'Inattivo',
          'in_revisione' => 'In Revisione',
          'scaduto' => 'Scaduto',
        ),
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
    'applyFilters' => 
    array (
      'label' => 'applyFilters',
    ),
    'toggleColumns' => 
    array (
      'label' => 'toggleColumns',
    ),
    'lista_propro' => 
    array (
      'label' => 'lista_propro',
    ),
    'coeff' => 
    array (
      'label' => 'coeff',
    ),
    'descr' => 
    array (
      'label' => 'descr',
    ),
    'tot_giorni' => 
    array (
      'label' => 'tot_giorni',
    ),
    'tot_giorni_pt' => 
    array (
      'label' => 'tot_giorni_pt',
    ),
    'tot_giorni_pt_coeff' => 
    array (
      'label' => 'tot_giorni_pt_coeff',
    ),
    'quota_teorica' => 
    array (
      'label' => 'quota_teorica',
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
    'reorderRecords' => 
    array (
      'label' => 'reorderRecords',
    ),
  ),
  'actions' => 
  array (
    'create' => 
    array (
      'label' => 'Nuovo Coefficiente',
      'success' => 'Coefficiente creato con successo',
      'error' => 'Errore durante la creazione',
    ),
    'update' => 
    array (
      'label' => 'Modifica',
      'success' => 'Coefficiente aggiornato con successo',
      'error' => 'Errore durante l\'aggiornamento',
    ),
    'delete' => 
    array (
      'label' => 'Elimina',
      'success' => 'Coefficiente eliminato con successo',
      'error' => 'Errore durante l\'eliminazione',
      'confirm' => 'Sei sicuro di voler eliminare questo coefficiente?',
    ),
    'apply' => 
    array (
      'label' => 'Applica',
      'success' => 'Coefficiente applicato con successo',
      'error' => 'Errore durante l\'applicazione',
    ),
  ),
  'messages' => 
  array (
    'validation' => 
    array (
      'valore' => 
      array (
        'required' => 'Il valore è obbligatorio',
        'numeric' => 'Il valore deve essere numerico',
        'between' => 'Il valore deve essere tra :min e :max',
      ),
      'categoria' => 
      array (
        'required' => 'La categoria è obbligatoria',
        'exists' => 'La categoria selezionata non esiste',
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
      'overlap_dates' => 'Date sovrapposte con altri coefficienti',
      'invalid_range' => 'Intervallo di valori non valido',
      'category_in_use' => 'Categoria già in uso nel periodo',
      'dependency_conflict' => 'Conflitto con altre configurazioni',
    ),
    'warnings' => 
    array (
      'value_unusual' => 'Valore insolito per la categoria',
      'expiring_soon' => 'Coefficiente in scadenza',
      'review_needed' => 'Necessaria revisione periodica',
    ),
    'info' => 
    array (
      'history_available' => 'Storico modifiche disponibile',
      'auto_calculation' => 'Calcolo automatico applicato',
      'category_stats' => 'Statistiche categoria disponibili',
    ),
  ),
  'model' => 
  array (
    'label' => 'individuale cat coeff.model',
  ),
);
