<?php

return [
    'breadcrumbs' => [
        'home' => 'Home',
        'list' => 'Festivals list',
        'create' => 'Create festival',
        'edit' => 'Edit festival'
    ],
    'list' => [
        'title' => 'Festivals list',
        'filters' => [
            'name' => 'Filter by name',
            'active' => 'Filter by status',
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
                'year' => 'Year',
                'status' => 'Status',
                'created_at' => 'Created at',
                'updated_at' => 'Updated at',
                'published' => 'Published',
                'actions' => 'Actions'
            ],
        ],
    ],
    'form' => [
        'title' => [
            'create' => 'Create festival',
            'edit' => 'Edit festival'
        ],
        'tabs' => [
            'main' => 'Main',
            'secondary' => 'Secondary'
        ],
        'fields' => [
            'preview' => [
                'label' => 'Upload preview',
                'rules' => 'max size 10 mb | format: jpeg, jpg, png, gif'
            ],
            'slider_id' => [
                'label' => 'Select slider',
                'rules' => 'one from list'
            ],
            'name' => [
                'label' => 'Enter title',
                'rules' => 'required | max 191 chars'
            ],
            'about_festival' => [
                'label' => 'Enter festival description',
                'rules' => 'max 25.000 chars'
            ],
            'program_description' => [
                'label' => 'Enter program description',
                'rules' => 'max 25.000 chars'
            ],
            'year' => [
                'label' => 'Enter year',
                'rules' => 'max 191 chars'
            ],
            'slug' => [
                'label' => 'Enter slug',
                'rules' => 'max 191 chars'
            ],
            'active' => [
                'label' => 'Toggle active',
                'rules' => 'yes or no'
            ],
            'published' => [
                'label' => 'Toggle published',
                'rules' => 'yes or no'
            ],
            'color' => [
                'label' => 'Color',
                'rules' => 'yes or no'
            ],
            'program_url' => [
                'label' => 'Enter program url',
                'rules' => 'max 191 chars'
            ],
            'gallery' => [
                'label' => 'Select gallery',
                'rules' => ''
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