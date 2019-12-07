<?php

namespace App;

use App\Traits\GeneralTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
#use App\DesignTranslation;

class Design extends Model
{
	use GeneralTrait;
	use Translatable;

	protected $connection = 'pr';
	protected $fillable = [
		'enabled',
	];
	public $translatedAttributes = [];
#    protected static function boot()
/*
	public function __construct()
#	public function store()
	{
		dump($this->translatedAttributes);
		$m = new DesignTranslation;
#		$this->translatedAttributes = $m->getFillable();
	    $this->translatedAttributes = array_merge($this->translatedAttributes, $m->getFillable());
		dump($this->translatedAttributes);
	}
*/
	public function scopeFilter($query, $filters)
	{
		return $filters->apply($query);
	}
}
