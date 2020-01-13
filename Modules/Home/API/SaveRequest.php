<?php

namespace Modules\Home\API;

use Modules\Home\Http\HomeRequest as BaseRequest;

class SaveRequest extends BaseRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $this->rulesLng($this->_rules);
	}
}
