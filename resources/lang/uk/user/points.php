<?php

return [
    'names' =>
    [
        'sgl'   => 'Точка',
        'plr'   => 'Точки',
		'list'	=> 'точок',
		'form'	=> 'точки',
		'saved'	=> 'точку',
        'ico'	=> 'icon-location3',
    ],
	'field' => [
		'lat' => [
			'label' => 'Широта',
			'rules'	=> 'numeric | regex:/^[+-]?\d+\.\d+$/',
		],
		'lng' => [
			'label' => 'Довгота',
			'rules'	=> 'numeric | regex:/^-?\d{1,2}\.\d{6,}$/',
		],
		'title' => [
			#'label' => '', #is taken from general "crud" fields description
			'rules'	=> 'required | max 191 chars',
		],
		'design_id' => [
			#'label' => '', #is taken from "designs" name sgl
			'rules'	=> 'required | one from list',
		],
		'address' => [
			'label' => 'Адреса',
			'rules'	=> 'max 191 chars',
		],
		'annotation' => [
			'label' => 'Анотація',
			'rules'	=> 'nullable|max 191 chars',
		],
		'description' => [
			#'label' => '', #is taken from general "crud" fields description
			'rules'	=> 'max 191 chars', #override for general "crud" rules
		],
	],
];