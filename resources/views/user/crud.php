<?php

$s_tmp              = request()->route()->getAction()['as'];
$a_tmp              = explode('.', $s_tmp);
$s_category         = mb_strtolower($a_tmp[1]);

$s_cat_sgl_low      = mb_strtolower(trans('user/' . $s_category . '.names.sgl'));
$s_cat_sgl_up       = mb_strtoupper($s_cat_sgl_low);
$s_cat_sgl_u1       = ucfirst($s_cat_sgl_low);

$s_cat_plr_low      = mb_strtolower(trans('user/' . $s_category . '.names.plr'));
$s_cat_plr_up       = mb_strtoupper($s_cat_plr_low);
$s_cat_plr_u1       = ucfirst($s_cat_plr_low);

$s_list_route       = route('admin.' . $s_category);
$s_list_name        = $s_cat_plr_u1 . ' ' . trans('common/form.breadcrumbs.list');

$s_title         	= trans('user/' . $s_category . '.names.plr');

if (isset($$s_cat_sgl_low))
{
	$o_item         	= $$s_cat_sgl_low;
	$s_page_action      = ($o_item->id
	                            ? trans('common/form.actions.edit')
	                            : trans('common/form.actions.create')
	                        )
	                        . ' ' . $s_cat_sgl_low;
	$s_page_route       = ($o_item->id
	                            ? route('admin.' . $s_category . '.form', $o_item->id)
	                            : route('admin.' . $s_category . '.form')
	                        );
	$s_form_route       = ($o_item->id
	                            ? route('api.' . $s_category . '.update', $o_item->id)
	                            : route('api.' . $s_category . '.store')
	                        );

	$s_btn_primary		= trans("common/form.actions.view") . ' ' . trans("common/form.breadcrumbs.list");

	$s_btn_secondary	= ($o_item->id
	                            ? trans("common/form.actions.continue") . ' ' . trans('common/form.actions.edit')
	                            : trans("common/form.actions.create_more")
	                        );
}