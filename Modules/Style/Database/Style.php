<?php

namespace Modules\Style\Database;

use App\Model;

class Style extends Model
{
	protected $connection = 'psc';
	protected $fillable = [
		'published',
	];
	public $translatedAttributes = [];
	protected $a_form = [
		'published'		=> [
			'tab'		=> 'data',
			'field'		=> 'checkbox',
			'rules'		=> '',
		],
	];
}
