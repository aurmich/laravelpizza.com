<?php

return array (
  'navigation' => 
  array (
    'name' => 'Totale Stabilimento',
    'plural' => 'Totali Stabilimenti',
    'group' => 
    array (
      'name' => 'Valutazione',
      'description' => 'Gestione delle performance individuali',
    ),
    'label' => 'Totali Stabilimento',
    'sort' => 52,
    'icon' => 'heroicon-o-building-office',
  ),
  'fields' => 
  array (
    'stabilimento' => 
    array (
      'name' => 
      array (
        'label' => 'Nome Stabilimento',
        'placeholder' => 'Inserisci il nome dello stabilimento',
        'help' => 'Nome identificativo dello stabilimento',
      ),
      'codice' => 
      array (
        'label' => 'Codice',
        'placeholder' => 'Inserisci il codice stabilimento',
        'help' => 'Codice univoco dello stabilimento',
      ),
      'tipo' => 
      array (
        'label' => 'Tipologia',
        'placeholder' => 'Seleziona la tipologia',
        'help' => 'Tipo di stabilimento',
        'options' => 
        array (
          'produzione' => 'Produzione',
          'servizi' => 'Servizi',
          'amministrativo' => 'Amministrativo',
        ),
      ),
    ),
    'performance' => 
    array (
      'totale' => 
      array (
        'label' => 'Totale Performance',
        'placeholder' => 'Inserisci il totale',
        'help' => 'Punteggio totale delle performance',
      ),
      'media' => 
      array (
        'label' => 'Media Performance',
        'help' => 'Media delle performance individuali',
      ),
      'periodo' => 
      array (
        'label' => 'Periodo',
        'placeholder' => 'Seleziona il periodo',
        'help' => 'Periodo di riferimento',
      ),
    ),
    'dipendenti' => 
    array (
      'numero' => 
      array (
        'label' => 'Numero Dipendenti',
        'help' => 'Totale dipendenti dello stabilimento',
      ),
      'valutati' => 
      array (
        'label' => 'Dipendenti Valutati',
        'help' => 'Numero di dipendenti con valutazione',
      ),
      'da_valutare' => 
      array (
        'label' => 'Da Valutare',
        'help' => 'Dipendenti in attesa di valutazione',
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
    'stabi' => 
    array (
      'label' => 'stabi',
    ),
    'tot_budget_assegnato' => 
    array (
      'label' => 'tot_budget_assegnato',
    ),
    'tot_budget_assegnato_min_punteggio' => 
    array (
      'label' => 'tot_budget_assegnato_min_punteggio',
    ),
    'tot_quota_effettiva' => 
    array (
      'label' => 'tot_quota_effettiva',
    ),
    'tot_quota_effettiva_min_punteggio' => 
    array (
      'label' => 'tot_quota_effettiva_min_punteggio',
    ),
    'tot_resti' => 
    array (
      'label' => 'tot_resti',
    ),
    'tot_resti_min_punteggio' => 
    array (
      'label' => 'tot_resti_min_punteggio',
    ),
    'delta' => 
    array (
      'label' => 'delta',
    ),
    'delta_min_punteggio' => 
    array (
      'label' => 'delta_min_punteggio',
    ),
    'anno' => 
    array (
      'label' => 'anno',
    ),
    'n_diritto' => 
    array (
      'label' => 'n_diritto',
    ),
    'n_diritto_excellence' => 
    array (
      'label' => 'n_diritto_excellence',
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
  ),
  'actions' => 
  array (
    'calculate' => 
    array (
      'label' => 'Calcola Totali',
      'success' => 'Totali calcolati con successo',
      'error' => 'Errore durante il calcolo dei totali',
    ),
    'export' => 
    array (
      'label' => 'Esporta Report',
      'success' => 'Report esportato con successo',
      'error' => 'Errore durante l\'esportazione',
    ),
    'refresh' => 
    array (
      'label' => 'Aggiorna',
      'success' => 'Dati aggiornati con successo',
      'error' => 'Errore durante l\'aggiornamento',
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
      'totale' => 
      array (
        'required' => 'Il totale è obbligatorio',
        'numeric' => 'Il totale deve essere numerico',
        'min' => 'Il totale deve essere maggiore di zero',
      ),
      'periodo' => 
      array (
        'required' => 'Il periodo è obbligatorio',
        'date' => 'Il periodo deve essere una data valida',
      ),
    ),
    'errors' => 
    array (
      'calculation_failed' => 'Calcolo dei totali fallito',
      'missing_data' => 'Dati insufficienti per il calcolo',
      'invalid_period' => 'Periodo non valido',
    ),
    'warnings' => 
    array (
      'incomplete_evaluations' => 'Valutazioni incomplete',
      'missing_employees' => 'Dipendenti mancanti',
      'outdated_data' => 'Dati non aggiornati',
    ),
    'info' => 
    array (
      'calculation_started' => 'Calcolo totali avviato',
      'export_ready' => 'Report pronto per il download',
      'data_updated' => 'Dati aggiornati all\'ultima versione',
    ),
    'success' => 
    array (
      'created' => 'Record creato con successo',
      'updated' => 'Record aggiornato con successo',
      'deleted' => 'Record eliminato con successo',
    ),
    'error' => 
    array (
      'created' => 'Errore durante la creazione del record',
      'updated' => 'Errore durante l\'aggiornamento del record',
      'deleted' => 'Errore durante l\'eliminazione del record',
    ),
  ),
  'model' => 
  array (
    'label' => 'individuale tot stabi.model',
  ),
);
