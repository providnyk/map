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
	public function __construct()
	{
		$s_basename					= class_basename(__CLASS__);
		$this->_env					= (object) [];
		$s_tmp						= get_called_class();
		$a_tmp						= explode('\\', $s_tmp);
#		$this->_env->s_name			= str_replace($s_basename, '', $a_tmp[3]);

		if ($a_tmp[0] == 'Modules')
		{
			$this->_env->s_name		= $a_tmp[1];
			$this->_env->s_model	= '\Modules\\' . $this->_env->s_name . '\\' . $a_tmp[2] . '\\' . $this->_env->s_name ;
			$this->_env->s_trans	= '\Modules\\' . $this->_env->s_name . '\\' . 'Database' . '\\' . $this->_env->s_name ;
		}
		else
		{
			$this->_env->s_name		= str_replace($s_basename, '', $a_tmp[4]);
			$this->_env->s_model	= '\App\\'.$this->_env->s_name;
			$this->_env->s_trans	= $this->_env->s_model ;
		}

#		$m							= new $this->_env->s_model;
		$s_tmp						= $this->_env->s_trans.'Translation';
		$t							= new $s_tmp;
		$a_trans					= $t->getFillable();
#		$a_form_main				= $m->getFields();
		$a_form_trans				= $t->getFields();

		$this->translatedAttributes = $a_trans;
	}
	public function designs()
	{
		return $this->belongsToMany('App\Design');
	}
	public function reports()
	{
		return $this->belongsToMany('App\Report');
	}
}
