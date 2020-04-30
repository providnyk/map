<?php

namespace Modules\Complaint\Database;

use                                      App\Model;

class Complaint extends Model
{
	protected $connection = 'psc';
	protected $fillable = [
		'place_id',
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
        return $this->HasMany('Modules\Place\Database\Place');
    }


	public static function sendIt(Array $a_complaints, Bool $b_dry_run = NULL) : void
	{
		$s_date		= date("m/d/Y");
		$s_title	= $a_complaints['title'];
		$s_address	= $a_complaints['address'];
		$s_descr	= $a_complaints['description'];
		$a_issues	= implode(', ', $a_complaints['rating']['issues']);

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
#		$s_name_from	= $a_from[0]['s_title'];
		$s_subj		 	= $a_from[0]['s_subject'];
		$s_name_from	= config('services.mail.name');

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

}
