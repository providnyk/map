<?php

namespace App;

use App\Model;

class Point extends Model
{
	protected $connection = 'pr';
	protected $fillable = [
		'building_id',
		'design_id',
		'group_id',
		'ownership_id',
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
	public function groups()
	{
		return $this->belongsToMany('App\Group');
	}
	public function ownerships()
	{
		return $this->belongsTo('App\Ownership');
	}
}
