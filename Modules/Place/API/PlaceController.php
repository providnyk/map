<?php


#namespace App\Http\Controllers\API;
namespace Modules\Place\API;

#use App\Place;
use                        Modules\Place\API\Place;
use                   Modules\Place\Database\Place as DBPlace;

#use App\Filters\PlaceFilters;
use                    Modules\Place\Filters\PlaceFilters;

#use App\Http\Requests\PlaceRequest;
#use Modules\Place\Requests\PlaceRequest;

use                        App\Http\Requests\DeleteRequest;

use                     App\Http\Controllers\ControllerAPI as Controller;
use               Illuminate\Support\Facades\Mail;
use                   \Modules\Mark\Database\Mark;
use                \Modules\Element\Database\Element;
#use App\Http\Requests\PlaceApiRequest;
use                       Modules\Place\Http\PlaceRequest;
use                        Modules\Place\API\SaveRequest;

#use Modules\Place\Http\Controllers\PlaceController as Controller;

class PlaceController extends Controller
{
	/**
	 * Deleted selected item(s)
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function destroy(DeleteRequest $request) : \Illuminate\Http\Response
	{
		return $this->destroyAPI($request);
	}

	public function sendIt(Array $a_places, Bool $b_dry_run = NULL) : void
	{
		$s_date		= date("m/d/Y");
		$s_title	= $a_places['title'];
		$s_address	= $a_places['address'];
		$s_descr	= $a_places['description'];
		$a_issues	= implode(', ', $a_places['rating']['issues']);

		$a_from[0]	= [
						's_title'		=> 'ГРОМАДСЬКА ОРГАНІЗАЦІЯ «ДЕБАТИ ЗАРАДИ ЗМІН»',
						's_email'		=> 'debate4changes@gmail.com',
						's_phone'		=> '+38068 255 75 91',
						's_legal'		=> 'код: 40190259',
						's_subject'		=> 'Заява (звернення)',
						'a_position'	=> 'ПРЕЗИДЕНТА ГО «ДЕБАТИ ЗАРАДИ ЗМІН»',
						'a_position_who'=> 'Президент ГО «ДЕБАТИ ЗАРАДИ ЗМІН»',
						'a_name'		=> 'Крис Анни Сергіївни',
						'a_name_who'	=> 'Крис Анна Сергіївна',
						's_address'		=> 'м. Київ, вул. Інститутська, буд. 22/7, кв. 27, 01021',
						];
		$a_to[0]	= [

						's_title'		=> 'КИЇВСЬКА МІСЬКА ДЕРЖАВНА АДМІНІСТРАЦІЯ',
						's_address'		=> 'м. Київ, вул. Хрещатик, 36, 01044',
						'a_email'		=> ['bogachenko.pavel@gmail.com','anna.krys.od@gmail.com',],
#						'a_email'		=> ['zvernen@kmda.gov.ua','dsp@kmda.gov.ua',],
						];
		$a_to[1]	= [
						's_title'		=> 'МІНІСТЕРСТВО СОЦІАЛЬНОЇ ПОЛІТИКИ УКРАЇНИ',
						's_address'		=> 'м. Київ, вул. Еспланадна, 8/10, 01601',
						'a_email'		=> ['m.d@tut.by','max.dmitriev@activelex.com',],
#						'a_email'		=> ['info@mlsp.gov.ua','zvernennya@mlsp.gov.ua',],
						];
#
		$a_params	=
				[
					's_date'		=> $s_date,
					's_title'		=> $s_title,
					's_address'		=> $s_address,
					's_descr'		=> $s_descr,
					'a_issues'		=> $a_issues,
					'a_from'		=> $a_from,
					'a_to'			=> $a_to,
				];

		$a_recipients	= [];
		$a_recipients[]	= ['email' => config('services.mail.from'), 'name' => config('services.mail.name'),];

		for ($i = 0; $i < count($a_to); $i++)
		for ($j = 0; $j < count($a_to[$i]['a_email']); $j++)
			$a_recipients[] = [
						'email' => $a_to[$i]['a_email'][$j],
						'name' => $a_to[$i]['s_title'][$j],
					];

		$s_email_from	= $a_from[0]['s_email'];
		$s_name_from	= $a_from[0]['s_title'];
		$s_subj		 	= $a_from[0]['s_subject'];

		if ($b_dry_run ?? FALSE)
		{
			$a_recipients	= [0 => ['email' => config('services.mail.from'), 'name' => config('services.mail.name')]];
			$s_email_from	= config('services.mail.from');
			$s_name_from	= config('services.mail.name');
		}

		for ($i = 0; $i < count($a_recipients); $i++)
		{
			$s_email_to = $a_recipients[$i]['email'];
			$s_name_to = $a_recipients[$i]['name'];

			Mail::send
			(
				'emails.complaint',
				$a_params,
				function($message) use ($s_subj, $s_email_to, $s_name_to, $s_email_from, $s_name_from)
				{
					$message
						->from($s_email_from, $s_name_from)
						->to($s_email_to, $s_name_to)
						->subject($s_subj)
					;
				}
			);

		}
	}

	/**
	 * Prepare data for listing all of items
	 * @param Request	$request		Data from request
	 * @param Filters	$filters		Whatever filters applied
	 *
	 * @return Response	json instance of
	 */
#	public function index(PlaceApiRequest $request, PlaceFilters $filters) : \Illuminate\Http\Response
	public function index(PlaceRequest $request, PlaceFilters $filters) : \Illuminate\Http\Response
	{
		$b_dev		= (config('app.env') == 'local');

		$b_test		= 1;#0 && $b_dev;

		$o_res		= $this->indexAPI($request, $filters, ['opinion', 'vote']);
		$a_marks	= Mark::wherePublished(1)->where('qty', '>', '0')->get()->pluck('qty', 'id')->toArray();
		$i_mark_max = max($a_marks);
		$i_mark_min = min($a_marks);

		$a_elements	= Element::get()->pluck('title', 'id')->toArray();
		$a_content = json_decode($o_res->getContent(), TRUE);
		for ($i = 0; $i < count($a_content['data']); $i++)
		{
			$a_places = $a_content['data'][$i];
			if (isset($a_places['opinion'][0]))
				$a_places['latest_opinion'] = $a_places['opinion'][0]['title'];
			$a_rating = [];
			$a_rating = self::_sumAllVotes($a_places['vote'], $a_marks);
			$a_rating = self::_setAverageTotal($a_rating, $a_elements, $i_mark_max, $i_mark_min);
			$a_places['rating'] = $a_rating;

			unset($a_places['opinion']);
			unset($a_places['vote']);
			$a_content['data'][$i] = $a_places;

			if ($b_test && isset($a_places['rating']['overall']['percent']) && $a_places['rating']['overall']['percent'] < 35)
			{
				self::sendIt($a_places, $b_dev);
				$b_test  = FALSE;
			}

		}
		$o_res->setContent(json_encode($a_content));
		return $o_res;
	}

	/**
	 * Unify marks description for all elements
	 *
	 * @param String	$s_format_set	Format describing placement of information
	 * @param Array		$a_format_val	values (aka marks) to be formatted
	 *
	 * @return Array					mark as key and qty as value
	 */
	private static function _setMarkDescription(String $s_format_set, Array $a_format_val) : String
	{
		return vsprintf($s_format_set, $a_format_val);
	}

	/**
	 * Go through all marks and calculate average points
	 * for each element and for the place in general
	 *
	 * @param Array		$a_rating		All votes organised per element and per place
	 * @param Array		$a_elements		All elements that can be voted for
	 * @param Integer	$i_mark_max		Maximum posible value for a single mark
	 *
	 * @return Array					mark as key and qty as value
	 */
	private static function _setAverageTotal(Array $a_rating, Array $a_elements, Int $i_mark_max, Int $i_mark_min) : Array
	{
		$a_res				= ['element' => [], 'overall' => [], 'issues' => [],];
		$i_overall_value	= 0;
		$i_overall_votes	= 0;
		$i_total_elements	= 0;
		foreach ($a_rating AS $i_element_id => $a_marks)
		{
			foreach ($a_marks AS $i_mark_value => $i_mark_qty)
			{
				$i_sum_value = 0;
				$i_sum_votes = 0;
#				if ($i_mark_value > $i_mark_min)
				{
				}
				$i_sum_value += $i_mark_value;
				$i_sum_votes += $i_mark_qty;
				if ($i_sum_votes > 0 && $i_mark_max > 0)
				{
					$i_tmp = $i_sum_value / $i_sum_votes;
					$i_percent = ($i_tmp-$i_mark_min) / ($i_mark_max-$i_mark_min) * 100;

					if ($i_percent < 35)
						$a_res['issues'][] = $a_elements[$i_element_id];

					$a_res['element'][] =
						[	'percent'		=> $i_percent,
							'description'	=> self::_setMarkDescription(
								trans('mark::crud.rating.element'),
								[
								$a_elements[$i_element_id],
								Place::formatNumber($i_tmp, 1),
								Place::formatNumber($i_sum_votes),
								]
							),
						]
							;
#					if ($i_tmp > $i_mark_min)
						$i_overall_value += $i_tmp;
					$i_total_elements++;
					if ($i_sum_votes > $i_overall_votes)
						$i_overall_votes = $i_sum_votes;
				}
			}
		}

		/**
		 * Total rating for the place
		 * is based on the rating of all elements' rating
		 */
		if ($i_overall_votes > 0 && $i_mark_max > 0)
		{
			$i_tmp = $i_overall_value / $i_total_elements;
			$i_overall = ($i_tmp-$i_mark_min) / ($i_mark_max-$i_mark_min) * 100;
#			$i_tmp = $i_mark_max * ($i_overall / 100);
			$a_res['overall']['percent'] = round($i_overall);
			$a_res['overall']['description'] = self::_setMarkDescription(
						trans('mark::crud.rating.overall'),
						[
						trans('mark::crud.rating.summary'),
						Place::formatNumber($i_overall),
						]
					);
			$a_res['overall']['details'] = self::_setMarkDescription(
						trans('mark::crud.rating.details'),
						[
						Place::formatNumber($i_tmp, 1),
						Place::formatNumber($i_mark_max),
						Place::formatNumber($i_overall_votes),
						]
					);
		}
		return $a_res;
	}

	/**
	 * Take each vote value (aka mark)
	 * calculate qty of each mark
	 * the same value marks that are considered as kind "the same" mark
	 * so they are summarized together
	 *
	 * @param Array		$a_votes		All votes casted for this place
	 * @param Array		$a_marks		Weight of each mark in points
	 *
	 * @return Array					mark as key and qty as value
	 */
	private static function _sumAllVotes($a_votes, $a_marks) : Array
	{
		$a_rating = [];
		for ($i = 0; $i < count($a_votes); $i++)
		{
			$a_vote			= $a_votes[$i];
			$i_mark_id		= $a_vote['mark_id'];
			$i_element_id	= $a_vote['element_id'];

			if (isset($a_marks[$i_mark_id]))
			{
				$i_mark_value	= $a_marks[$i_mark_id];
				if (!isset($a_rating[$i_element_id][$i_mark_value]))
					$a_rating[$i_element_id][$i_mark_value] = 0;

				$a_rating[$i_element_id][$i_mark_value]++;
			}
		}
		return $a_rating;
	}

	/**
	 * Create a new item
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function store(SaveRequest $request) : \Illuminate\Http\Response
	{
		$request->merge([
			'user_id' => \Auth::user()->id,
		]);
		$a_res = $this->storeAPI($request);
		return $a_res;
	}

	/**
	 * Updated item that is being edited
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function update(SaveRequest $request, DBPlace $item) : \Illuminate\Http\Response
	{
		$a_res = $this->updateAPI($request, $item);
		return $a_res;
	}
}
