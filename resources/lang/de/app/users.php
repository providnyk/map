<?php

return [
    'breadcrumbs' => [
        'home' => 'Home',
        'list' => 'Users list',
        'create' => 'Create user',
        'edit' => 'Edit user'
    ],
    'list' => [
        'title' => 'Users list',
        'filters' => [
            'roles' => 'Filter by role',
            'first_name' => 'Filter by first name',
            'last_name' => 'Filter by last name',
            'email' => 'filter by email',
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
                'role' => 'Role',
                'name' => 'Name',
                'first_name' => 'First name',
                'last_name' => 'Last name',
                'email' => 'Email',
                'created_at' => 'Created at',
                'updated_at' => 'Updated at',
                'actions' => 'Actions'
            ],
        ],
    ],
    'form' => [
        'submit' => 'Submit',
        'title' => [
            'create' => 'Create user',
            'edit' => 'Edit user'
        ],
        'tabs' => [
            'main' => 'Main',
            'secondary' => 'Secondary'
        ],
        'fields' => [
            'first_name' => [
                'label' => 'Enter first name',
                'rules' => 'required'
            ],
            'last_name' => [
                'label' => 'Enter last name',
                'rules' => 'required'
            ],
            'role_id' => [
                'label' => 'Select role',
                'rules' => 'one from list'
            ],
            'email' => [
                'label' => 'Enter email',
                'rules' => 'required | email'
            ],
            'password' => [
                'label' => 'Enter password',
                'rules' => 'required | min-length: 6 | max-length : 20'
            ],
            'password_confirmation' => [
                'label' => 'Confirm password',
                'rules' => 'required | same: password'
            ],
            'old_password' => [
                'label' => 'Enter old password',
                'rules' => 'required | min-length: 6 | max-length : 20'
            ],
            'new_password' => [
                'label' => 'Enter new password',
                'rules' => 'required | min-length: 6 | max-length : 20'
            ],
            'new_password_confirmation' => [
                'label' => 'Confirm new password',
                'rules' => 'required | min-length: 6 | max-length : 20'
            ],

        ],
        'legends' => [
            'main' => 'Main info',
            'password' => 'Change password'
        ]
    ]
];
