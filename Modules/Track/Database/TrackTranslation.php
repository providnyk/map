<?php

namespace Modules\Track\Database;

use App\Model;
#use Illuminate\Database\Eloquent\Model;

class TrackTranslation extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'title',
		'from_address',
		'to_address',
	];

	public $a_form = [
		'title'			=> [
			'tab'		=> 'data',
			'field'		=> 'input',
			'rules'		=> 'required|string|max:191',
		],
		'from_address'	=> [
			'tab'		=> 'data',
			'field'		=> 'input',
			'rules'		=> 'required|string|max:191',
		],
		'to_address'	=> [
			'tab'		=> 'data',
			'field'		=> 'input',
			'rules'		=> 'required|string|max:191',
		],
	];
}
