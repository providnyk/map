<?php

namespace Modules\Building\Database;

use App\Model;
#use Illuminate\Database\Eloquent\Model;

class BuildingTranslation extends Model
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
