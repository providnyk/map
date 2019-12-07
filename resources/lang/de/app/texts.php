<?php

return [
    'breadcrumbs' => [
        'home' => 'Home',
        'list' => 'Texts list',
        'create' => 'Create text',
        'edit' => 'Edit text'
    ],
    'list' => [
        'title' => 'Texts list',
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
                'created_at' => 'Created at',
                'updated_at' => 'Updated at',
                'actions' => 'Actions'
            ],
        ],
    ],
    'form' => [
        'submit' => 'Submit',
        'title' => [
            'create' => 'Create text',
            'edit' => 'Edit text'
        ],
        'tabs' => [
            'main' => 'Main',
        ],
        'fields' => [
            'name' => [
                'label' => 'Enter name',
                'rules' => 'required'
            ],
            'codename' => [
                'label' => 'Enter codename',
                'rules' => 'required'
            ],
            'slug' => [
                'label' => 'Enter slug',
                'rules' => 'max 191 chars'
            ],
            'description' => [
                'label' => 'Enter description',
                'rules' => 'max 25.000 chars'
            ],
        ],
          'legends' => [
            'main' => 'Main info',
        ]
  ]
];