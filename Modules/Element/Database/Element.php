<?php

namespace Modules\Element\Database;

use App\Model;

class Element extends Model
{
	protected $connection = 'psc';
	protected $fillable = [
		'building_id',
		'published',
	];
	public $translatedAttributes = [];
	protected $a_form = [
		'published'		=> [
			'tab'		=> 'data',
			'field'		=> 'checkbox',
			'rules'		=> '',
		],
		'building_ids'		=> [
			'tab'		=> 'data',
			'field'		=> 'select',
			'rules'		=> '',
		],
	];

	public function building()
	{
		return $this->belongsToMany('App\Building');
	}
}
