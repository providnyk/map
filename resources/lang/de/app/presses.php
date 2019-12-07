<?php

return [
    'breadcrumbs' => [
        'home' => 'Home',
        'list' => 'Press list',
        'create' => 'Create press',
        'edit' => 'Edit press'
    ],
    'list' => [
        'title' => 'Press list',
        'filters' => [
            'title' => 'Filter by title',
            'city' => 'Filter by city',
            'type' => 'Filter by type',
            'festival' => 'Filter by festival',
            'category' => 'Filter by category',
            'created_at' => 'Filter by created date',
            'updated_at' => 'Filter by updated date',
        ],
        'buttons' => [
            'add' => 'Add new',
            'reset' => 'Reset filters',
            'apply' => 'Apply filter',
            'delete' => 'Deleted selected'
        ],
        'table' => [
            'columns' => [
                'title' => 'Title',
                'volume' => 'Volume',
                'festival' => 'Festival',
                'type' => 'Type',
                'category' => 'Category',
                'city' => 'City',
                'created_at' => 'Created at',
                'updated_at' => 'Updated at',
                'actions' => 'Actions'
            ],
        ],
    ],
    'form' => [
        'title' => [
            'create' => 'Create press',
            'edit' => 'Edit press'
        ],
        'tabs' => [
            'main' => 'Main',
            'seo' => 'Seo'
        ],
        'fields' => [
            'published_at' => [
                'label' => 'publish date',
                'rules' => 'date'
            ],
            'city_id' => [
                'label' => 'Enter city',
                'rules' => 'one from list'
            ],
            'url' => [
                'label' => 'Enter link',
                'rules' => 'required'
            ],
            'type' => [
                'label' => 'Select type',
                'rules' => 'required'
            ],
            'api_code' => [
                'label' => 'Enter api code',
                'rules' => 'required'
            ],
            'links' => [
                'youtube' => [
                    'label' => 'Enter youtube link',
                    'rules' => 'required'
                ],
                'vimeo' => [
                    'label' => 'Enter vimeo link',
                    'rules' => 'required'
                ],
            ],
            //Translateble
            'title' => [
                'label' => 'Enter title',
                'rules' => 'max 191 chars'
            ],
            'description' => [
                'label' => 'Enter description',
                'rules' => 'max 191 chars'
            ],
            'volume' => [
                'label' => 'Enter volume',
                'rules' => 'max 191 chars'
            ],
            'category' => [
                'label' => 'Select category',
                'rules' => 'one from list'
            ],
            'description' => [
                'label' => 'Enter description',
                'rules' => 'max 25.000 chars'
            ],
            'festival_id' => [
                'label' => 'Select festival',
                'rules' => 'one from list'
            ],
            'author_ids' => [
                'label' => 'Select authors',
                'rules' => 'few from list'
            ],
            'doc' => [
                'label' => 'Select doc file',
                'rules' => 'max 10 mb'
            ],
            'arch' => [
                'label' => 'Select archive',
                'rules' => 'max 10 mb'
            ],
            'preview' => [
                'label' => 'Select preview',
                'rules' => 'max 10 mb'
            ],
            'meta_title' => [
                'label' => 'Enter meta title',
                'rules' => 'max 191 chars'
            ],
            'meta_keywords' => [
                'label' => 'Enter meta keywords',
                'rules' => 'max 191 chars'
            ],
            'meta_description' => [
                'label' => 'Enter meta description',
                'rules' => 'max 25.000 chars'
            ],
        ],
        'legends' => [
            'main' => 'Main info',
            'seo' => 'SEO data'
        ]
    ]
];
