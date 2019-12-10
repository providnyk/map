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
	'filter' => [
		'label' => 'Filter by',
		'title' => 'Title',
		'created_at' => 'created date',
		'updated_at' => 'updated date',
		'perpage' => 'Entries per page',
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
			'label'		=> 'Title',
			'filterby'	=> 'Title',
			'typein'	=> 'Title',
			'rules'		=> 'max 191 chars',
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
		'add' => [
			'label' => 'Add new',
			'key' => 'ctrl+A',
		],
		'apply' => [
			'label' => 'Search (Apply filter)',
			'key' => 'ctrl+S',
		],
		'delete' => [
			'label' => 'Delete selected',
			'key' => 'ctrl+D',
		],
		'edit' => [
			'label' => 'Edit this',
			'key' => '',
		],
		'reset' => [
			'label' => 'Blank (Reset) filters',
			'key' => 'ctrl+B',
		],
		'submit' => [
			'label' => 'Submit',
			'key' => 'ctrl+S',
		],
	],
];