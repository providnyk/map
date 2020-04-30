<?php

namespace Modules\Complaint\Database;

use                                      App\Model;

class Complaint extends Model
{
	protected $connection = 'psc';
	protected $fillable = [
		'building_id',
		'user_id',
		'lat',
		'lng',
		'published',
	];
	public $translatedAttributes = [];
	protected $a_form = [
		'published'		=> [
			'tab'		=> 'data',
			'field'		=> 'checkbox',
			'rules'		=> 'boolean',
			'default'	=>	TRUE,
		],
		'building_id'		=> [
			'tab'		=> 'data',
			'field'		=> 'select',
			'rules'		=> 'required|integer',
		],
		'lat'		=> [
			'tab'		=> 'data',
			'field'		=> 'input',
			'rules'		=> 'numeric|between:-85.05112878,85.05112878', #regex:/^[+-]?\d+\.\d+$/
		],
		'lng'		=> [
			'tab'		=> 'data',
			'field'		=> 'input',
			'rules'		=> 'numeric|between:-999.9999999,999.9999999', #regex:/^-?\d{1,2}\.\d{6,}$/
		],
	];

    public function opinion()
    {
        return $this->HasMany('Modules\Opinion\Database\Opinion');
    }
    public function vote()
    {
        return $this->HasMany('Modules\Opinion\Database\OpinionVote');
    }

	public function building()
	{
		return $this->belongsTo('Modules\Building\Database\Building');
	}
	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
