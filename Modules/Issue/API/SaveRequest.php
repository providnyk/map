<?php

namespace Modules\Issue\API;

use Modules\Issue\Http\IssueRequest as BaseRequest;

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
