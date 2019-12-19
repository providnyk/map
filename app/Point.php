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
		'user_id',
		'target_id',
		'published',
		'lat',
		'lng',
	];
	public function buildings()
	{
		return $this->belongsTo('App\Building');
	}
	public function designs()
	{
		return $this->belongsTo('App\Design');
	}
	public function issues()
	{
		return $this->belongsToMany('Modules\Issue\Object\Issue');
	}
	public function targets()
	{
		return $this->belongsToMany('App\Target');
	}
	public function ownerships()
	{
		return $this->belongsTo('App\Ownership');
	}
	public function users()
	{
		return $this->belongsTo('App\User');
	}
}
