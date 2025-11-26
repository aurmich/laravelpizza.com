<?php 
return array (
  'resource' => 
  array (
    'name' => 'Indennita responsabilità',
  ),
  'navigation' => 
  array (
    'name' => 'Indennita responsabilità',
    'plural' => 'Indennita responsabilità',
    'group' => 
    array (
      'name' => '',
    ),
    'label' => 'indennita responsabilita',
    'sort' => 91,
  ),
  'fields' => 
  array (
    'brand' => 'Marca',
    'model' => 'Modello',
    'description' => 'Descrizione',
    'serial_number' => 'Numero di serie',
    'inventory_number' => 'Codice inventario',
    'code' => 'Identificativo',
    'manufacturing_year' => 'Anno di fabbricazione',
    'purchase_year' => 'Anno di acquisto',
    'is_enabled' => 'È attivo?',
    'asset_type' => 'Tipologia',
    'area' => 'Area',
    'parent' => 'Asset genitore',
    'name' => 'Nome',
    'anno' => 
    array (
      'label' => 'Anno',
    ),
    'matr' => 
    array (
      'label' => 'Matricola',
    ),
    'cognome' => 
    array (
      'label' => 'Cognome',
    ),
    'nome' => 
    array (
      'label' => 'Nome',
    ),
    'data_nascita' => 
    array (
      'label' => 'Data di nascita',
    ),
    'stabi' => 
    array (
      'label' => 'Stabi',
    ),
    'repar' => 
    array (
      'label' => 'Repar',
    ),
    'sent_email_list' => 
    array (
      'label' => 'Lista email inviate',
    ),
    'is_compiled' => 
    array (
      'label' => 'is_compiled',
    ),
    'valutatore_id' => 
    array (
      'label' => 'valutatore_id',
    ),
    'anno/valutatore' => 
    array (
      'label' => 'anno/valutatore',
    ),
    'edit' => 
    array (
      'label' => 'edit',
    ),
    'record-pdf' => 
    array (
      'label' => 'record-pdf',
    ),
    'compila' => 
    array (
      'label' => 'compila',
    ),
  ),
  'actions' => 
  array (
    'enable' => 
    array (
      'cta' => 'Attiva',
    ),
    'disable' => 
    array (
      'cta' => 'Dismetti',
    ),
    'import' => 
    array (
      'row_number' => 'Riga :row',
      'fields' => 
      array (
        'import_file' => 'Seleziona un file XLS o CSV da caricare',
      ),
    ),
    'export' => 
    array (
      'filename_prefix' => 'Lista asset al',
      'columns' => 
      array (
        'brand' => 'Marca',
        'model' => 'Modello',
        'description' => 'Descrizione',
        'serial_number' => 'Numero di serie',
        'inventory_number' => 'Codice inventario',
        'code' => 'Identificativo',
        'manufacturing_year' => 'Anno di fabbricazione',
        'purchase_year' => 'Anno di acquisto',
        'is_enabled' => 'È attivo?',
        'asset_type' => 'Tipologia',
        'parent_inventory_number' => 'Codice inventario genitore',
      ),
    ),
  ),
  'widgets' => 
  array (
    'child_assets' => 'Asset figli',
  ),
  'exceptions' => 
  array (
    'mandatory_data' => '{1} Dato obbligatorio non presente|{2} 2 Dati obbligatori non presenti|{3} 3 Dati obbligatori non presenti|[4,*] Vari dati obbligatori non presenti',
  ),
  'model' => 
  array (
    'label' => 'indennita responsabilita.model',
  ),
);
