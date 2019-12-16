<?php

namespace App;

use App\Model;
#use App\DesignTranslation;

class Design extends Model
{

	protected $connection = 'pr';
	protected $fillable = [
		'ownership_id',
		'published',
	];
#	public $translatedAttributes = [];
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
	public function points()
	{
		return $this->hasMany('App\Point');
	}

	public function ownerships()
	{
		return $this->belongsTo('App\Ownership');
	}


/*
	public function scopeFilter($query, $filters)
	{
		return $filters->apply($query);
	}
*/
}
