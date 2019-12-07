<?php

return [
    'breadcrumbs' => [
        'home' => 'Home',
        'list' => 'Galleries list',
        'create' => 'Create gallery',
        'edit' => 'Edit gallery'
    ],
    'list' => [
        'title' => 'Galleries list',
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
                'amount' => 'Photos amount',
                'created_at' => 'Created at',
                'updated_at' => 'Updated at',
                'actions' => 'Actions'
            ],
        ],
    ],
    'form' => [
        'submit' => 'Submit',
        'title' => [
            'create' => 'Create gallery',
            'edit' => 'Edit gallery'
        ],
        'tabs' => [
            'main' => 'Main',
            'secondary' => 'Secondary'
        ],
        'fields' => [
            'name' => [
                'label' => 'Enter name',
                'rules' => 'required'
            ],
            'images' => [
                'label' => 'Upload images',
                'rules' => 'max size 10 mb | format: jpeg, jpg, png, gif'
            ],
            'api_code' => [
                'label' => 'Enter api code',
                'rules' => 'required'
            ]
        ],
        'legends' => [
            'main' => 'Main info',
        ]
    ]
];