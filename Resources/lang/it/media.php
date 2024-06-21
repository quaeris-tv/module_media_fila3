<?php

declare(strict_types=1);

return [
    // 'resources' => 'Risorse',
    'pages' => 'Pagine',
    'widgets' => 'Widgets',
    'navigation' => [
        'name' => 'Media',
        'plural' => 'Media',
        'group' => [
            'name' => '',
        ],
    ],
    'fields' => [
        'name' => 'Nome',
        'guard_name' => 'Guard',
        'collection_name' => 'Collezione',
        'filename' => 'Nome File',
<<<<<<< HEAD
<<<<<<< HEAD
        'mime_type' => 'Tipo',
=======
        'mime_type' => 'Tipo Mime',
        'human_readable_size' => 'size',
>>>>>>> 46d210b0 (up)
=======
        'mime_type' => 'Tipo',
>>>>>>> 8b38a678 (phpstan)
        'permissions' => 'Permessi',
        'updated_at' => 'Aggiornato il',
        'first_name' => 'Nome',
        'last_name' => 'Cognome',
        'select_all' => [
            'name' => 'Seleziona Tutti',
            'message' => '',
        ],
<<<<<<< HEAD
<<<<<<< HEAD
=======
        'collection_name' => 'Collezione',
        'filename' => 'Nome file',
>>>>>>> 46d210b0 (up)
=======
>>>>>>> 8b38a678 (phpstan)
        'human_readable_size' => 'Dimensione',
        'creator' => [
            'name' => 'Creatore',
        ],
        'uploaded_at' => 'Caricato il',
<<<<<<< HEAD
<<<<<<< HEAD
=======
        'mime_type' => 'tipo',
>>>>>>> 46d210b0 (up)
=======
>>>>>>> 8b38a678 (phpstan)
    ],
    'actions' => [
        'import' => [
            'fields' => [
                'import_file' => 'Seleziona un file XLS o CSV da caricare',
            ],
        ],
        'export' => [
            'filename_prefix' => 'Aree al',
            'columns' => [
                'name' => 'Nome area',
                'parent_name' => 'Nome area livello superiore',
            ],
        ],
    ],
];
