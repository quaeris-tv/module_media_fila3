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
<<<<<<< HEAD
        'guard_name' => 'Guard',
=======
        'collection_name' => 'Collezione',
        'filename' => 'Nome File',
        'mime_type' => 'Tipo Mime',
        'human_readable_size' => 'size',
>>>>>>> e12fd656 (up)
        'permissions' => 'Permessi',
        'updated_at' => 'Aggiornato il',
        'first_name' => 'Nome',
        'last_name' => 'Cognome',
        'select_all' => [
            'name' => 'Seleziona Tutti',
            'message' => '',
        ],
<<<<<<< HEAD
        'collection_name' => 'Collezione',
        'filename' => 'Nome file',
        'human_readable_size' => 'Dimensione',
=======
>>>>>>> e12fd656 (up)
        'creator' => [
            'name' => 'Creatore',
        ],
        'uploaded_at' => 'Caricato il',
<<<<<<< HEAD
        'mime_type' => 'tipo',
=======
>>>>>>> e12fd656 (up)
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
