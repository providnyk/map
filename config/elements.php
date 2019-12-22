<?php

use Illuminate\Support\Pluralizer;

$a_parts = [
		'buildings'		=> 'Building',
		'designs'		=> 'Design',
		'ownerships'	=> 'Ownership',
		'points'		=> 'Point',
		'targets'		=> 'Target',
		'users'			=> 'User',
];

$a_modules = [];
$a_res = file_get_contents(base_path().'/modules_statuses.json');
$a_res = json_decode($a_res, TRUE);
foreach ($a_res AS $s_name => $b_status)
{
	if ($b_status)
	{
		$s_table				= strtolower(Pluralizer::plural($s_name, 2));
		$a_modules[$s_table]	= $s_name;
	}
}

$a_items = array_merge($a_parts, $a_modules);
asort($a_items);

return ['list' => $a_items, 'modules' => array_keys($a_modules)];