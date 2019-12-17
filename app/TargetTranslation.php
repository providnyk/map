<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TargetTranslation extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'title',
	];
}
