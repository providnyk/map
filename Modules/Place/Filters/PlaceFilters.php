<?php

#namespace App\Filters;
namespace Modules\Place\Filters;

#use DB;
use App\Filters\FiltersAPI;
#use Illuminate\Http\Request;

class PlaceFilters extends FiltersAPI
{

	protected function building($ids)
	{
		return $this->builder->whereIn('building_id', $ids);
	}


/*
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
				'places.*',
				'place_translations.title as title'
			)
			->offset($this->request->start)
			->limit($this->limit)
			->leftJoin('place_translations', function($query) {
				$query->on('place_translations.place_id', '=', 'places.id')
					->where('locale', '=', $this->appLocale);
			})
			->orderBy($this->orderColumn, $this->orderDirection);
	}*/
}
