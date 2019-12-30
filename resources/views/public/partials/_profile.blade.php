@section('script')
<!-- http://ec.europa.eu/ipg/basics/legal/cookies/index_en.htm -->
@if (Cookie::get( config('cookie-consent.cookie_name') ) !== null)
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.google.recaptcha.key') }}"></script>
@endif
<script>
	let reCAPTCHA_site_key = '{{ config('services.google.recaptcha.key') }}';
	$(document).ready(() => {

		var	csrfToken					= $('[name="csrf_token"]').attr('content'),
			i_csrf_update_time			= Date.now(),
			i_reCAPTCHA_update_time		= 0,
			i_reCAPTCHA_refresh_time	= 1000 * 60 * 2; // seconds 1 * 60 = minutes 1 * 2

//		setInterval(refreshToken, 3600000); // 1 hour
//		setInterval(refreshToken, 1000 * 60 * 2); // 1 min

		function refreshToken(){
			$.get('refresh-csrf').done(function(data){
				csrfToken = data; // the new token
				timepassed = Date.now() - i_csrf_update_time;
				console.log(csrfToken, Math.round(timepassed / 1000) + 's ' + Math.round(timepassed / 1000 / 60) + 'm');
			});
		}

		reCAPTCHA_execute = function reCAPTCHA_execute () {
			i_tmp = Math.round((Date.now() - i_reCAPTCHA_update_time) / 1000) * 1000;
			if ( i_tmp < i_reCAPTCHA_refresh_time || !b_focus_status) return true;
			i_reCAPTCHA_update_time		= Date.now();
			grecaptcha.execute(reCAPTCHA_site_key, {action: 'login'}).then(function(token) {
				$('[name="g-recaptcha-response"]').val(token);
				}, function (reason) {
			});
		}

		if (typeof grecaptcha !== 'undefined' && typeof reCAPTCHA_site_key !== 'undefined') {
			grecaptcha.ready(reCAPTCHA_execute);
			a_check_focus.push(reCAPTCHA_execute);
			setInterval(reCAPTCHA_execute, i_reCAPTCHA_refresh_time / 3);
		}

		// TODO: refactoring
		// look at forms.js
		$('{!! $s_id !!}').on('submit', (e) => {
			e.preventDefault();

			let form = $(e.currentTarget);

			$.ajax({
				'type': 'post',
				'data': form.serialize(),
				'url': form.attr('action'),
				success: (data, status, xhr) => {
					if (xhr.readyState == 4 && xhr.status == 200)
						try {
							// Do JSON handling here
							tmp = JSON.parse(xhr.responseText);
							swal({
								title: '{!! trans('user/messages.text.success') !!}',
								text: data.message,
								type: 'success',
								confirmButtonText: '{!! trans('user/messages.button.ok') !!}',
								confirmButtonClass: 'btn btn-primary',
							}).then(function(){
								location.reload(true);
							});
						} catch(e) {
							//JSON parse error, this is not json (or JSON isn't in the browser)
							location.reload(true);
						}
					else
						location.reload(true);
				},
				'error': (xhr) => {
					let response = xhr.responseJSON;
					form.find('.error').remove();
					$.each(response.errors, (field, message) => {
						form.find(`[data-field="${field}"] .field-body`).append($('<div class="error pt-2">').html(message+' '));
					});
					reCAPTCHA_execute();
				}
			});
		});
	});
</script>
@endsection