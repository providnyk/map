let
	s_route_session			= '{!! route('admin.session') !!}'
	,s_route_file				= '{!! route('api.upload.file') !!}'
	,s_route_image				= '{!! route('api.upload.image') !!}'
	,s_btn_ok					= '{!! trans('user/messages.button.ok') !!}'
	,s_session_acl_head			= '{!! trans('user/session.text.acl_head') !!}'
	,s_session_acl_info			= '{!! trans('user/session.text.acl_info', ['username' => Auth::user()->first_name]) !!}'
	,s_session_expired_head		= '{!! trans('user/session.text.expired_head', ['username' => Auth::user()->first_name]) !!}'
	,s_session_expired_info		= '{!! trans('user/session.text.expired_info') !!}'
	,s_session_close			= '{!! trans('user/messages.button.close') !!}'
	,s_session_tab_opennew		= '{!! trans('user/session.button.tab_open') !!}'
	,s_session_tab_opened		= '{!! trans('user/session.text.tab_opened') !!}'
	,s_servererror_final		= '{!! trans('user/session.text.server_err_final') !!}'
	,s_servererror_head			= '{!! trans('user/session.text.server_err_head') !!}'
	,s_servererror_info			= '{!! trans('user/session.text.server_err_info') !!}'
;
