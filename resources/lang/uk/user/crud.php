<?php

return [
	'tab' => [
		'data' => [
			'name'		=> 'Дані',
			'info'		=> 'Загальна інформація',
		],
		'manage' => [
			'name'		=> 'Керування',
			'info'		=> 'Управління записом',
		],
	],
	'filter' => [
		'label'			=> 'Фільтрувати за',
		'title'			=> 'Назвою',
		'created_at'	=> 'датою створення',
		'updated_at'	=> 'датою оновлення',
		'perpage'		=> 'записів на сторінци',
	],
	'table' => [
		'created_at'	=> 'Створено',
		'updated_at'	=> 'Оновлено',
		'actions'		=> 'Дії',
		'published'		=> 'Опубліковано',
		'enabled'		=> 'Так',
		'disabled'		=> 'Ні',
	],
	'hint' => [
		'input'			=> 'Введіть',
		'checkbox'		=> 'Перемкніть',
		'enabled'		=> 'Увімкн.',
		'disabled'		=> 'Вимкн.',
		'select'		=> 'Виберіть',
	],
	'field' => [
		'id' => [
			'label'		=> 'ID',
			'rules'		=> 'required',
		],
		'title' => [
			'label'		=> 'Назва',
			'filterby'	=> 'назвою',
			'typein'	=> 'назву',
			'rules'		=> 'max 191 chars',
		],
		'description' => [
			'label'		=> 'Опис',
			'filterby'	=> 'описом',
			'typein'	=> 'опис',
			'rules'		=> 'max 191 chars',
		],
		'published' => [
			'label'		=> 'Опублікувати',
			'filterby'	=> 'опублікуванні',
			'typein'	=> 'опублікуванне',
			'rules'		=> 'yes or no',
		],
		'timezone' => [
			'label'		=> 'Виберіть часовий пояс',
			'rules'		=> 'required | one from list',
		],
	],
	'button' => [
		'add' => [
			'label'		=> 'Додати',
			'key'		=> 'ctrl+A',
		],
		'apply' => [
			'label'		=> 'Шукати (Застосувати фільтри)',
			'key'		=> 'ctrl+S',
		],
		'delete' => [
			'label'		=> 'Видалити вибране',
			'key'		=> 'ctrl+D',
		],
		'edit' => [
			'label'		=> 'Редагувати',
			'key'		=> '',
		],
		'reset' => [
			'label'		=> 'Скинути фільтри',
			'key'		=> 'ctrl+B',
		],
		'submit' => [
			'label'		=> 'Зберегти',
			'key'		=> 'ctrl+S',
		],
	],
];