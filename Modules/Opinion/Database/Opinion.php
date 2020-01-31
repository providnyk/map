<?php

namespace Modules\Opinion\Database;

use App\Model;

class Opinion extends Model
{
	protected $connection = 'psc';
	protected $fillable = [
		'element_id',
		'mark_id',
		'place_id',
		'user_id',
		'published',
	];
	public $translatedAttributes = [];
	protected $a_form = [
		'place_id'		=> [
			'tab'		=> 'data',
			'field'		=> 'select',
			'rules'		=> '',
		],
		'element_id'		=> [
			'tab'		=> 'data',
			'field'		=> 'select',
			'rules'		=> '',
		],
		'mark_id'		=> [
			'tab'		=> 'data',
			'field'		=> 'select',
			'rules'		=> '',
		],
		'published'		=> [
			'tab'		=> 'manage',
			'field'		=> 'checkbox',
			'rules'		=> '',
		],
	];

	public function element()
	{
		return $this->belongsTo('Modules\Element\Database\Element');
	}
	public function mark()
	{
		return $this->belongsTo('Modules\Mark\Database\Mark');
	}
	public function place()
	{
		return $this->belongsTo('Modules\Place\Database\Place');
	}
	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
