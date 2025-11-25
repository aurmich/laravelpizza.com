<?php

return array (
  'navigation' => 
  array (
<<<<<<< HEAD
    'label' => 'Ruoli',
    'plural_label' => 'Ruoli',
=======
    'name' => 'Ruoli',
    'plural' => 'Ruoli',
>>>>>>> fbc8f8e (.)
    'group' => 
    array (
      'name' => 'Gestione Utenti',
      'description' => 'Gestione dei ruoli e dei permessi associati',
    ),
<<<<<<< HEAD
    'sort' => 26,
    'icon' => 'heroicon-o-user-group',
    'badge' => 'Gestione ruoli e permessi',
  ),
  'model' => 
  array (
    'label' => 'Ruolo',
    'plural' => 'Ruoli',
    'description' => 'Ruoli di accesso e permessi nel sistema',
  ),
  'fields' => 
  array (
    'id' => 
    array (
      'label' => 'ID',
      'tooltip' => 'Identificativo univoco del ruolo',
      'helper_text' => 'Identificativo numerico univoco del ruolo nel sistema',
    ),
    'name' => 
    array (
      'label' => 'Nome Ruolo',
      'placeholder' => 'Inserisci il nome del ruolo',
      'tooltip' => 'Nome identificativo del ruolo, es. "Admin"',
      'helper_text' => 'Nome univoco che identifica il ruolo nel sistema',
      'help' => 'Scegli un nome descrittivo e univoco per il ruolo',
      'validation' => 
      array (
        'required' => 'Il nome del ruolo è obbligatorio',
        'unique' => 'Questo nome ruolo è già in uso',
        'min' => 'Il nome deve essere di almeno :min caratteri',
        'max' => 'Il nome non può superare i :max caratteri',
      ),
=======
    'label' => 'Ruoli',
    'sort' => 26,
    'icon' => 'user-role-animated',
  ),
  'fields' => 
  array (
    'name' => 
    array (
      'label' => 'Nome Ruolo',
      'tooltip' => 'Il nome identificativo del ruolo, es. "Admin".',
      'placeholder' => 'Nome del ruolo',
>>>>>>> fbc8f8e (.)
    ),
    'guard_name' => 
    array (
      'label' => 'Guard',
<<<<<<< HEAD
      'placeholder' => 'Seleziona la guardia',
      'tooltip' => 'Nome della guardia per questo ruolo, es. "web"',
      'helper_text' => 'Sistema di autenticazione utilizzato per questo ruolo',
      'help' => 'Specifica il sistema di autenticazione (web, api, ecc.)',
      'options' => 
      array (
        'web' => 'Web',
        'api' => 'API',
        'sanctum' => 'Sanctum',
      ),
=======
      'tooltip' => 'Il nome della guardia per questo ruolo, es. "web".',
      'placeholder' => 'Nome della guardia',
>>>>>>> fbc8f8e (.)
    ),
    'permissions' => 
    array (
      'label' => 'Permessi',
<<<<<<< HEAD
      'placeholder' => 'Seleziona i permessi',
      'tooltip' => 'Permessi associati a questo ruolo',
      'helper_text' => 'Elenco dei permessi specifici assegnati a questo ruolo',
      'help' => 'Seleziona i permessi che questo ruolo può esercitare',
=======
      'tooltip' => 'Seleziona i permessi associati a questo ruolo.',
      'placeholder' => 'Seleziona permessi',
>>>>>>> fbc8f8e (.)
    ),
    'users_count' => 
    array (
      'label' => 'Numero Utenti',
<<<<<<< HEAD
      'tooltip' => 'Numero di utenti assegnati a questo ruolo',
      'helper_text' => 'Conteggio degli utenti che attualmente hanno questo ruolo assegnato',
    ),
    'description' => 
    array (
      'label' => 'Descrizione',
      'placeholder' => 'Inserisci una descrizione del ruolo',
      'tooltip' => 'Descrizione dettagliata del ruolo e delle sue funzioni',
      'helper_text' => 'Testo descrittivo che spiega lo scopo e le responsabilità del ruolo',
      'help' => 'Fornisci una descrizione chiara delle funzioni del ruolo',
=======
      'tooltip' => 'Il numero di utenti assegnati a questo ruolo.',
>>>>>>> fbc8f8e (.)
    ),
    'created_at' => 
    array (
      'label' => 'Data Creazione',
<<<<<<< HEAD
      'tooltip' => 'Data di creazione del ruolo',
      'helper_text' => 'Data e ora in cui il ruolo è stato creato nel sistema',
=======
      'tooltip' => 'La data in cui il ruolo è stato creato.',
      'placeholder' => 'Data di creazione',
>>>>>>> fbc8f8e (.)
    ),
    'updated_at' => 
    array (
      'label' => 'Ultima Modifica',
<<<<<<< HEAD
      'tooltip' => 'Data dell\'ultima modifica del ruolo',
      'helper_text' => 'Data e ora dell\'ultimo aggiornamento del ruolo',
    ),
    'team_id' => 
    array (
      'label' => 'ID Team',
      'placeholder' => 'Seleziona il team',
      'tooltip' => 'Team associato al ruolo',
      'helper_text' => 'Team specifico al quale questo ruolo appartiene',
      'help' => 'Seleziona il team per cui questo ruolo è valido',
    ),
    'values' => 
    array (
      'label' => 'Valori',
      'tooltip' => 'Valori associati al ruolo',
      'helper_text' => 'Valori aggiuntivi o configurazioni specifiche del ruolo',
    ),
    'enabled' => 
    array (
      'label' => 'Abilitato',
      'tooltip' => 'Stato di abilitazione del ruolo',
      'helper_text' => 'Indica se il ruolo è attualmente attivo e utilizzabile',
      'options' => 
      array (
        'true' => 'Sì',
        'false' => 'No',
      ),
    ),
  ),
  'actions' => 
  array (
    'create' => 
    array (
      'label' => 'Crea Ruolo',
      'icon' => 'heroicon-o-plus',
      'color' => 'primary',
      'tooltip' => 'Crea un nuovo ruolo nel sistema',
      'modal' => 
      array (
        'heading' => 'Crea Nuovo Ruolo',
        'description' => 'Inserisci i dettagli per creare un nuovo ruolo',
        'confirm' => 'Crea Ruolo',
        'cancel' => 'Annulla',
      ),
      'messages' => 
      array (
        'success' => 'Ruolo creato con successo',
        'error' => 'Si è verificato un errore durante la creazione del ruolo',
      ),
    ),
    'edit' => 
    array (
      'label' => 'Modifica Ruolo',
      'icon' => 'heroicon-o-pencil',
      'color' => 'warning',
      'tooltip' => 'Modifica il ruolo selezionato',
      'modal' => 
      array (
        'heading' => 'Modifica Ruolo',
        'description' => 'Aggiorna le informazioni del ruolo',
        'confirm' => 'Salva modifiche',
        'cancel' => 'Annulla',
      ),
      'messages' => 
      array (
        'success' => 'Ruolo modificato con successo',
        'error' => 'Si è verificato un errore durante la modifica del ruolo',
      ),
    ),
    'delete' => 
    array (
      'label' => 'Elimina Ruolo',
      'icon' => 'heroicon-o-trash',
      'color' => 'danger',
      'tooltip' => 'Elimina definitivamente il ruolo',
      'modal' => 
      array (
        'heading' => 'Elimina Ruolo',
        'description' => 'Sei sicuro di voler eliminare questo ruolo? Questa azione è irreversibile.',
        'confirm' => 'Elimina',
        'cancel' => 'Annulla',
      ),
      'messages' => 
      array (
        'success' => 'Ruolo eliminato con successo',
        'error' => 'Si è verificato un errore durante l\'eliminazione del ruolo',
      ),
      'confirmation' => 'Sei sicuro di voler eliminare questo ruolo?',
    ),
    'assign_permissions' => 
    array (
      'label' => 'Assegna Permessi',
      'icon' => 'heroicon-o-key',
      'color' => 'info',
      'tooltip' => 'Assegna permessi al ruolo',
      'modal' => 
      array (
        'heading' => 'Assegna Permessi',
        'description' => 'Seleziona i permessi da assegnare a questo ruolo',
        'confirm' => 'Assegna',
        'cancel' => 'Annulla',
      ),
      'messages' => 
      array (
        'success' => 'Permessi assegnati con successo',
        'error' => 'Si è verificato un errore durante l\'assegnazione dei permessi',
      ),
    ),
    'sync_permissions' => 
    array (
      'label' => 'Sincronizza Permessi',
      'icon' => 'heroicon-o-arrow-path',
      'color' => 'secondary',
      'tooltip' => 'Sincronizza i permessi con quelli di un altro sistema',
      'modal' => 
      array (
        'heading' => 'Sincronizza Permessi',
        'description' => 'Sincronizza i permessi del ruolo con quelli di un altro sistema',
        'confirm' => 'Sincronizza',
        'cancel' => 'Annulla',
      ),
      'messages' => 
      array (
        'success' => 'Permessi sincronizzati con successo',
        'error' => 'Si è verificato un errore durante la sincronizzazione',
      ),
    ),
    'view' => 
    array (
      'label' => 'Visualizza Ruolo',
      'icon' => 'heroicon-o-eye',
      'color' => 'secondary',
      'tooltip' => 'Visualizza i dettagli del ruolo',
    ),
    'bulk_actions' => 
    array (
      'delete' => 
      array (
        'label' => 'Elimina Selezionati',
        'icon' => 'heroicon-o-trash',
        'color' => 'danger',
        'tooltip' => 'Elimina tutti i ruoli selezionati',
        'modal' => 
        array (
          'heading' => 'Elimina Ruoli Selezionati',
          'description' => 'Sei sicuro di voler eliminare i ruoli selezionati? Questa azione è irreversibile.',
          'confirm' => 'Elimina tutti',
          'cancel' => 'Annulla',
        ),
        'messages' => 
        array (
          'success' => 'Ruoli eliminati con successo',
          'error' => 'Si è verificato un errore durante l\'eliminazione dei ruoli',
        ),
      ),
    ),
  ),
  'sections' => 
  array (
    'basic_info' => 
    array (
      'label' => 'Informazioni Base',
      'description' => 'Informazioni fondamentali del ruolo',
      'icon' => 'heroicon-o-information-circle',
    ),
    'permissions' => 
    array (
      'label' => 'Permessi',
      'description' => 'Gestione permessi e autorizzazioni',
      'icon' => 'heroicon-o-key',
    ),
    'settings' => 
    array (
      'label' => 'Impostazioni',
      'description' => 'Configurazioni avanzate del ruolo',
      'icon' => 'heroicon-o-cog',
    ),
  ),
  'filters' => 
  array (
    'guard_name' => 
    array (
      'label' => 'Guard',
      'options' => 
      array (
        'web' => 'Web',
        'api' => 'API',
        'sanctum' => 'Sanctum',
      ),
    ),
    'permissions' => 
    array (
      'label' => 'Permessi',
      'placeholder' => 'Filtra per permessi',
    ),
    'team_id' => 
    array (
      'label' => 'Team',
      'placeholder' => 'Seleziona team',
    ),
  ),
  'messages' => 
  array (
    'empty_state' => 'Nessun ruolo trovato',
    'search_placeholder' => 'Cerca ruoli...',
    'loading' => 'Caricamento ruoli in corso...',
    'total_count' => 'Totale ruoli: :count',
    'created' => 'Ruolo creato con successo',
    'updated' => 'Ruolo aggiornato con successo',
    'deleted' => 'Ruolo eliminato con successo',
    'permissions_updated' => 'Permessi aggiornati con successo',
    'cannot_delete_super_admin' => 'Non puoi eliminare il ruolo di Super Amministratore',
    'role_in_use' => 'Non puoi eliminare un ruolo assegnato a degli utenti',
    'error_general' => 'Si è verificato un errore. Riprova più tardi.',
    'error_validation' => 'Si sono verificati errori di validazione.',
    'error_permission' => 'Non hai i permessi per eseguire questa azione.',
    'success_operation' => 'Operazione completata con successo',
  ),
  'validation' => 
  array (
    'name_required' => 'Il nome del ruolo è obbligatorio',
    'name_unique' => 'Questo nome ruolo è già in uso',
    'name_min' => 'Il nome deve essere di almeno :min caratteri',
    'name_max' => 'Il nome non può superare i :max caratteri',
    'guard_required' => 'La guardia è obbligatoria',
    'permissions_array' => 'I permessi devono essere un array',
    'description_max' => 'La descrizione non può superare i :max caratteri',
  ),
  'descriptions' => 
  array (
    'super_admin' => 'Accesso completo a tutte le funzionalità del sistema',
    'admin' => 'Accesso alla maggior parte delle funzionalità amministrative',
    'manager' => 'Gestione di utenti e contenuti specifici',
    'editor' => 'Modifica e gestione dei contenuti',
    'user' => 'Accesso base alle funzionalità del sistema',
  ),
  'options' => 
  array (
    'roles' => 
    array (
      'super_admin' => 'Super Amministratore',
      'admin' => 'Amministratore',
      'manager' => 'Manager',
      'editor' => 'Editor',
      'user' => 'Utente',
    ),
    'permissions_groups' => 
    array (
      'users' => 'Gestione Utenti',
      'roles' => 'Gestione Ruoli',
      'content' => 'Gestione Contenuti',
      'settings' => 'Impostazioni',
      'reports' => 'Report',
    ),
    'guards' => 
    array (
      'web' => 'Web',
      'api' => 'API',
      'sanctum' => 'Sanctum',
=======
      'tooltip' => 'La data dell\'ultima modifica del ruolo.',
      'placeholder' => 'Ultima modifica',
    ),
    'description' => 
    array (
      'label' => 'Descrizione',
      'tooltip' => 'Una descrizione del ruolo e delle sue funzioni.',
      'placeholder' => 'Descrizione del ruolo',
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
    'team_id' => 
    array (
      'description' => 'team_id',
      'helper_text' => 'team_id',
      'placeholder' => 'team_id',
      'label' => 'team_id',
    ),
    'detach' => 
    array (
      'label' => 'detach',
    ),
    'resetFilters' => 
    array (
      'label' => 'resetFilters',
    ),
    'edit' => 
    array (
      'label' => 'edit',
    ),
    'openFilters' => 
    array (
      'label' => 'openFilters',
    ),
    'attach' => 
    array (
      'label' => 'attach',
    ),
    'recordId' => 
    array (
      'description' => 'recordId',
      'helper_text' => 'recordId',
      'placeholder' => 'recordId',
      'label' => 'recordId',
    ),
    'id' => 
    array (
      'label' => 'id',
>>>>>>> fbc8f8e (.)
    ),
  ),
  'roles' => 
  array (
    'super_admin' => 'Super Amministratore',
    'admin' => 'Amministratore',
    'manager' => 'Manager',
    'editor' => 'Editor',
    'user' => 'Utente',
  ),
<<<<<<< HEAD
  'label' => 'role',
=======
  'actions' => 
  array (
    'create' => 
    array (
      'label' => 'Crea Ruolo',
      'tooltip' => 'Clicca per creare un nuovo ruolo nel sistema.',
      'icon' => 'fa fa-plus',
      'color' => 'success',
    ),
    'edit' => 
    array (
      'label' => 'Modifica Ruolo',
      'tooltip' => 'Clicca per modificare il ruolo selezionato.',
      'icon' => 'fa fa-edit',
      'color' => 'primary',
    ),
    'delete' => 
    array (
      'label' => 'Elimina Ruolo',
      'tooltip' => 'Clicca per eliminare questo ruolo.',
      'icon' => 'fa fa-trash',
      'color' => 'danger',
    ),
    'assign_permissions' => 
    array (
      'label' => 'Assegna Permessi',
      'tooltip' => 'Clicca per assegnare permessi al ruolo.',
      'icon' => 'fa fa-check',
      'color' => 'info',
    ),
    'sync_permissions' => 
    array (
      'label' => 'Sincronizza Permessi',
      'tooltip' => 'Clicca per sincronizzare i permessi con quelli di un altro sistema.',
      'icon' => 'fa fa-sync',
      'color' => 'warning',
    ),
  ),
  'messages' => 
  array (
    'created' => 'Ruolo creato con successo',
    'updated' => 'Ruolo aggiornato con successo',
    'deleted' => 'Ruolo eliminato con successo',
    'permissions_updated' => 'Permessi aggiornati con successo',
    'cannot_delete_super_admin' => 'Non puoi eliminare il ruolo di Super Amministratore',
    'role_in_use' => 'Non puoi eliminare un ruolo assegnato a degli utenti',
  ),
  'descriptions' => 
  array (
    'super_admin' => 'Accesso completo a tutte le funzionalità del sistema.',
    'admin' => 'Accesso alla maggior parte delle funzionalità amministrative.',
    'manager' => 'Gestione di utenti e contenuti specifici.',
    'editor' => 'Modifica e gestione dei contenuti.',
    'user' => 'Accesso base alle funzionalità del sistema.',
  ),
  'permissions_groups' => 
  array (
    'users' => 'Gestione Utenti',
    'roles' => 'Gestione Ruoli',
    'content' => 'Gestione Contenuti',
    'settings' => 'Impostazioni',
    'reports' => 'Report',
  ),
>>>>>>> fbc8f8e (.)
);
