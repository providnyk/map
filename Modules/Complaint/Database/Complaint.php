<?php

namespace Modules\Complaint\Database;

use               Illuminate\Support\Facades\Mail;
use                                      App\Model;
use                                          PDF;
use                  \Modules\Place\Database\Place;
use               Illuminate\Support\Facades\View;

class Complaint extends Model
{
	protected $connection = 'psc';
	protected $fillable = [
		'place_id',
		'email',
		'published',
	];
	public $translatedAttributes = [];
	protected $a_form = [
		'published'		=> [
			'tab'		=> 'data',
			'field'		=> 'checkbox',
			'rules'		=> 'boolean',
			'default'	=>	TRUE,
		],
		'place_id'		=> [
			'tab'		=> 'data',
			'field'		=> 'select',
			'rules'		=> 'required|integer',
		],
	];

    public function place()
    {
        return $this->BelongsTo('Modules\Place\Database\Place');
    }


	/**
	 * Send complaints by email and create a copy in power panel
	 * @param Object	$o_place		The place with accesibility issues
	 * @param String	$s_issues		List of issues for the place
	 * @param Boolean	$b_debug		whether send email for debugging or real life
	 * debug emails and PDF:
	 * login to the system
	 * go to URL http://provodnik.online/api/place/list?debug=1&id=1477&length=1
	 *
	 * @return void
	 */
	public static function sendIt(Object $o_place, String $s_issues, Bool $b_debug = FALSE) : void
	{
		$s_date		= date("d/m/Y");
		$s_title	= $o_place->title;
		$s_address	= $o_place->address;
		$s_descr	= $o_place->description;
		$s_tmpl_eml	= 'emails.complaint_emailtext';
		$s_tmpl_pdf	= 'emails.complaint_pdftext';
		$s_locale	= app()->getLocale();

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

		$a_cities['Kyiv']	= 'Киев|Київ|Kiev|Kyiv';
		$a_cities['Odesa']	= 'Одесса|Одеса|Odessa|Odesa';
		$s_city_target		= '';

		foreach ($a_cities AS $s_city_name => $s_regexps)
		{
			preg_match_all('/' . $s_regexps . '/iu', $o_place->address, $a_matches);
			if (count($a_matches[0]) > 0)
			{
				$s_city_target	= $s_city_name;
			}
		}

		$a_to[0]	= [
						's_title'		=> 'МІНІСТЕРСТВО СОЦІАЛЬНОЇ ПОЛІТИКИ УКРАЇНИ',
						's_address'		=> 'м. Київ, вул. Еспланадна, 8/10, 01601',
						'a_email'		=> ['info@mlsp.gov.ua','zvernennya@mlsp.gov.ua',],
						];

		switch ($s_city_target)
		{
			case 'Kyiv':
				$a_to[1]	= [

								's_title'		=> 'КИЇВСЬКА МІСЬКА ДЕРЖАВНА АДМІНІСТРАЦІЯ',
								's_address'		=> 'м. Київ, вул. Хрещатик, 36, 01044',
								'a_email'		=> ['zvernen@kmda.gov.ua', 'dsp@kmda.gov.ua', ],
								];
			break;
			case 'Odesa':
				$a_to[1]	= [

								's_title'		=> 'ОДЕСЬКА МІСЬКА РАДА',
								's_address'		=> 'м. Одеса, пл. Думська, 1, 65026',
								'a_email'		=> ['sovet@omr.gov.ua', 'dpsp@dpsp.omr.gov.ua', ],
								];
			break;
			default:
			break;
		}

		$s_subj		 	= $a_from[0]['s_subject'];
		$s_email_from	= config('mail.from.address');
		$s_name_from	= config('mail.from.name');
		$s_email_reply	= $a_from[0]['s_email'];
		$s_name_reply	= $a_from[0]['s_title'];

		if ($b_debug)
		{
			if (config('app.env') == 'production' || config('app.env') == 'acceptance')
			{
				$a_to[0]['a_email']			= [
												'anna.krys.od@gmail.com',
												'bogachenko.pavel@gmail.com',
												'max.dmitriev@activelex.com',
											];
				$a_to[1]['a_email']			= $a_to[0]['a_email'];
			}
			elseif (config('app.env') == 'local')
			{
				unset($a_to[0]);
				unset($a_to[1]);
			}
		}

		$s_info		= $s_address
						. ($s_address != $s_title ? ', ' . $s_title : '')
						. (!empty($s_descr) ? ', ' . $s_descr : '')
						;

		$a_params	=
				[
					's_date'		=> $s_date,
					's_title'		=> $s_title,
					's_info'		=> $s_info,
					's_address'		=> $s_address,
					's_descr'		=> $s_descr,
					's_issues'		=> $s_issues,
					'a_from'		=> $a_from,
					'a_to'			=> $a_to,
				];

		$o_view_eml		= View::make($s_tmpl_eml, $a_params);
		$o_view_pdf		= View::make($s_tmpl_pdf, $a_params);
		$s_contents_eml	= $o_view_eml->render(); #$contents = (string) $view;
		$s_contents_pdf	= $o_view_pdf->render();

		$a_recipients	= [];
		$a_recipients[]	= ['email' => config('services.mail.to'), 'name' => config('services.mail.me'),];
		$a_recipients[]	= ['email' => 'bogachenko.pavel@gmail.com', 'name' => 'Bogachenko Pavel',];

		for ($i = 0; $i < count($a_to); $i++)
		{
			$a_data								= [];
			$a_data['published']				= 1;
			$a_data['place_id']					= $o_place->id;
			$a_data['email']					= $a_to[$i]['a_email'][0];
			$a_data[$s_locale]['title']			= $a_to[$i]['s_title'];
			$a_data[$s_locale]['description']	= $s_contents_eml;
			$a_data[$s_locale]['address']		= $a_to[$i]['s_address'];

			for ($j = 0; $j < count($a_to[$i]['a_email']); $j++)
			{
				$a_recipients[] = [
							'email'		=> $a_to[$i]['a_email'][$j],
							'name'		=> $a_to[$i]['s_title'],
						];
			}

			self::create($a_data);
			if (!$b_debug)
			{
				$o_place->complaint_qty++;
			}
		}

		/**
		 *	https://github.com/niklasravnsborg/laravel-pdf
		 */
		$s_file_name		= $o_place->id . '.pdf';
		$s_file_path		= storage_path('pdf/' . $s_file_name);
		$o_pdf				= PDF::loadHTML($s_contents_pdf)->save($s_file_path);
		/**
		 *	debug email and PDF look
		 */
		/*
			echo $s_contents;die();
			PDF::loadHTML($s_contents)->stream();die();
		*/
		for ($i = 0; $i < count($a_recipients); $i++)
		{
			$s_email_to = $a_recipients[$i]['email'];
			$s_name_to = $a_recipients[$i]['name'];

			Mail::send
			(
				$s_tmpl_eml,
				$a_params,
				function($message) use ($s_subj, $s_email_to, $s_name_to, $s_email_from, $s_name_from, $s_email_reply, $s_name_reply, $s_file_path, $s_file_name)
				{
					$message
						->from($s_email_from, $s_name_from)
						/**
						 *
							->returnPath($s_email_reply, $s_name_reply)
						 *
						 *	without changing "returnPath" mail servers will:
						 *	- not return undelivered email to address needed
						 *	+ evaluate SPF check as «PASS»
						 *
						 *	changing return address this will:
						 *
						 *	+ return undelivered email to address needed
						 *	- will cause SPF as «softfail check» if the recipient mail system does not recognise the sender domain as allowed sender
						 *	"google.com: domain of transitioning «$s_email_reply» does not designate «IP» as permitted sender"
						 */
						->replyTo($s_email_reply, $s_name_reply)
						->replyTo($s_email_reply, $s_name_reply)
						->to($s_email_to, $s_name_to)
						->subject($s_subj)
					;

					$message->attach(
						$s_file_path,
						[
							'as'		=> 'ngo_debate_for_changes_' . date('Y_m_d') . '_№' . $s_file_name,
							'mime'		=> mime_content_type($s_file_path), #'application/pdf'
						]
					);

				}
			);
		}
	}

}
