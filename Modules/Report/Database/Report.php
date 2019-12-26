<?php

namespace Modules\Report\Database;

use App\Model;
use App\Traits\Imagable;

class Report extends Model
{
	use Imagable;

	protected $connection = 'pr';
	protected $fillable = [
		'gallery_id',
		'issue_id',
		'point_id',
		'user_id',
		'published',
	];
	protected $a_form = [
		'point_id'		=> [
			'tab'		=> 'data',
			'field'		=> 'select',
			'rules'		=> '',
		],
		'issue_id'		=> [
			'tab'		=> 'data',
			'field'		=> 'select',
			'rules'		=> '',
		],
		'gallery_id'	=> [
			'tab'		=> 'data',
			'field'		=> 'select',
			'rules'		=> '',
		],
		'published'		=> [
			'tab'		=> 'manage',
			'field'		=> 'checkbox',
			'rules'		=> '',
		],
	];

	protected static function boot()
	{
		parent::boot();

		static::deleted(function($model) {
			if($model->images)
				File::destroy($model->images->pluck('id')->toArray());
		});
	}

	public function image()
	{
		return $this->morphMany('App\File', 'filable');
	}
	public function issue()
	{
		return $this->belongsTo('Modules\Issue\Database\Issue');
	}
	public function point()
	{
		return $this->belongsTo('App\Point');
	}
}
