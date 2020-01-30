<?php

namespace Modules\Building\Database;

use App\Model;

class Building extends Model
{
	protected $connection = 'psc';
	protected $fillable = [
		'element_id',
		'style_id',
		'published',
	];
	public $translatedAttributes = [];
	protected $a_form = [
		'published'		=> [
			'tab'		=> 'data',
			'field'		=> 'checkbox',
			'rules'		=> '',
		],
		'style_id'		=> [
			'tab'		=> 'data',
			'field'		=> 'select',
			'rules'		=> '',
		],
		'element_ids'		=> [
			'tab'		=> 'data',
			'field'		=> 'select',
			'rules'		=> '',
		],
	];

	public function element()
	{
		return $this->belongsToMany('Modules\Element\Database\Element');
	}
}
