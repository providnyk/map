<?php

namespace Modules\Issue\Database;

use App\Model;

class Issue extends Model
{
	protected $connection = 'pr';
	protected $fillable = [
		'design_id',
		'published',
	];
	public $translatedAttributes = [];
	protected $a_form = [
		'design_ids'		=> [
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

#	public function __construct()
#	{
#		parent::__construct();
#		$this->setTrans();
#	}

	public function design()
	{
		return $this->belongsToMany('App\Design');
	}
	public function report()
	{
		return $this->belongsToMany('Modules\Report\Database\Report');
	}
}
