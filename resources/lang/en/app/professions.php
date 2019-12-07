<?php

return [
    'names' =>
    [
        'sgl'   => 'profession',
        'plr'   => 'professions',
        'ico'	=> 'fa fa-briefcase',
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
            'create' => 'Create profession',
            'edit' => 'Edit profession'
        ],
        'tabs' => [
            'main' => 'Main',
        ],
        'fields' => [
            'name' => [
                'label' => 'Enter name',
                'rules' => 'required'
            ],
            'timezone' => [
                'label' => 'Select timezone',
                'rules' => 'required | one from list'
            ],
        ],
        'legends' => [
            'main' => 'Main info',
        ]
    ]
];