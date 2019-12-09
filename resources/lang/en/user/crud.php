<?php

return [
	'tab' => [
		'data' => [
			'name' => 'Data',
			'info'	=> 'General info',
		],
		'manage' => [
			'name' => 'Manage',
			'info'	=> 'Item Management',
		],
	],
	'list' => [
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
	'filter' => [
		'label' => 'Filter by',
		'title' => 'title',
		'created_at' => 'created date',
		'updated_at' => 'updated date',
	],
	'table' => [
		'created_at' => 'Created',
		'updated_at' => 'Updated',
		'actions' => 'Actions',
		'enabled' => 'Yes',
		'disabled' => 'No',
	],
	'hint' => [
		'input' => 'Enter',
		'checkbox' => 'Toggle',
		'enabled' => 'On',
		'disabled' => 'Off',
		'select' => 'Choose a',
	],
	'field' => [
		'id' => [
			'label' => 'ID',
			'rules' => 'required',
		],
		'title' => [
			'label' => 'Title',
			'rules' => 'max 191 chars',
		],
		'description' => [
			'label' => 'Description',
			'rules' => 'max 191 chars',
		],
		'published' => [
			'label' => 'Published',
			'rules' => 'yes or no',
		],
		'timezone' => [
			'label' => 'Select timezone',
			'rules' => 'required | one from list',
		],
	],
	'button' => [
		'submit' => [
			'label' => 'Submit',
			'key' => 'ctrl+S',
		]
	],
];