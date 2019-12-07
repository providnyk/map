<?php

return [
    'breadcrumbs' => [
        'home' => 'Home',
        'list' => 'Places list',
        'create' => 'Create place',
        'edit' => 'Edit place'
    ],
    'list' => [
        'title' => 'Places list',
        'filters' => [
            'name' => 'Filter by name',
            'city' => 'Filter by city',
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
                'city' => 'City',
                'created_at' => 'Created at',
                'updated_at' => 'Updated at',
                'actions' => 'Actions'
            ],
        ],
    ],
    'form' => [
        'submit' => 'Submit',
        'title' => [
            'create' => 'Create place',
            'edit' => 'Edit place'
        ],
        'tabs' => [
            'main' => 'Main',
            'secondary' => 'Secondary'
        ],
        'fields' => [
            'name' => [
                'label' => 'Enter name',
                'rules' => 'required | max 191 chars'
            ],
            'city_id' => [
                'label' => 'Enter city',
                'rules' => 'one from list'
            ],
        ],
        'legends' => [
            'main' => 'Main info',
        ]
    ]
];