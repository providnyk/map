<?php

return [
    'breadcrumbs' => [
        'home' => 'Home',
        'list' => 'News list',
        'create' => 'Create news',
        'edit' => 'Edit news'
    ],
    'list' => [
        'title' => 'News list',
        'filters' => [
            'event' => 'Filter by event',
            'festivals' => 'filter by festivals',
            'categories' => 'filter by categories',
            'slug' => 'filter by slug',
            'title' => 'filter by title',
            'excerpt' => 'filter by excerpt',
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
                'image' => 'Image',
                'event' => 'Event',
                'festival' => 'Festival',
                'category' => 'Category',
                'slug' => 'Slug',
                'title' => 'Title',
                'excerpt' => 'Excerpt',
                'created_at' => 'Created at',
                'updated_at' => 'Updated at',
                'published' => 'Published',
                'actions' => 'Actions'
            ],
        ],
    ],
    'form' => [
        'submit' => 'Submit',
        'title' => [
            'create' => 'Create news',
            'edit' => 'Edit news'
        ],
        'tabs' => [
            'main' => 'Main',
            'secondary' => 'Secondary'
        ],
        'fields' => [
            'published_at' => [
                'label' => 'publish date',
                'rules' => 'date'
            ],
            'published' => [
                'label' => 'published',
                'rules' => 'yes or no'
            ],
            'promoting' => [
                'label' => 'promote at main page',
                'rules' => 'yes or no'
            ],
            'preview' => [
                'label' => 'upload preview',
                'rules' => 'max 10 mb'
            ],
            'festival' => [
                'label' => 'Select festival',
                'rules' => 'required | one from list'
            ],
            'gallery' => [
                'label' => 'Select gallery',
                'rules' => 'one from list'
            ],
            'event' => [
                'label' => 'Select event',
                'rules' => 'one from list'
            ],
            'category' => [
                'label' => 'Select category',
                'rules' => 'one from list'
            ],
            'name' => [
                'label' => 'Enter name',
                'rules' => 'required | max 191 chars'
            ],
            'slug' => [
                'label' => 'Enter slug',
                'rules' => 'max 191 chars'
            ],
            'title' => [
                'label' => 'Enter title',
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
                'rules' => 'max 25.000 chars'
            ],
        ],
        'legends' => [
            'main' => 'Main info',
            'seo' => 'Seo data'
        ]
    ]
];
