<?php

return [
    'breadcrumbs' => [
        'list' => 'Media list',
        'create' => 'Create media',
        'edit' => 'Edit media'
    ],
    'list' => [
        'title' => 'Media list',
        'table' => [
            'columns' => [
                'id' => 'ID',
                'title' => 'Title',
                'author' => 'Author',
                'created_at' => 'Created at',
                'updated_at' => 'Updated at',
                'published' => 'Published',
                'published_at' => 'Published at',
                'actions' => 'Actions'
            ],
        ],
    ],
    'form' => [
        'title' => [
            'create' => 'Create media',
            'edit' => 'Edit media'
        ],
        'fields' => [
            'promoting' => [
                'label' => 'Promote at main page',
                'rules' => 'yes or no'
            ],
            //Translateble
            'author' => [
                'label' => 'Enter author',
                'rules' => 'required'
            ],
            'file' => [
                'label' => 'Select file',
                'rules' => 'required'
            ],
            'doc' => [
                'label' => 'Upload doc file',
                'rules' => 'max 10 mb | format: pdf, doc, docx'
            ],
            'archive' => [
                'label' => 'Upload photo archive',
                'rules' => 'max 200 mb'
            ],
            'preview' => [
                'label' => 'Upload preview',
                'rules' => 'max 10 mb'
            ],
        ],
    ]
];
