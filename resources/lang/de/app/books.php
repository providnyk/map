<?php

return [
    'breadcrumbs' => [
        'list' => 'Books list',
        'create' => 'Create book',
        'edit' => 'Edit book'
    ],
    'list' => [
        'title' => 'Books list',
        'table' => [
            'columns' => [
                'id' => 'ID',
                'name' => 'Name',
                'url' => 'Url',
                'image' => 'image',
                'created_at' => 'Created at',
                'updated_at' => 'Updated at',
                'actions' => 'Actions'
            ],
        ],
    ],
    'form' => [
        'title' => [
            'create' => 'Create book',
            'edit' => 'Edit book'
        ],
        'fields' => [
            //Translateble
            'volume' => [
                'label' => 'Enter volume',
                'rules' => 'max 191 chars'
            ],
            'excerpt' => [
                'label' => 'Enter excerpt',
                'rules' => 'max 191 chars'
            ],
        ],
        'legends' => [
            'main' => 'Main info',
            'seo' => 'SEO data'
        ]
    ]
];