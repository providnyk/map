<?php

namespace Modules\Opinion\Database;

use                                  App\Model;

class OpinionVote extends Model
{
	protected $connection = 'psc';
	protected $fillable = [
		'element_id',
		'mark_id',
		'opinion_id',
		'place_id',
		'user_id',

	];
	public $translatedAttributes = [];
	protected $a_form = [
		/*'place_id'		=> [
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
		],*/





	];

    public $timestamps = false;
/*
	public function element()
	{
		return $this->belongsToMany('Modules\Element\Database\Element');
	}
	public function mark()
	{
		return $this->belongsToMany('Modules\Mark\Database\Mark');
	}
	public function opinion()
	{
		return $this->belongsTo('Modules\Opinion\Database\Opinion');
	}
	public function place()
	{
		return $this->belongsTo('Modules\Place\Database\Place');
	}
	public function user()
	{
		return $this->belongsTo('App\User');
	}
*/




}
