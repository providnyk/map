<?php

namespace Modules\Report\Database;

use App\Model;

class Report extends Model
{
	protected $connection = 'pr';
	protected $fillable = [
		'issue_id',
		'point_id',
		'user_id',
		'published',
	];
	protected $a_form = [
		'point_id'		=> [
			'tab'		=> 'data',
			'field'		=> 'select',
			'rules'		=> '',
		],
		'issue_id'		=> [
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
	public function issue()
	{
		return $this->belongsTo('Modules\Issue\Database\Issue');
	}
	public function point()
	{
		return $this->belongsTo('App\Point');
	}
}
