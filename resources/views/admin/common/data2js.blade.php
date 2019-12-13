let
	s_page_route		= '{!! $s_page_route !!}'
	,s_res_submit		= '{!! trans( 'user/'. $s_category . '.names.saved') . ' ' . mb_strtolower(trans( 'user/messages.text.'.($o_item->id ? 'updated' : 'created')) ) !!}'
	,s_text_list		= '{!! $s_btn_primary !!}'
	,s_text_continue	= '{!! $s_btn_secondary !!}'
	,s_list_route		= '{!! $s_list_route !!}'
	;

