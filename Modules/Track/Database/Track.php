<?php

namespace Modules\Track\Database;

use                                      App\Model;

class Track extends Model
{
	protected $connection = 'psc';
	protected $fillable = [
		'user_id',
		'travel_mode',
		'from_lat',
		'from_lng',
		'to_lat',
		'to_lng',
		'request_raw',
		'response_raw',
		'response_status',
		'route_qty',
		'route_selected',
		'length',
		'time',
		'published',
	];
	protected $casts = [
		'api_request'	=> 'object',
		'api_response'	=> 'object',
	];
	public $translatedAttributes = [];
	protected $a_form = [
		'published'		=> [
			'tab'		=> 'data',
			'field'		=> 'checkbox',
			'rules'		=> 'boolean',
			'default'	=>	TRUE,
		],
		'from_lat'		=> [
			'tab'		=> 'data',
			'field'		=> 'input',
			'rules'		=> 'numeric|between:-85.05112878,85.05112878', #regex:/^[+-]?\d+\.\d+$/
		],
		'from_lng'		=> [
			'tab'		=> 'data',
			'field'		=> 'input',
			'rules'		=> 'numeric|between:-999.9999999,999.9999999', #regex:/^-?\d{1,2}\.\d{6,}$/
		],
		'to_lat'		=> [
			'tab'		=> 'data',
			'field'		=> 'input',
			'rules'		=> 'numeric|between:-85.05112878,85.05112878', #regex:/^[+-]?\d+\.\d+$/
		],
		'to_lng'		=> [
			'tab'		=> 'data',
			'field'		=> 'input',
			'rules'		=> 'numeric|between:-999.9999999,999.9999999', #regex:/^-?\d{1,2}\.\d{6,}$/
		],
	];

	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
