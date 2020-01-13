<?php

namespace Modules\Home\Database;

use App\Model;

class HomeTranslation extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'title',
		'description',
	];

	public $a_form = [
		'title'			=> [
			'tab'		=> 'data',
			'field'		=> 'input',
			'rules'		=> '',
		],
		'description'	=> [
			'tab'		=> 'data',
			'field'		=> 'input',
			'rules'		=> '',
		],
	];
}
