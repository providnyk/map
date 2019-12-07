<?php

return [
    'breadcrumbs' => [
        'home' => 'Home',
        'list' => 'Sliders list',
        'create' => 'Create slider',
        'edit' => 'Edit slider'
    ],
    'list' => [
        'title' => 'Sliders list',
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
            'create' => 'Create slider',
            'edit' => 'Edit slider'
        ],
        'tabs' => [
            'main' => 'Main',
        ],
        'fields' => [
            'title' => [
                'label' => 'Enter slide title',
                'rules' => 'required | max 191 chars'
            ],
            'position' => [
                'label' => 'Enter slide position',
                'rules' => 'required'
            ],
            'slides' => [
                'label' => 'Slides upload',
                'rules' => 'max 10 mb | format: jpeg, jpg, png, gif'
            ],
            'dates' => [
                'label' => 'Enter slide dates',
                'rules' => 'required | max 191 chars'
            ],
            'upper_title' => [
                'label' => 'Enter primary title',
                'rules' => 'required | max 191 chars'
            ],
            'description' => [
                'label' => 'Enter slide description',
                'rules' => 'required | max 191 chars'
            ],
            'button_text' => [
                'label' => 'Enter slide button text',
                'rules' => 'required | max 191 chars'
            ],
            'button_url' => [
                'label' => 'Enter slide button url',
                'rules' => 'required | max 191 chars'
            ],
        ],
        'legends' => [
            'main' => 'Main info',
        ]
    ]
];