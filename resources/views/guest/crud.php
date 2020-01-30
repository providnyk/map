<?php

$s_tmp				= request()->route()->getAction()['as'];
$a_tmp				= explode('.', $s_tmp);
$s_category			= 'place';

$s_form_route		= mb_strtolower($a_tmp[1]);
$s_utype			= $a_tmp[0];

$s_cat_sgl_low		= mb_strtolower(trans('user/' . $s_category . '.names.sgl'));
$s_cat_sgl_up		= mb_strtoupper($s_cat_sgl_low);
$s_cat_sgl_u1		= ucfirst($s_cat_sgl_low);

$s_cat_plr_low		= mb_strtolower(trans('user/' . $s_category . '.names.plr'));
$s_cat_plr_up		= mb_strtoupper($s_cat_plr_low);
$s_cat_plr_u1		= ucfirst($s_cat_plr_low);

$s_create_route		= route($s_utype.'.'.$s_form_route);
#$s_delete_route		= route('api.' . $s_category . '.destroy');
$s_list_route		= route($s_utype . '.personal_places');
$s_cancel_route		= route($s_utype . '.personal_places');
$s_list_name		= trans('common/form.breadcrumbs.list') . ' ' . trans('user/' . $s_category . '.names.list');

$s_title			= trans('user/' . $s_category . '.names.plr');

if (isset($$s_category))
{
	$o_item				= $$s_category;
	$s_page_action		= ($o_item->id
								? trans('common/form.text.edit')
								: trans('common/form.text.create')
							)
							. ' '
							. ($o_item->id
								? trans('user/' . $s_category . '.names.txt_edit')
								: trans('user/' . $s_category . '.names.txt_create')
							)
							;
	$s_page_route		= ($o_item->id
								? route('admin.' . $s_category . '.form', $o_item->id)
								: route('admin.' . $s_category . '.form')
							);
	$s_form_method		= ($o_item->id
								? 'post'
								: 'post'
							);

	$s_form_route		= ($o_item->id
								? route('api.' . $s_category . '.update', $o_item->id)
								: route('api.' . $s_category . '.store')
							);

	$s_btn_primary		= trans('common/form.actions.view') . ' ' . trans("common/form.breadcrumbs.list");

	$s_btn_secondary	= ($o_item->id
								? trans('common/form.actions.continue') . ' ' . trans('common/form.actions.edit')
								: trans('common/form.actions.create_more')
							);
}

if (!isset($b_script_loaded))
	$b_script_loaded = [];
