<?php

namespace App;

use App\Traits\GeneralTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
	use GeneralTrait;
	use Translatable;

	protected $connection = 'pr';
	protected $fillable = [
		'enabled',
	];

	public $translatedAttributes = [
		'name',
		'description',
	];

	public function scopeFilter($query, $filters)
	{
		return $filters->apply($query);
	}

}
