<?php return array (
  'pages' => 'Pagine',
  'widgets' => 'Widgets',
  'navigation' => 
  array (
    'name' => 'Media',
    'plural' => 'Media',
    'group' => 
    array (
      'name' => 'Sistema',
      'description' => 'Gestione dei file multimediali',
    ),
    'label' => 'media',
    'sort' => 20,
    'icon' => 'media-main-animated',
  ),
  'fields' => 
  array (
    'name' => 'Nome',
    'guard_name' => 'Guard',
    'collection_name' => 'Collezione',
    'filename' => 'Nome File',
    'mime_type' => 'Tipo',
    'human_readable_size' => 'Dimensione',
    'permissions' => 'Permessi',
    'updated_at' => 'Aggiornato il',
    'first_name' => 'Nome',
    'last_name' => 'Cognome',
    'select_all' => 
    array (
      'name' => 'Seleziona Tutti',
      'message' => '',
    ),
    'creator' => 
    array (
      'name' => 'Creatore',
    ),
    'uploaded_at' => 'Caricato il',
  ),
  'actions' => 
  array (
    'import' => 
    array (
      'fields' => 
      array (
        'import_file' => 'Seleziona un file XLS o CSV da caricare',
      ),
    ),
    'export' => 
    array (
      'filename_prefix' => 'Aree al',
      'columns' => 
      array (
        'name' => 'Nome area',
        'parent_name' => 'Nome area livello superiore',
      ),
    ),
  ),
);