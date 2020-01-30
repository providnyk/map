<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseRequest;

class Request extends BaseRequest
{
	protected $_env = [];

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 * Add rules per language locale
	 * and multiply translatable rules
	 *
	 * @return array
	 */
	public function rulesLng(Array $a_rules) : Array
	{
		$s_basename					= class_basename(__CLASS__);
		$this->_env					= (object) [];
		$s_tmp						= get_called_class();
		$a_tmp						= explode('\\', $s_tmp);
		$this->_env->s_name			= str_replace($s_basename, '', $a_tmp[3]);

		if ($a_tmp[0] == 'Modules')
		{
			$this->_env->s_name		= $a_tmp[1];
			$this->_env->s_model	= '\Modules\\' . $this->_env->s_name . '\\' . $a_tmp[2] . '\\' . $this->_env->s_name ;
			$this->_env->s_trans	= '\Modules\\' . $this->_env->s_name . '\\' . 'Database' . '\\' . $this->_env->s_name ;
		}
		else
		{
			$this->_env->s_name		= str_replace($s_basename, '', $a_tmp[3]);
			$this->_env->s_model	= '\App\\'.$this->_env->s_name;
			$this->_env->s_trans	= $this->_env->s_model ;
		}

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
#			$a_form_main			= $m->a_form;
		}
		$s_tmp						= $this->_env->s_trans.'Translation';
		if (class_exists($s_tmp))
		{
			$t						= new $s_tmp;
			$a_fill_trans			= $t->getFillable();
			$a_form_trans			= $t->getFields();
#			$a_form_trans			= $t->a_form;
		}

		$a_rules_all = [];
		$a_locales = config('translatable.locales');

		for ($i = 0; $i < count($a_locales); $i++)
		{
			$a_rules_all[$a_locales[$i]] = 'required|array';
			for ($j = 0; $j < count($a_fill_trans); $j++)
			{
				if (array_key_exists($a_fill_trans[$j], $a_form_trans))
				{
					$s_tmp = $a_locales[$i].'.'.$a_fill_trans[$j];
					$a_rules_all[$s_tmp] = $a_form_trans[$a_fill_trans[$j]]['rules'];
				}
			}
		}

		foreach ($a_form_main as $s_name => $a_data) {
			$a_rules_all[$s_name] = $a_data['rules'];
		}
/*
		for ($i = 0; $i < count($a_locales); $i++)
		{
			$a_rules_all[$a_locales[$i]] = 'required|array';
			for ($j = 0; $j < count($a_fill_trans); $j++)
			{
				if (array_key_exists($a_fill_trans[$j], $a_rules))
				{
					$s_tmp = $a_locales[$i].'.'.$a_fill_trans[$j];
					$a_rules_all[$s_tmp] = $a_rules[$a_form_trans[$j]];
				}
			}
		}

		for ($j = 0; $j < count($a_form_main); $j++)
		{
			if (array_key_exists($a_form_main[$j], $a_form_trans))
			{
				$s_tmp = $a_locales[$i].'.'.$a_form_main[$j];
				$a_rules_all[$s_tmp] = $a_rules[$a_form_main[$j]];
			}
		}

		foreach ($a_rules AS $s_name => $s_rule)
		{
			if (!in_array($s_name, $a_fill_trans))
				$a_rules_all[$s_name] = $s_rule;
		}
*/
		return $a_rules_all;
	}
}
