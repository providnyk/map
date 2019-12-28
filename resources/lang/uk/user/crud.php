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
		'photo' => [
			'name'		=> 'Світлини',
			'info'		=> 'Фотографії об’єкта',
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
		'disabled'		=> 'Вимкн.',
		'enabled'		=> 'Увімкн.',
		'file'			=> 'Завантажіть',
		'image'			=> 'Завантажіть',
		'select'		=> 'Виберіть',
	],
	'field' => [
		'active' => [
			'label'		=> 'Дійсний',
			'filterby'	=> 'дійсністю',
			'typein'	=> 'дійсність',
			'rules'		=> 'yes or no',
		],
		'description' => [
			'label'		=> 'Опис',
			'filterby'	=> 'описом',
			'typein'	=> 'опис',
			'rules'		=> 'max 191 chars',
		],
		'email' => [
			'label'		=> 'Е-пошта',
			'filterby'	=> 'е-поштою',
			'typein'	=> 'е-пошту',
			'rules'		=> 'max 191 chars',
		],
		'first_name' => [
			'label'		=> 'Ім’я',
			'filterby'	=> 'ім’ем',
			'typein'	=> 'Ім’я',
			'rules'		=> 'max 191 chars',
		],
		'id' => [
			'label'		=> 'ID',
			'rules'		=> 'required',
		],
		'image' => [
			'label'		=> 'Зображення',
			'filterby'	=> 'зображенням',
			'typein'	=> 'зображенне',
			'rules'		=> '',
		],
		'last_name' => [
			'label'		=> 'Прізвище',
			'filterby'	=> 'прізвищем',
			'typein'	=> 'прізвище',
			'rules'		=> 'max 191 chars',
		],
		'title' => [
			'label'		=> 'Назва',
			'filterby'	=> 'назвою',
			'typein'	=> 'назву',
			'rules'		=> 'max 191 chars',
		],
		'published' => [
			'label'		=> 'Опублікувати',
			'filterby'	=> 'опублікуванні',
			'typein'	=> 'опублікуванне',
			'rules'		=> 'yes or no',
		],
		'role' => [
			'label'		=> 'Роль',
			'filterby'	=> 'роллю',
			'typein'	=> 'роль',
			'rules'		=> 'max 191 chars',
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
			'label'		=> 'Видалити вибраних',
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