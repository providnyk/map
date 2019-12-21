<?php

namespace Modules\Report\Database;

use App\Model;

class Report extends Model
{
	protected $connection = 'pr';
	protected $fillable = [
		'point_id',
		'published',
	];
	protected $a_form = [
		'point_id'		=> [
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
	public function points()
	{
		return $this->belongsTo('App\Point');
	}
}
