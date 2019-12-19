<?php

namespace Modules\Issue\Object;

use App\Model;

class Issue_2 extends Model
{
	protected $connection = 'pr';
	protected $fillable = [
		'published',
	];
	public function points()
	{
		return $this->hasMany('App\Point');
	}
}
