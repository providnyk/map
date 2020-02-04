<?php

namespace Modules\Opinion\API;

use             Modules\Opinion\Database\Opinion as Model;
use                 Modules\Building\API\Building;
use                  Modules\Element\API\Element;
use                    Modules\Place\API\Place;
use                    Modules\Style\API\Style;

class Opinion extends Model
{
	public $translationModel = '\Modules\Opinion\Database\OpinionTranslation';

	/**
	 * Get list of issues specific to this point
	 * @param Request	$request		Data from request
	 * @param Integer	$id				point id
	 *
	 * @return Response	json instance of data for select2 expected format
	 */
	public static function getSpecificLists($request, $id) : String
	{
		$i_building_id			= Place::findOrFail($id)->building_id;
		$i_style_id				= Building::findOrFail($i_building_id)->style_id;
		$a_element_ids			= Style::findOrFail($i_style_id)->element()->get()->pluck('id')->toArray();

		$a_elements				= self::getIdTitle($request, 'Element', NULL, $a_element_ids, TRUE, FALSE, TRUE);

/*
		$a_elements				= Element::whereIn('id', $a_element_ids);
#		$a_issue_ids = Design::findOrFail($i_design_id)->issue()->get()->pluck('id')->toArray();
#		$a_issues = Issue::whereIn('id', $a_issue_ids);

		if (!is_null($request->search))
			 $a_elements = $a_elements->whereTranslationLike('title', '%' . $request->search .'%', app()->getLocale());

		$a_elements = $a_elements->get()->map( function($o_element) {
			return ['id'=> $o_element->id, 'title' => $o_element->title];
		});
#dd($request, $id, $i_building_id, $i_style_id, $a_element_ids, $a_elements);
*/
		return json_encode(['results' => $a_elements]);
	}

}
