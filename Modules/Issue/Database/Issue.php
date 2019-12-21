<?php

namespace Modules\Issue\Database;

use App\Model;

class Issue extends Model
{
	protected $connection = 'pr';
	protected $fillable = [
		'design_id',
		'published',
	];
	protected $a_form = [
		'design_ids'		=> [
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
	public function designs()
	{
		return $this->belongsToMany('App\Design');
	}
}
