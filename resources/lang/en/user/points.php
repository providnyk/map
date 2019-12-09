<?php

return [
    'names' =>
    [
        'sgl'   => 'Point',
        'plr'   => 'Points',
        'ico'	=> 'icon-location3',
    ],
	'field' => [
		'lat' => [
			'label' => 'Latitude',
			'rules'	=> 'numeric | regex:/^[+-]?\d+\.\d+$/',
		],
		'lng' => [
			'label' => 'Longtitude',
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
			'label' => 'Address',
			'rules'	=> 'max 191 chars',
		],
		'annotation' => [
			'label' => 'Annotation',
			'rules'	=> 'nullable|max 191 chars',
		],
		'description' => [
			#'label' => '', #is taken from general "crud" fields description
			'rules'	=> 'max 191 chars', #override for general "crud" rules
		],
	],
];