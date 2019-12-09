<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PointTranslation extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'title',
		'annotation',
		'description',
		'address',
	];
}
