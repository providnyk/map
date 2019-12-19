<?php

namespace Modules\Issue\Requests;

use Modules\Issue\Requests\IssueRequest;

class IssueRequestAPI_2 extends IssueRequest
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
