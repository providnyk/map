<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignTranslation extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'name',
		'description',
	];
}
