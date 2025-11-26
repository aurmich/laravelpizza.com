<?php

return array (
  'navigation' => 
  array (
    'name' => 'Criteri di Maggiorazione',
    'plural' => 'Criteri di Maggiorazione',
    'group' => 
    array (
      'name' => 'Valutazione & KPI',
      'description' => 'Gestione dei criteri di maggiorazione',
    ),
    'label' => 'Criteri di Maggiorazione',
    'sort' => 62,
    'icon' => 'performance-criteria-outline',
  ),
  'fields' => 
  array (
    'name' => 
    array (
      'label' => 'Nome',
      'placeholder' => 'Inserisci il nome',
      'help' => 'Nome del criterio di maggiorazione',
    ),
    'descrizione' => 
    array (
      'label' => 'Descrizione',
      'placeholder' => 'Inserisci la descrizione',
      'help' => 'Descrizione dettagliata del criterio',
    ),
    'percentuale' => 
    array (
      'label' => 'Percentuale',
      'placeholder' => 'Inserisci la percentuale',
      'help' => 'Percentuale di maggiorazione',
    ),
    'tipo' => 
    array (
      'label' => 'Tipo',
      'placeholder' => 'Seleziona il tipo',
      'help' => 'Tipo di maggiorazione',
      'options' => 
      array (
        'responsabilita' => 'Responsabilità',
        'complessita' => 'Complessità',
        'rischio' => 'Rischio',
      ),
    ),
    'attivo' => 
    array (
      'label' => 'Attivo',
      'help' => 'Indica se il criterio è attualmente in uso',
    ),
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
    'note' => 
    array (
      'label' => 'Note',
      'placeholder' => 'Inserisci eventuali note',
      'help' => 'Note aggiuntive sul criterio',
    ),
    'anno' => 
    array (
      'label' => 'anno',
    ),
  ),
  'actions' => 
  array (
    'create' => 
    array (
      'label' => 'Nuovo Criterio',
      'success' => 'Criterio creato con successo',
    ),
    'edit' => 
    array (
      'label' => 'Modifica',
      'success' => 'Criterio aggiornato con successo',
    ),
    'delete' => 
    array (
      'label' => 'Elimina',
      'success' => 'Criterio eliminato con successo',
    ),
  ),
  'messages' => 
  array (
    'validation' => 
    array (
      'required' => 'Campo obbligatorio',
      'numeric' => 'Il valore deve essere numerico',
      'min' => 'Il valore minimo è :min',
      'max' => 'Il valore massimo è :max',
      'date' => 'Data non valida',
      'date_after' => 'La data deve essere successiva a :date',
      'date_before' => 'La data deve essere precedente a :date',
    ),
  ),
);
