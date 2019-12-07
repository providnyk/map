<?php

return [
    'names' =>
    [
        'sgl'   => 'page',
        'plr'   => 'pages',
        'ico'	=> 'icon-versions',
    ],
    'list' => [
        'filters' => [
            'name' => 'Filter by name',
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
                'id' => 'ID',
                'name' => 'Name',
                'url' => 'Url',
                'created_at' => 'Created at',
                'updated_at' => 'Updated at',
                'actions' => 'Actions'
            ],
        ],
    ],
    'form' => [
        'submit' => 'Submit',
        'title' => [
            'create' => 'Create page',
            'edit' => 'Edit page'
        ],
        'tabs' => [
            'main' => 'Main',
        ],
        'fields' => [
            'name' => [
                'label' => 'Enter name',
                'rules' => 'required | max 191 chars'
            ],
            'slug' => [
                'label' => 'Enter slug',
                'rules' => 'max 191 chars'
            ],
            'excerpt' => [
                'label' => 'Enter excerpt',
                'rules' => 'required | max 191 chars'
            ],
            'body' => [
                'label' => 'Enter body',
                'rules' => 'max 25.000 chars'
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
                'rules' => 'max 10.000 chars'
            ],
        ],
        'legends' => [
            'main' => 'Main info',
            'seo' => 'Seo data'
        ]
    ]
];