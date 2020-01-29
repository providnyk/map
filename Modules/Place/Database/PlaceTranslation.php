<?php

namespace Modules\Place\Database;

use App\Model;
#use Illuminate\Database\Eloquent\Model;

class PlaceTranslation extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'title',
		'address',
		'annotation',
	];

	public $a_form = [
		'title'			=> [
			'tab'		=> 'data',
			'field'		=> 'input',
			'rules'		=> '',
		],
		'address'	=> [
			'tab'		=> 'data',
			'field'		=> 'input',
			'rules'		=> '',
		],
		'annotation'	=> [
			'tab'		=> 'data',
			'field'		=> 'input',
			'rules'		=> '',
		],
	];
}
