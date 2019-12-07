<?php

return [
    'breadcrumbs' => [
        'home' => 'Home',
        'list' => 'Settings list',
        'create' => 'Create settings',
        'edit' => 'Edit settings'
    ],
    'list' => [
        'title' => 'Settings list',
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
                'title' => 'Project title',
                'created_at' => 'Created at',
                'updated_at' => 'Updated at',
                'actions' => 'Actions'
            ],
        ],
    ],
    'form' => [
        'submit' => 'Submit',
        'title' => [
            'create' => 'Create settings',
            'edit' => 'Edit settings'
        ],
        'tabs' => [
            'main' => 'Main',
        ],
        'fields' => [
            'title' => [
                'label' => 'Enter Project title',
                'rules' => 'required'
            ],
            'domain' => [
                'label' => 'Enter Project Domain',
                'rules' => 'required'
            ],
            'established' => [
                'label' => 'Enter Project Established Year',
                'rules' => 'required'
            ],
            'facebook' => [
                'label' => 'Facebook link (without domain)',
                'rules' => 'required'
            ],
            'youtube' => [
                'label' => 'Youtube link (without domain)',
                'rules' => 'required'
            ],
            'instagram' => [
                'label' => 'Instagram link (without domain)',
                'rules' => 'required'
            ],
        ],
          'legends' => [
            'main' => 'Main info',
        ]
  ]
];