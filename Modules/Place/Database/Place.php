<?php

namespace Modules\Place\Database;

use App\Model;

class Place extends Model
{
	protected $connection = 'psc';
	protected $fillable = [
		'building_id',
		'user_id',
		'lat',
		'lng',
		'published',
	];
	public $translatedAttributes = [];
	protected $a_form = [
		'published'		=> [
			'tab'		=> 'data',
			'field'		=> 'checkbox',
			'rules'		=> '',
		],
		'building_id'		=> [
			'tab'		=> 'data',
			'field'		=> 'select',
			'rules'		=> '',
		],
	];

	public function building()
	{
		return $this->belongsTo('Modules\Building\Database\Building');
	}
	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
