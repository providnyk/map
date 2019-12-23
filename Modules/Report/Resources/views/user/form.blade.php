@extends('user.form')

@section('script')
<script type="text/javascript">
let s_route = '{!! route('api.points.issues', ':point_id') !!}';

$(document).ready(function () {

	// reset dependent dropdown on page initialization
	$("#issue_id").select2({
//		placeholder: $('#point_id').data('placeholder'),
		data: {},
	});

	$('#point_id').change( function() {
		$(this).find(":selected").each(function () {
			var i_point_id = $(this).val();
/*
$("#issue_id").select2(settings({
	url: s_route.replace(':point_id', i_point_id),
	filter: 'title',
//    multiple: true,
//    vocation_id: $(e.currentTarget).closest('.vocation').attr('data-vocation-id'),
}));
*/

/*
	// reset dependent dropdown on page initialization
	$("#issue_id").select2({
		placeholder: $('#point_id').data('placeholder'),
		data: {},
	});
*/

$("#issue_id").select2({
	ajax: {
		url: s_route.replace(':point_id', i_point_id),
		dataType: 'json',
		data: function (params) {
			var query = {
			search: params.term,
			point: i_point_id,
			}
			// Query parameters will be ?search=[term]&point=[id]
			return query;
		},
	},
});

			$.ajax({
				'type': 'get',
				'data': {},
				'url': s_route.replace(':point_id', i_point_id),
				success: (data, status, xhr) => {

					if (xhr.readyState == 4 && xhr.status == 200)
						try {
							// Do JSON handling here
							tmp = JSON.parse(xhr.responseText);
//console.log(xhr.responseText, xhr.responseJSON, data, tmp)
/*
$("#issue_id").select2({
	'dataType': 'json',
	'data':
{
  "results": [
	{
	  "id": 1,
	  "text": "Option 1"
	},
	{
	  "id": 2,
	  "text": "Option 2"
	}
  ],
}
	,
});
*/

/*
$.each(data, function(value, key) {
	$location2.append($("<option></option>").attr("value", value).text(key)); // name refers to the objects value when you do you ->lists('name', 'id') in laravel
});
*/

//							$('#issue_id .field-body').show();
							/*

					swal({
						title: data.message,
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

							swal({
								title: '{!! trans('user/messages.text.success') !!}',
								text: data.message,
								type: 'success',
								confirmButtonText: '{!! trans('user/messages.button.ok') !!}',
								confirmButtonClass: 'btn btn-primary',
							}).then(function(){
								location.reload(true);
							});
							*/
						} catch(e) {
							//JSON parse error, this is not json (or JSON isn't in the browser)
							//location.reload(true);
						}
					//else
						//location.reload(true);

				},
				'error': (xhr) => {
	/*
					let response = xhr.responseJSON;
					form.find('.error').remove();
					$.each(response.errors, (field, message) => {
						form.find(`[data-field="${field}"] .field-body`).append($('<div class="error pt-2">').html(message+' '));
					});
	*/
				}
			});
		});
	});
});

</script>
@append

