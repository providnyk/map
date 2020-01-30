<?php

namespace Modules\Style\Database;

use App\Model;

class Style extends Model
{
	protected $connection = 'psc';
	protected $fillable = [
		'element_id',
		'published',
	];
	public $translatedAttributes = [];
	protected $a_form = [
		'published'		=> [
			'tab'		=> 'data',
			'field'		=> 'checkbox',
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
