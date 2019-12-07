<?php

return [
    'breadcrumbs' => [
        'home' => 'Home',
        'list' => 'Categories list',
        'create' => 'Create category',
        'edit' => 'Edit category'
    ],
    'list' => [
        'title' => 'Categories list',
        'filters' => [
            'name' => 'Filter by name',
            'slug' => 'Filter by slug',
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
                'slug' => 'Slug',
                'type' => 'Type',
                'created_at' => 'Created at',
                'updated_at' => 'Updated at',
                'actions' => 'Actions'
            ],
        ],
    ],
    'form' => [
        'submit' => 'Submit',
        'title' => [
            'create' => 'Create category',
            'edit' => 'Edit category'
        ],
        'tabs' => [
            'main' => 'Main',
            'seo' => 'Seo'
        ],
        'fields' => [
            //Translateble
            'name' => [
                'label' => 'Enter name',
                'rules' => 'required | max 191 chars'
            ],
            'slug' => [
                'label' => 'Enter slug',
                'rules' => 'max 191 chars'
            ],
            'type' => [
                'label' => 'Select type',
                'rules' => 'one from list'
            ]
        ],
        'legends' => [
            'main' => 'Main info',
            'seo' => 'SEO data'
        ]
    ]
];