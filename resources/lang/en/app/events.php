<?php

return [
    'breadcrumbs' => [
        'list' => 'Events list',
        'create' => 'Create event',
        'edit' => 'Edit event'
    ],
    'list' => [
        'title' => 'Events list',
        'table' => [
            'columns' => [
                'id' => 'ID',
                'title' => 'Title',
                'slug' => 'Slug',
                'promoted' => 'Promoted',
                'festival' => 'Festival',
                'category' => 'Category',
                'created_at' => 'Created at',
                'updated_at' => 'Updated at',
                'actions' => 'Actions'
            ],
        ],
    ],
    'form' => [
        'title' => [
            'create' => 'Create event',
            'edit' => 'Edit event'
        ],
        'tabs' => [
            'main' => 'Main',
            'secondary' => 'Secondary'
        ],
        'fields' => [
            'image' => [
                'label' => 'Upload preview',
                'rules' => 'max 10 mb'
            ],
            'promoting_up' => [
                'label' => 'Is promoted (top of Main Page)',
                'rules' => 'yes or no'
            ],
            'promoting' => [
                'label' => 'Is promoted (bottom of pages)',
                'rules' => 'yes or no'
            ],
            'facebook' => [
                'label' => 'Facebook link (without domain)',
                'rules' => 'max 255 chars'
            ],
            'holdings' => [
                'label' => 'Add dates',
                'rules' => 'fields group',
                'date' => 'Pick a date',
                'place' => 'Select a place',
                'ticket_url' => 'Enter a ticket url'
            ],
            'vocations' => [
                'label' => 'Add vocations',
                'artist' => 'Select artist',
                'rules' => 'fields group',
                'date' => 'Pick a date',
                'place' => 'Select a vocation',
                'ticket_url' => 'Enter a ticket url'
            ],
            'people' => [
                'label' => 'Select people',
            ],
            'body' => [
                'label' => 'Enter body',
                'rules' => 'max 25.000 chars'
            ],
            'roles' => [
                'directors' => [
                    'label' => 'Select directors',
                    'rules' => 'few from list'
                ],
                'artists' => [
                    'label' => 'Select artists',
                    'rules' => 'few from list'
                ],
                'executive_producers' => [
                    'label' => 'Executive producer',
                    'rules' => 'few from list'
                ],
                'producers' => [
                    'label' => 'Producer',
                    'rules' => 'few from list'
                ]
            ],
        ],
        'legends' => [
            'main' => 'Main info',
            'seo' => 'Seo data',
        ],
        'add_holding' => 'Add dates',
        'delete_holding' => 'Delete holding',
        'append_vocation' => 'Append vocation',
        'delete_vocation' => 'Delete vocation',
        'append_artist' => 'Append artist',
        'delete_artist' => 'Delete artist',
    ]
];