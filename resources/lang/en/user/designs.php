<?php

return [
    'names' =>
    [
        'sgl'	=> 'Design',
        'plr'	=> 'Designs',
		'list'	=> 'of Designs',
		'create'=> 'a Design',
		'edit'	=> 'the Design',
		'saved'	=> 'the Design',
        'ico'	=> 'icon-design',
    ],
	'field' => [
		'title' => [
			#'label' => '', #is taken from general "crud" fields description
			'rules'	=> 'required | max 191 chars',
		],
	],
];