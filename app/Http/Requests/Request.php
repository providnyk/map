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
		$this->_env = (object) [];
		$a_tmp = explode('\\', get_called_class());
		$this->_env->s_name = str_replace('Request', '', $a_tmp[3]);
		$this->_env->s_model = '\\App\\'.$this->_env->s_name;
		$m = new $this->_env->s_model;
		$s_tmp = $this->_env->s_model.'Translation';
		$t = new $s_tmp;
		$a_trans = $t->getFillable();

		$a_rules_all = [];
		$a_locales = config('translatable.locales');
		for ($i = 0; $i < count($a_locales); $i++)
		{
			$a_rules_all[$a_locales[$i]] = 'required|array';
			for ($j = 0; $j < count($a_trans); $j++)
			{
				if (array_key_exists($a_trans[$j], $a_rules))
				{
					$s_tmp = $a_locales[$i].'.'.$a_trans[$j];
					$a_rules_all[$s_tmp] = $a_rules[$a_trans[$j]];
				}
			}
		}
		foreach ($a_rules AS $s_name => $s_rule)
		{
			if (!in_array($s_name, $a_trans))
				$a_rules_all[$s_name] = $s_rule;
		}
		return $a_rules_all;
	}
}
