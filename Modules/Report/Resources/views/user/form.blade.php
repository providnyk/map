@extends('user.form')

@section('script')
<script type="text/javascript">
let s_route = '{!! route('api.point.issue', ':point_id') !!}'
	,i_previous = null;

function checkRestoreInitialValue()
{
//	if (i_previous == null) return true;
	$('#issue_id').change( function() {
		if (i_previous != null && $('#issue_id').find("option[value='" + i_previous + "']").length) {
//			console.log(i_previous);
    		$('#issue_id').val(i_previous);//.trigger('change');
    		i_previous = null;
		}
	});
}

$(document).ready(function () {

	// reset dependent dropdown on page initialization
	$("#issue_id").select2({
//		placeholder: $('#point_id').data('placeholder'),
		data: {},
	});

	$('#point_id').change( function() {
		$(this).find(":selected").each(function () {
			var i_point_id = $(this).val();

			if ($("#issue_id").val() != null)
				i_previous = $("#issue_id").val();

	console.log($('#issue_id').select2('data'));
			// reset dependent dropdown on "parent" change
			$("#issue_id").val(null).trigger('change');

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

processResults: function (data) {
	console.log(data.results);
      // Transforms the top-level key of the response object from 'items' to 'results'
      return {
      	results: data.results
//        results: data.items
      };
    }
				},
			});

		});
	});

	//setInterval(checkRestoreInitialValue, 200);

});

</script>
@append

