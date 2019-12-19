<?php

namespace Modules\Issue\Requests;

use App\Http\Requests\Request;

class IssueRequest_2 extends Request
{
	protected $_rules = [
		'published'			=> 'boolean',
		'title'				=> 'required|string|max:255',
	];

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
