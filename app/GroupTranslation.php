<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupTranslation extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'title',
	];
}
