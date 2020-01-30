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
		'description',
	];

	public $a_form = [
		'address'	=> [
			'tab'		=> 'data',
			'field'		=> 'input',
			'rules'		=> 'required|string|max:255',
		],
		'description'	=> [
			'tab'		=> 'data',
			'field'		=> 'input',
			'rules'		=> 'string|max:255',
		],
		'title'			=> [
			'tab'		=> 'data',
			'field'		=> 'input',
			'rules'		=> 'required|string|max:255',
		],
	];
}
