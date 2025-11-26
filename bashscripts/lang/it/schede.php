<?php return array (
  'navigation' => 
  array (
    'name' => 'schede',
    'plural' => 'schede',
    'group' => 
    array (
      'name' => '',
    ),
    'sort' => 28,
  ),
  'actions' => 
  array (
    'import' => 
    array (
      'name' => 'Importa da file',
      'fields' => 
      array (
        'import_file' => 'Seleziona un file XLS o CSV da caricare',
      ),
    ),
    'export' => 
    array (
      'name' => 'Esporta dati',
      'filename_prefix' => 'Aree al',
      'columns' => 
      array (
        'name' => 'Nome area',
        'parent_name' => 'Nome area livello superiore',
      ),
    ),
  ),
  'tab' => 
  array (
    'index' => 'lista',
    'create' => 'aggiungi',
  ),
  'fields' => 
  array (
    'name' => 'Nome',
    'parent' => 'Padre',
    'parent.name' => 'Padre',
    'parent_name' => 'Padre',
    'assets' => 'assets',
    'id' => 'ID',
    'id_placeholder' => ' ',
    'cognome' => 'Cognome',
    'cognome_placeholder' => ' ',
    'nome' => 'Nome',
    'nome_placeholder' => ' ',
    'ente' => 'ente',
    'matr' => 'Matr',
    'full_name' => 'Cognome Nome',
    'totale' => 'Totale',
    'totale_pond' => 'Totale Ponderato',
    'excellences_count_last_3_years' => 'n. eccellenze',
    'ha_diritto' => 'ha_diritto',
    'perf_ind_media' => 'Media Performance',
    'gg_cateco_posfun_no_asz' => 'Giorni Ultima posfun senza asz',
    'gg_in_sede' => 'Giorni in sede',
    'eta' => 'Età',
    'motivo' => 'motivo',
    'motivo_placeholder' => ' ',
    'stabi' => 'stabi',
    'stabi_txt' => 'stabi_txt',
    'repar' => 'repar',
    'repar_txt' => 'repar_txt',
    'rep2kd' => 'rep2kd',
    'rep2ka' => 'rep2ka',
    'propro' => 'propro',
    'posfun' => 'posfun',
    'qua2kd' => 'qua2kd',
    'qua2ka' => 'qua2ka',
    'categoria_eco' => 'categoria_eco',
    'anno' => 
    array (
      'label' => 'anno',
    ),
    'punt_progressione' => 'voto',
    'punt_progressione_placeholder' => 'da 1 a 4',
    'valutatore_id' => 
    array (
      'label' => 'Valutatore',
    ),
    'valutatore_id_placeholder' => '---',
    'year' => 'Anno',
    'year_placeholder' => 'anno es 2019',
    'sort_by_placeholder' => '  ',
    'sort_order_placeholder' => '  ',
    'sort' => 
    array (
      'by_placeholder' => ' ',
      'order_placeholder' => ' ',
    ),
    'benificiario_progressione' => 'Benificiario della Progressione',
    'benificiario_progressione_placeholder' => 'Seleziona se è il benificiario',
    'email' => 'E-mail',
    'email_placeholder' => 'es: marco@example.com',
    'anno/valutatore' => 
    array (
      'label' => 'anno/valutatore',
    ),
    'create' => 
    array (
      'label' => 'create',
    ),
  ),
  'schede' => 
  array (
    'field' => 
    array (
      'stabi' => 'stabi',
      'benificiario_progressione' => 'Benificiario della Progressione',
      'benificiario_progressione_placeholder' => 'Seleziona se è il benificiario',
    ),
  ),
);