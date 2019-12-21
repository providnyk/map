<?php

namespace App;

use App\Model;

class Point extends Model
{
	protected $connection = 'pr';
	protected $fillable = [
		'building_id',
		'design_id',
		'ownership_id',
		'report_id',
		'user_id',
		'target_id',
		'published',
		'lat',
		'lng',
	];
	protected $a_form = [
		'building_id'	=> [
			'tab'		=> 'data',
			'field'		=> 'select',
			'rules'		=> '',
		],
		'design_id'		=> [
			'tab'		=> 'data',
			'field'		=> 'select',
			'rules'		=> '',
		],
		'ownership_id'	=> [
			'tab'		=> 'data',
			'field'		=> 'select',
			'rules'		=> '',
		],
		'target_ids'	=> [
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
	public function buildings()
	{
		return $this->belongsTo('App\Building');
	}
	public function designs()
	{
		return $this->belongsTo('App\Design');
	}
	public function targets()
	{
		return $this->belongsToMany('App\Target');
	}
	public function ownerships()
	{
		return $this->belongsTo('App\Ownership');
	}
	public function reports()
	{
		return $this->belongsToMany('App\Report');
	}
	public function users()
	{
		return $this->belongsTo('App\User');
	}
}
