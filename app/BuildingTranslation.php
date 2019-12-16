<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingTranslation extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'title',
	];
}
