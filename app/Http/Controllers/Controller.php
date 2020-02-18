<?php

namespace App\Http\Controllers;

use    Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use            Illuminate\Foundation\Bus\DispatchesJobs;
use     Illuminate\Foundation\Validation\ValidatesRequests;
use                   Illuminate\Routing\Controller     as BaseController;
use                   Illuminate\Support\Pluralizer;

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
#dd($this->_env->s_model);
		$a_form_main				= [];
		$a_fill_main				= [];
		$a_form_trans				= [];
		$a_fill_trans				= [];

		$s_tmp						= $this->_env->s_model;
		if (class_exists($s_tmp))
		{
			$m						= new $s_tmp;
			$a_fill_main			= $m->getFillable();
			$a_form_main			= $m->getFields();
		}
		$s_tmp					= $this->_env->s_trans.'Translation';
		if (class_exists($s_tmp))
		{
			$t						= new $s_tmp;
			$a_fill_trans			= $t->getFillable();
			$a_form_trans			= $t->getFields();
		}

		$this->_env->s_sgl			= strtolower($this->_env->s_name);
		$this->_env->fn_find		= $this->_env->s_model.'::findOrNew';
		$this->_env->s_plr			= Pluralizer::plural($this->_env->s_sgl, 2);
		$this->_env->s_utype		= strtolower($a_tmp[2]);

		if ($a_tmp[0] == 'Modules')
			$this->_env->s_view		= $this->_env->s_sgl . '::' . $this->_env->s_utype . '.';
		else
			$this->_env->s_view		= 'admin.' . $this->_env->s_sgl . '.';

		////////////////////////////////////////////////////////////////////////////////////////////////////
		if ($this->_env->s_utype == 'controllers'
			&& in_array($this->_env->s_sgl, [
											'password',
											'profile',
											'signin',
											'signup',
											])
			)
		{
			$this->_env->s_utype	= 'guest';
			$this->_env->fn_find	= '';
			$this->_env->s_view		= (env('APP_THEME') . '::' ?: '') . $this->_env->s_utype . '.' ;
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////
/*
		////////////////////////////////////////////////////////////////////////////////////////////////////
		if ($this->_env->s_utype == 'controllers'
			&& in_array($this->_env->s_sgl, [
											'point',
											])
			)
		{
			$this->_env->s_utype	= request()->segment(1) == 'admin' ? 'user' : 'guest';
#			$this->_env->fn_find	= '';
#			$this->_env->s_view		= (env('APP_THEME') . '::' ?: '') . $this->_env->s_utype . '.' ;
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////
*/
		$a_tmp						= config('translatable.locales');
		$this->a_fields				= array_merge(config('translatable.locales'), $a_fill_main);

		$this->a_field				= [];
		$this->a_rule				= [];
		$this->a_tab				= [];#['All'];
#dd($a_fill_main, $a_form_main);
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
#dd($this->a_rule);
		$this->_env->a_field		= $this->a_field;
		$this->_env->a_rule			= $this->a_rule;
		$this->_env->a_tab			= array_values(array_unique($this->a_tab));
#dump($this->_env->a_field, $this->_env->a_rule);
		$_env						= $this->_env;

		\View::composer('*', function ($view) use ($_env) {
			$view->with([
				'_env'				=> $this->_env,
			]);
		});

	}
}