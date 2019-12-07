<?php

return [
    'breadcrumbs' => [
        'home' => 'Home',
        'list' => 'Artists list',
        'create' => 'Create artist',
        'edit' => 'Edit artist'
    ],
    'list' => [
        'title' => 'Artists list',
        'filters' => [
            'name' => 'Filter by name',
            'member' => 'Filter by festival role',
            'profession' => 'filter by profession',
            'url' => 'Filter by url',
            'email' => 'Filter by email',
            'facebook' => 'Filter by facebook',
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
                'festivals' => 'festivals',
                'image' => 'image',
                'name' => 'Name',
                'team_member' => 'Team member',
                'board_member' => 'Board member',
                'email' => 'Email',
                'url' => 'Link',
                'facebook' => 'Facebook',
                'profession' => 'Profession',
                'created_at' => 'Created at',
                'updated_at' => 'Updated at',
                'actions' => 'Actions'
            ],
        ],
    ],
    'form' => [
        'submit' => 'Submit',
        'title' => [
            'create' => 'Create artist',
            'edit' => 'Edit artist'
        ],
        'fields' => [
            'festivals' => [
                'label' => 'Select festivals',
                'rules' => 'select festival member type'
            ],
            'festival' => [
                'label' => 'Add festival',
                'rules' => 'required | one from list'
            ],
            'preview' => [
                'label' => 'Upload preview',
                'rules' => 'max size 10 mb | format: jpeg, jpg, png, gif'
            ],
            'name' => [
                'label' => 'Enter name',
                'rules' => 'required | max 191 chars'
            ],
            'url' => [
                'label' => 'Enter link',
                'rules' => 'max 191 chars'
            ],
            'email' => [
                'label' => 'Enter email',
                'rules' => 'email | max 191 chars'
            ],
            'team_member' => [
                'label' => 'Is team member',
                'rules' => 'yes or no'
            ],
            'board_member' => [
                'label' => 'Is board member',
                'rules' => 'yes or no'
            ],
            'order' => [
                'label' => 'Choose sorting order',
                'rules' => 'one from list'
            ],
            'facebook' => [
                'label' => 'Enter facebook link',
                'rules' => 'max 191 chars'
            ],
            'profession' => [
                'label' => 'Enter profession',
                'rules' => 'max 191 chars'
            ],
            'description' => [
                'label' => 'Enter description',
                'rules' => 'max 25.000 chars'
            ],
            'vocation_ids' => [
                'label' => 'Select vocations',
                'rules' => 'few form list'
            ],
            'profession_id' => [
                'label' => 'Select profession',
                'rules' => 'one form list'
            ],
        ],
        'legends' => [
            'main' => 'Main info',
        ]
    ]
];