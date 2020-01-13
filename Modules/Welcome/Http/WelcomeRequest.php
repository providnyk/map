<?php

namespace Modules\Welcome\Http;

use App\Http\Requests\Request;

class WelcomeRequest extends Request
{
	protected $_rules = [
		'published'			=> 'boolean',
		'title'				=> 'string|max:255',
	];

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [];
	}
}
