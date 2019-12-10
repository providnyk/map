$(document).ready(() => {

	moment().locale('{!! $app->getLocale() !!}');
/*
    // https://css-tricks.com/snippets/javascript/javascript-keycodes/
	// Ctrl+s, Cmd+s pressed
	$(document).keydown(function(e) {
		if ((e.key == 's' || e.key == 'S' ) && (e.ctrlKey || e.metaKey))
		{
			e.preventDefault();
			$('form').submit();
			return false;
		}
		return true;
	});
*/
	$('form').on('submit', function(e){
		e.preventDefault();

		let data = {},
			form = $(this);

		$.ajax({
			url: form.attr('action'),
			type: form.attr('method'),
			data: form.serialize()
		}).done((data, status, xhr) => {
			swal({
				title: s_res_submit,
				type: 'success',
				showCancelButton: true,
				confirmButtonText: s_text_list,
				confirmButtonClass: 'btn btn-primary',
				cancelButtonText: s_text_continue,
				cancelButtonClass: 'btn btn-light',
			}).then((confirm) => {
				if(confirm.value){
					window.location.href = s_list_route;
				}else{
					form.find('fieldset').attr('disabled', false);
				}
			});

			form.find('fieldset').attr('disabled', true);
		}).fail((xhr) => {
			let data = xhr.responseJSON;

			notify(data.message, 'danger', 3000);
		}).always((xhr, type, status) => {

			let response = xhr.responseJSON || status.responseJSON,
				errors = response.errors || [];

			form.find('.field').each((i, el) => {
				let field = $(el),
					container = field.find(`.field-body`),
					elem = $('<label class="message">');

				container.find('label.message').remove();

				if(errors[field.data('name')]){
					errors[field.data('name')].forEach((msg) => {
						elem.clone().addClass('validation-invalid-label').html(msg).appendTo(container);
					});
				}else{
					//elem.clone().addClass('validation-valid-label').html('Success').appendTo(container);
				}

			});
		})
	});

});