<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Pluralizer;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	protected $_env = [];
	protected $a_fields = [];
	public function setEnv()
	{
		$s_basename					= class_basename(__CLASS__);
		$this->_env					= (object) [];
		$s_tmp						= get_called_class();
		$a_tmp						= explode('\\', $s_tmp);
		$this->_env->s_name			= str_replace($s_basename, '', $a_tmp[3]);

		if ($a_tmp[0] == 'Modules')
		{
			$this->_env->s_name		= $a_tmp[1];
#			$this->_env->s_model	= '\Modules\\' . $this->_env->s_name . '\\' . $a_tmp[2] . '\\' . $this->_env->s_name ;
			$this->_env->s_model	= '\Modules\\' . $this->_env->s_name . '\\' . 'Database' . '\\' . $this->_env->s_name ;

			$this->_env->s_trans	= '\Modules\\' . $this->_env->s_name . '\\' . 'Database' . '\\' . $this->_env->s_name ;
		}
		else
		{
			$this->_env->s_name		= str_replace($s_basename, '', $a_tmp[4]);
			$this->_env->s_model	= '\App\\'.$this->_env->s_name;
			$this->_env->s_trans	= $this->_env->s_model ;
		}

		$m							= new $this->_env->s_model;
		$s_tmp						= $this->_env->s_trans.'Translation';
		$t							= new $s_tmp;
		$a_trans					= $t->getFillable();
		$a_form_main				= $m->getFields();
		$a_form_trans				= $t->getFields();

		$this->_env->s_sgl			= strtolower($this->_env->s_name);
		$this->_env->fn_find		= $this->_env->s_model.'::findOrNew';
		$this->_env->fn_with		= $this->_env->s_model.'::with';
		$this->_env->s_plr			= Pluralizer::plural($this->_env->s_sgl, 2);

		if ($a_tmp[0] == 'Modules')
			$this->_env->s_view		= $this->_env->s_sgl . '::' . strtolower($a_tmp[2]) . '.';
		else
			$this->_env->s_view		= 'admin.' . $this->_env->s_sgl . '.';

		$a_tmp						= config('translatable.locales');
		$this->a_fields				= array_merge(config('translatable.locales'), $m->getFillable());

		$this->a_field				= [];
		$this->a_rule				= [];
		$this->a_tab				= [];#['All'];

		foreach ($a_form_main AS $s_name => $a_params)
		{
			$s_tab					= $a_params['tab'];
			$s_field				= $a_params['field'];
			$s_rules				= $a_params['rules'];
			$this->a_tab[]			= $s_tab;
#			$this->a_field['all'][$s_name]	= $s_field;
			$this->a_field[$s_tab][$s_name]	= $s_field;
			$this->a_rule[$s_name]	= $s_rules;
		}
		foreach ($a_form_trans AS $s_name => $a_params)
		{
			$s_tab					= $a_params['tab'];
			$s_field				= $a_params['field'];
			$s_rules				= $a_params['rules'];
			$this->a_tab[]			= $s_tab;
#			$this->a_field['all']['trans'][$s_name]		= $s_field;
			$this->a_field[$s_tab]['trans'][$s_name]	= $s_field;
			$this->a_rule[$s_name]	= $s_rules;
		}

		$this->_env->a_field		= $this->a_field;
		$this->_env->a_rule			= $this->a_rule;
		$this->_env->a_tab			= array_values(array_unique($this->a_tab));
#dump($this->_env->a_field, $this->_env->a_rule);
	}
}
