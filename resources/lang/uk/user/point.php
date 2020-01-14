<?php

return [
	'names' =>
	[
		'sgl'			=> 'Точка',
		'plr'			=> 'Точки',
		'list'			=> 'точок',
		'btn_create'	=> 'точку',
		'btn_edit'		=> 'точку',
		'btn_delete'	=> 'точки',
		'txt_create'	=> 'точки',
		'txt_edit'		=> 'точки',
		'filterby'		=> 'точкою',
		'typein'		=> 'точку',
		'saved'			=> 'точку',
	],
	'field' => [
		'lat' => [
			'label'		=> 'Широта',
			'filterby'	=> 'широтою',
			'typein'	=> 'широту',
			'rules'		=> 'required | numeric | regex:/^[+-]?\d+\.\d+$/',
		],
		'lng' => [
			'label'		=> 'Довгота',
			'filterby'	=> 'довготою',
			'typein'	=> 'довготу',
			'rules'		=> 'required | numeric | regex:/^-?\d{1,2}\.\d{6,}$/',
		],
		'title' => [
			#'label' => '', #is taken from general "crud" fields description
			'rules'	=> 'required | max 191 chars',
		],
		'design_id' => [
			#'label' => '', #is taken from "designs" name sgl
			'rules'		=> 'required | one from list',
		],
		'address' => [
			'label'		=> 'Адреса',
			'filterby'	=> 'адресою',
			'typein'	=> 'адресу',
			'rules'		=> 'max 191 chars',
		],
		'annotation' => [
			'label'		=> 'Анотація',
			'filterby'	=> 'анотацією',
			'typein'	=> 'анотацію',
			'rules'		=> 'nullable|max 191 chars',
		],
		'description' => [
			#'label' => '', #is taken from general "crud" fields description
			'rules'	=> 'max 191 chars', #override for general "crud" rules
		],
	],
];