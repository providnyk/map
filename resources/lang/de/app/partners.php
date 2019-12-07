<?php

return [
    'breadcrumbs' => [
        'home' => 'Home',
        'list' => 'Partners list',
        'create' => 'Create partner',
        'edit' => 'Edit partner'
    ],
    'list' => [
        'title' => 'Partners list',
        'filters' => [
            'categories' => 'filter by categories',
            'festivals' => 'filter by festivals',
            'created_at' => 'filter by created date',
            'updated_at' => 'filter by updated date',
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
                'url' => 'Link',
                'image' => 'Image',
                'category' => 'Category',
                'festivals' => 'Festivals',
                'created_at' => 'Created at',
                'updated_at' => 'Updated at',
                'actions' => 'Actions'
            ],
        ],
    ],
    'form' => [
        'submit' => 'Submit',
        'title' => [
            'create' => 'Create partner',
            'edit' => 'Edit partner'
        ],
        'tabs' => [
            'main' => 'Main',
            'secondary' => 'Secondary'
        ],
        'fields' => [
            'preview' => [
                'label' => 'upload preview',
                'rules' => 'required | max 10 mb | format: jpeg, jpg, png, gif'
            ],
            'url' => [
                'label' => 'Enter url',
                'rules' => ''
            ],
            'category_id' => [
                'label' => 'Select category',
                'rules' => 'one from list'
            ],
            'festival_id' => [
                'label' => 'Select festival',
                'rules' => 'one from list'
            ],
            'promoting' => [
                'label' => 'Switch is promoting',
                'rules' => 'yes or no'
            ],


        ],
        'legends' => [
            'main' => 'Main info',
        ]
    ]
];