<?php


namespace App\Filters;

use DB;
use App\Filters\Filters;
use Illuminate\Http\Request;

class FiltersAPI extends Filters
{
	protected $filters = [
		'id',
		'title',
		'created_at',
		'updated_at',
	];

	protected function title($title)
	{
		return $this->builder->whereTranslationLike('title', '%' . $title . '%', $this->appLocale);
	}

	protected function getQuery()
	{
		return $this->builder->select(
				'issues.*',
				'issue_translations.title as title'
			)
			->offset($this->request->start)
			->limit($this->limit)
			->leftJoin('issue_translations', function($query) {
				$query->on('issue_translations.issue_id', '=', 'issues.id')
					->where('locale', '=', $this->appLocale);
			})
			->orderBy($this->orderColumn, $this->orderDirection);
	}
}
